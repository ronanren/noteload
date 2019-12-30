<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Noteload - Inscription</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <meta name="description"
        content="Noteload est un service non-officiel pour consultez vos notes de l'Université de Rennes 1." />
</head>

<body>
    <main>
        <header>
            <p>
                Connexion à <br />
                <strong>Noteload</strong>
            </p>
        </header>

        <section>
            <form method="post" action="/inscription">
                <?php include('errors.php'); ?>
                <div class="input">
                    <label for="username">Nom d'utilisateur</label>
                    <input id="username" type="text" name="username" value="<?php echo $username; ?>">
                </div>
                <div class="input">
                    <label for="email">Adresse email</label>
                    <input id="email" type="email" name="email" value="<?php echo $email; ?>">
                </div>
                <div class="input">
                    <label for="password">Mot de passe</label>
                    <input id="password" type="password" name="password">
                </div>
                <input type="hidden" name="g-recaptcha-response" />
                <div class="button">
                    <input type="submit" name="reg_user" value="Inscription" />
                </div>
            </form>
        </section>
    </main>

    <nav>
        <ul>
            <li>
                <a href="/">
                    <i class="material-icons">home</i>
                    <p>Accueil</p>
                </a>
            </li>
            <li>
                <a href="/connexion">
                    <i class="material-icons">person</i>
                    <p>Connexion</p>
                </a>
            </li>
            <li class="selected">
                <a href="/inscription">
                    <i class="material-icons">person_add</i>
                    <p>Inscription</p>
                </a>
            </li>
        </ul>
    </nav>
    <script src="https://www.google.com/recaptcha/api.js?render=6Leyr8oUAAAAAJ5TjX_TpJgOD-xI8BYZwfuMTSF1"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6Leyr8oUAAAAAJ5TjX_TpJgOD-xI8BYZwfuMTSF1', {action: 'registration'})
            .then(function(token) {
                document.querySelector('input[name=g-recaptcha-response]').setAttribute('value', token);
            });
        });
    </script>
</body>
</html>