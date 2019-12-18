# Ce script enregistre les notes en CSV
# coding: utf-8
import csv, json, os.path


def writeNoteCSV(nom, note, min, max):
    with open("notes.csv", "w", encoding="utf-8") as fichier:
        writer = csv.writer(fichier)

        writer.writerow([nom,note,min,max])

def createjson(data):
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


	with open(os.path.dirname(__file__) + '/../notes.csv', 'wt') as f:
	    csv_writer = csv.writer(f)
	 
	    csv_writer.writerow(header) 
	    for row in reader:
	        csv_writer.writerow(row)

	csvfile = open('../notes.csv', 'r')
	jsonfile = open('file.json', 'w')
	
	fieldnames = ('UE', 'CodeModule', 'Module', 'Evaluation', 'Note', '(Min/Max)', 'Coef')
	reader = csv.DictReader( csvfile, fieldnames)
	for row in reader:
	    json.dump(row, jsonfile)
	    jsonfile.write('\n')

	
			
	