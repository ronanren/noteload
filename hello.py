import requests
from bs4 import BeautifulSoup
import html2text

URL = 'https://sso-cas.univ-rennes1.fr/login?service=http%3A%2F%2Fnotes.iutlan.univ-rennes1.fr%2F'
HEADERS = {
    'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.1 Safari/537.36'
}

data = {
    "error": None,
    "page": ""
}

# SESAME CONNECTION

# Getting the token
try:
    requete = requests.get(URL)
except requests.ConnectionError:
    data["error"] = "There is a problem with the Internet connection"

if (data["error"] == None):
    login_page = BeautifulSoup(requete.content, "html.parser")
    token = login_page.find("input", {"name": "execution"}).get('value')

    # Connection to Sesame with login details
    login = {
        'username': "mboultoureau",
        'password': "!WhiTeam001",
        'execution': token,
        '_eventId': 'submit',
        'geolocation': ''
    }
    
    try:
        response = requests.post(URL, data=login, headers=HEADERS)
    except requests.ConnectionError:
        data["error"] = "There is a problem with the Internet connection"

# DATA PRE-PROCESSING
if (data["error"] == None):
    html_page = BeautifulSoup(response.content, "html.parser")

    if (response.status_code == 200) :
        h = html2text.HTML2Text()
        note_page = html_page.find("body")
        h.ignore_links = True
        h.body_width = 0


        params = {
            "sem": "SEM8546"
        }

        cookies = {
            "PHPSESSID": "YOUR-COOKIE-SESSION"
        }
        new_request = requests.post("http://notes.iutlan.univ-rennes1.fr/index.php", data=params, headers=HEADERS)

        data["page"] = h.handle(str(note_page))
        data["error"] = None
    elif (response.status_code == 401) :
        data["error"] = "Your Sesame IDs seem wrong"
    else :
        data["error"] = "An unknown error occurred"
    
print(data)