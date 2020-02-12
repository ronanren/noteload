import requests
from bs4 import BeautifulSoup
import html2text

# Connecting and obtaining the notes page
def getNotesPage(credentials):

    URL = 'https://sso-cas.univ-rennes1.fr/login?service=http%3A%2F%2Fnotes.iutlan.univ-rennes1.fr%2F'
    HEADERS = {
        'User-Agent': 'Noteload'
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
            'username': credentials[1],
            'password': credentials[3],
            'execution': token,
            '_eventId': 'submit',
            'geolocation': ''
        }
        
        try:
            session = requests.Session()
            response = session.post(URL, data=login, headers=HEADERS)
        except requests.ConnectionError:
            data["error"] = "There is a problem with the Internet connection"

    # DATA PRE-PROCESSING
    if (data["error"] == None):
        html_page = BeautifulSoup(response.content, "html.parser")

        if (response.status_code == 200) :
            h = html2text.HTML2Text()
        
            h.ignore_links = True
            h.body_width = 0

            html_page = str(html_page)
            listsem = html_page[html_page.find('<select name="sem">'):html_page.find('</select>')]
            sem = listsem.rfind("value=")
            sem = listsem[sem+7:sem+14]
            
            params = {
                "sem": sem
            }
            

            cookies = {
                "PHPSESSID": session.cookies.get_dict().get("PHPSESSID")
            }
            new_request = requests.post("http://notes.iutlan.univ-rennes1.fr/index.php", data=params, headers=HEADERS, cookies=cookies)


            data["page"] = h.handle(str(new_request.text))
            data["error"] = None
        elif (response.status_code == 401) :
            data["error"] = "Your Sesame IDs seem wrong"
        else :
            data["error"] = "An unknown error occurred"
    
    return data
