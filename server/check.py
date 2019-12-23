# Ce script verifie si il y a de nouvelles notes
# coding: utf-8
import time
import ent
import save
import credentials
import collections as ct
from time import strftime
import yaml


def checker(auth):
	print("check des notes...")
	#read last csv file create
	temps = time.time()
	while True:
		if time.time() - temps > 3600:
			temps = time.time()
			auth = credentials.getCredentials()
			for user in auth:
				page = ent.getNotesPage(user)
				save.createcsv(page["page"], user)
			print("update bdd : ")
			print(auth)

		for user in auth:
			
			csvfile = open('data/' + user[1] + '.csv', 'r')
			csvfile = csvfile.read()
			csvfile = csvfile.replace("\n\n", "\n")
			csvfile = csvfile.replace('"', "")
			csvfile = csvfile[52:]

			#read current data on website
			auth = credentials.getCredentials()
			data = ent.getNotesPage(user)
			data = data['page']
			num1 = data.find('Moyenne')
			num2 = data.find('Gestion des absences')
			data = data[num1:num2-15]
			#UE|CodeModule|Module|Evaluation|Note|(Min/Max)|Coef
			data = data.replace("|  ", "|")
			data = data.replace("| ", "|")
			data = data.replace("![-](imgs/minus_img.png)", "")
			data = data.replace("Moyenne générale:", "|||Moyenne générale:")
			data = data.replace("|", ",")
			data = data + "\n"
			
			#comparing
			print (strftime("%H:%M:%S") + " comparing...")
			ca = ct.Counter(data.split("\n"))
			cb = ct.Counter(csvfile.split("\n"))

			diff = ca - cb
			changes = "\n".join(diff.keys())
			if (changes != ""):
				print ("mail send : " + str(changes))
				import smtplib
				from email.mime.text import MIMEText

				credential = yaml.load(open('credentials.yml'), Loader=yaml.FullLoader)

				message = MIMEText(changes.replace(",", " "))
				message['Subject'] = 'Nouvelle note'

				message['From'] = credential['mail']['from']
				message['To'] = user[2]

				server = smtplib.SMTP(credential['mail']['server'])
				server.starttls()
				server.login(credential['mail']['from'],credential['mail']['password'])
				server.send_message(message)
				server.quit()

				#update new marks
				page = None
				page = ent.getNotesPage(user)
				save.createcsv(page["page"], user)

				from ftplib import FTP 
				import os
				import fileinput

				credential = yaml.load(open('credentials.yml'), Loader=yaml.FullLoader)
				 
				ftp = FTP()
				ftp.set_debuglevel(2)
				ftp.connect(credential['ftp']['server'], 21) 
				ftp.login(credential['ftp']['user'],credential['ftp']['password'])
				ftp.cwd('www/data')
				fp = open('data/' + str(user[1]) + '.csv', 'rb')
				ftp.storbinary('STOR %s' % os.path.basename('data/' + str(user[1]) + '.csv'), fp, 1024)
				fp.close()
		time.sleep(300)

	

