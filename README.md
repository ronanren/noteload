# noteload

<h4 align="center">🎓🛠️ Noteload est un script qui permet d'envoyer des notifications des nouvelles notes présentes sur l'environnement numérique de travail de l'Université de Rennes 1.</h4>
<h4 align="center">Développé par <a href="https://github.com/mboultoureau">Mathis Boultoureau</a> et <a href="https://github.com/ronanren">Ronan Renoux</a></h4>

<p align="center">
<a href="https://badge.fury.io/py/beautifulsoup4"><img src="https://badge.fury.io/py/beautifulsoup4.svg" alt="PyPI version" height="18"></a>
<a href="https://badge.fury.io/py/html2text"><img src="https://badge.fury.io/py/html2text.svg" alt="PyPI version" height="18"></a>
<a href="https://badge.fury.io/py/requests"><img src="https://badge.fury.io/py/requests.svg" alt="PyPI version" height="18"></a>
<a href="https://badge.fury.io/py/PyYAML"><img src="https://badge.fury.io/py/PyYAML.svg" alt="PyPI version" height="18"></a>
</p>

<p align="center">
  <a href="#Fonctionnalités">Fonctionnalités</a> |
  <a href="#Utilisation">Utilisation</a> |
  <a href="#Licence">Licence</a> |
  <a href="#Contactez-moi">Contactez-moi</a> |
  <a href="https://ronanren.github.io" target="_blank">Mon site personnel</a> 
</p>

# Fonctionnalités

Noteload comprend deux parties :

- Une partie serveur en Python qui vérifie constamment les notes et notifie par mail des nouvelles notes
- Une partie client qui affiche sur un navigateur les notes située le github de [mboultoureau](https://github.com/mboultoureau/noteload)

# Utilisation

```bash
# Cloner ce dépôt
$ git clone https://github.com/ronanren/noteload

# Accéder au dossier
$ cd noteload

# Modifier le fichier credentials.yml pour la base de données/serveur mail/ftp

# Installer toutes les dépendances
$ pip install -r requirements.txt

# Lancer le script
$ python main.py
```

# Licence

<a href="https://github.com/ronanren/noteload/blob/master/LICENSE" target="_blank">MIT</a>

# Contactez-moi

**Twitter** : <a href="https://twitter.com/Ronanren" target="_blank">@Ronanren</a>
