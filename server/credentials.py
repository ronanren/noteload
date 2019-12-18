import os.path 
import yaml

# Returns the credentials registered in credentials.yml
def getCredentials():
    output = {
        "error": None,
        "credentials": {
            "username": "",
            "password": ""
        }
    }

    try:
        stream = open(os.path.dirname(__file__) + "/../config/credentials.yml", 'r')
        login = yaml.safe_load(stream)
    except (OSError, IOError):
        output["error"] = "Unable to open the credentials.yml file. Check that it exists"

    # Checking the input of conforming credentials
    if (output["error"] == None):
        if ('user' in login):
            if ("username" not in login["user"]):
                output["error"] = "There is no username in the credentials.yml file"
            if ("password" not in login["user"]):
                output["error"] = "There is no password in the credentials.yml file"
        else:
            output["error"] = "Your credentials (credentials.yml) do not respect the required form"

    if (output["error"] == None):
        output["credentials"]["username"] = login["user"]["username"]
        output["credentials"]["password"] = login["user"]["password"]

    return output