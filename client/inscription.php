<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Noteload - Inscription</title>
    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
</head>

<body>
    <nav class="white" role="navigation">
        <div class="nav-wrapper container">
            <a id="logo-container" href="index.html" class="brand-logo">Noteload</a>
            <ul class="right hide-on-med-and-down">
                <li><a href="/connection">Se connecter</a></li>
                <li><a href="/inscription">S'inscrire</a></li>
            </ul>
            <ul id="nav-mobile" class="sidenav">
                <li><a href="/connection">Se connecter</a></li>
                <li><a href="/inscription">S'inscrire</a></li>
            </ul>
            <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
    </nav>
    <div class="container">
        <div class="section">
            <div class="row">
                <h5 class="center">Comment s'inscire ?</h5>
                <p class="light center">Veuillez-vous inscrire à l'aide de vos même identifiant que l'ENT afin que nos serveurs récuperent vos notes.</p>
            </div>
            <div class="row">
                <form class="col s12" method="post" action="/inscription">
                    <?php include('errors.php'); ?>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="first_name" type="text" class="validate" name="username" value="<?php echo $username; ?>">
                            <label for="username">Nom d'utilisateur</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" type="email" class="validate" name="email" value="<?php echo $email; ?>">
                            <label for="email">Adresse email</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="password" type="password" class="validate" name="password">
                            <label for="password">Mot de passe</label>
                        </div>
                    </div>
                    <input type="hidden" name="g-recaptcha-response" />
                    <div class="row">
                        <button class="btn waves-effect waves-light col s2 offset-l5 offset-m5 offset-s5 " type="submit" name="reg_user">S'inscrire
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <footer class="page-footer teal">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Noteload</h5>
                    <p class="grey-text text-lighten-4">Nous sommes une équipe d'étudiants universitaires qui travaillent sur ce projet.</p>
                </div>
                <div class="col l3 offset-l3 s12">
                    <h5 class="white-text">Navigation</h5>
                    <ul>
                        <li><a class="white-text" href="/connection">Se connecter</a></li>
                        <li><a class="white-text" href="/inscription">S'inscrire</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                Made by <a class="brown-text text-lighten-3" href="http://materializecss.com">Materialize</a>
            </div>
        </div>
    </footer>
    <!--  Scripts-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6Leyr8oUAAAAAJ5TjX_TpJgOD-xI8BYZwfuMTSF1"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6Leyr8oUAAAAAJ5TjX_TpJgOD-xI8BYZwfuMTSF1', {action: 'login'})
            .then(function(token) {
                document.querySelector('input[name=g-recaptcha-response]').setAttribute('value', token);
            });
        });
    </script>
</body>

</html>