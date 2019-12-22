import os.path 
import yaml
import mysql.connector



def getCredentials():
    credentials = yaml.load(open('credentials.yml'), Loader=yaml.FullLoader)
    mydb = mysql.connector.connect(
              host=credentials['database']['host'],
              user=credentials['database']['user'],
              passwd=credentials['database']['passwd'],
              database=credentials['database']['database']
        )

    cursor = mydb.cursor()

    cursor.execute("SELECT * FROM users")

    result = cursor.fetchall()

    return result