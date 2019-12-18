# noteload
noteload est une application de consultation des notes présentes sur l'environnement numérique de travail de l'Université de Rennes 1.

# noteload
noteload est une application de consultation des notes présentes sur l'environnement numérique de travail de l'Université de Rennes 1.

## Installation
noteload comprend deux parties :
- Une partie serveur en Python qui vérifie constamment les notes
- Une partie client qui affiche sur un navigateur les notes


### Installation du serveur
Pour installer le serveur, vous devez avoir [Python 3.6](https://www.python.org/downloads/) ou une version ultérieure.

Commencez par vous placez dans le dossier du serveur :

```bash
cd server
```

Nous vous conseillons ensuite de créer un environnement virtuel Python :
```bash
python3 -m venv ENV
```
Ensuite, activez-le avec la commande dédiée à votre système :
```bash
ENV/bin/activate.bat # Sous Windows
source ENV/bin/activate # Sous MacOS et Linux
```

Installez ensuite les dépendances :
```bash
pip install -r requirements.txt
```
> Sous certains systèmes tels que **MacOS**, il se peut que vous deviez utiliser `pip3` au lieu de `pip`.

Vous pouvez désormais exécutez le script :
```bash
python main.py
````
> Sous certains systèmes tels que **MacOS**, il se peut que vous deviez utiliser `python3` au lieu de `python`.

### Installation du client


## Fonctionnalités essentielles
- [x] Connexion automatique à l'ENT
- [x] Récupération des notes
- [x] Enregistrement des notes dans un fichier CSV
- [x] Avertissement d'une modification de notes par comparaison en envoyant un mail

## Fonctionnalités futures
- [ ] Automatiser la vérification à l'aide d'un serveur
- [ ] Ajouter la gestion de plusieurs utilisateurs
- [ ] Réaliser une interface web
- [ ] Réaliser une base de données
- [ ] Faire une Progressive Web App
- [ ] Activation de notifications natives
- [ ] Accès à l'emploi du temps

