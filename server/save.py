# Ce script enregistre les notes en CSV
# coding: utf-8
import csv, os.path
import yaml


def createcsv(data, user):
	num1 = data.find('Moyenne')
	num2 = data.find('Gestion des absences')
	data = data[num1:num2-15]
	#UE|CodeModule|Module|Evaluation|Note|(Min/Max)|Coef
	data = data.replace("|  ", "|")
	data = data.replace("| ", "|")
	data = data.replace("![-](imgs/minus_img.png)", "")
	data = data.replace("Moyenne générale:", "|||Moyenne générale:")
	reader = csv.reader(data.split('\n'), delimiter='|')
	header = ['UE', 'CodeModule', 'Module', 'Evaluation', 'Note', '(Min/Max)', 'Coef']

	with open('data/' + str(user[1]) + '.csv', 'wt') as f:
	    csv_writer = csv.writer(f)
	    csv_writer.writerow(header) 
	    for row in reader:
	        csv_writer.writerow(row)

	#copy file to website server
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





	
			
	