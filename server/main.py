import ent
import save
import credentials
import check

auth = credentials.getCredentials()
page = None

# Get the credentials registered in credentials.yml
if (auth["error"] == None):
	page = ent.getNotesPage(auth["credentials"])
else:
	print(auth["error"])

# Login to ENT and save
if (page["error"] == None):
	save.createjson(page["page"])
else:
	print(page["error"])

check.checker()