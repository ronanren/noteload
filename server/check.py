# Ce script verifie si il y a de nouvelles notes
# coding: utf-8
import time
import ent
import save
import credentials
import collections as ct
from time import strftime


def checker(auth):
	print("check des notes...")
	#read last csv file create
	while True:
		for user in auth:
			csvfile = open('data/' + user[0] + '.csv', 'r')
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
				#update new marks
				page = None
				page = ent.getNotesPage(user)
				save.createcsv(page["page"], user)
		time.sleep(3)

	

