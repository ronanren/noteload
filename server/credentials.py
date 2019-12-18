import os.path 
import yaml
import mysql.connector

# Returns the credentials registered in credentials.yml
def getCredentials():
    mydb = mysql.connector.connect(
          host="HOST",
          user="USER",
          passwd="PASSWORD",
          database="DATABASE"
        )

    cursor = mydb.cursor()

    cursor.execute("SELECT * FROM database")

    result = cursor.fetchall()

    return result