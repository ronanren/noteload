import ent
import save
import credentials
import check


# Get the credentials registered in database
auth = credentials.getCredentials()
page = None


for user in auth:
	page = ent.getNotesPage(user)

	# Login to ENT and save
	if (page["error"] == None):
		save.createcsv(page["page"], user)
	else:
		print(page["error"] + " " + str(user[1]))

check.checker(auth)

