<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "Vous devez d'abord vous connecté.";
    header('location: connection');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: connection");
  }
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Noteload - Paramètres</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="dark">
    <main>
        <header>
            <img src="img/profile_picture.jpg" alt="<?php echo $_SESSION["username"]; ?>" />
            <p>
                <strong>Paramètres</strong> <br />
                <?php echo $_SESSION["username"]; ?>
            </p>
        </header>

        <div class="two-columns">
            <section>
                <h2>Profil</h2>
                <p>Certaines informations ne sont pas modifiables car elles sont nécessaires pour récupérer vos notes.</p>
                <div class="input">
                    <label for="name">Prénom et nom</label>
                    <input type="text" id="name" name="name" disabled value="<?php echo $_SESSION["username"]; ?>" />
                </div>
                <?php 
                    $config = parse_ini_file('../private/config.ini'); 
                    $db = mysqli_connect($config['host'], $config['username'], $config['password'], $config['dbname']);
                    $usercheck = 'SELECT * FROM users WHERE username="'.$_SESSION["username"].'"LIMIT 1';
                    $result = mysqli_query($db, $usercheck);
                    $user = mysqli_fetch_assoc($result);
                ?>
                <div class="input">
                    <label for="email">Adresse email</label>
                    <input type="text" id="email" name="email" disabled value="<?php echo $user['email']; ?>" />
                </div>
                <div class="button">
                    <a href="#">Contacter le support technique</a>
                </div>
                <div class="button danger">
                    <a href="delete">Déconnexion</a>
                </div>
                <p class="more-info">Dernière vérification des notes : Aujourd'hui, à 14:08</p>
            </section>
            <section>
                <h3>Affichage</h3>
                <p>Prêt à passer du côté obscur de la force ?</p>
                <div class="checkbox">
                    <p>Passer du côté obscur</p>
                    <input type="checkbox" name="dark-mode" id="dark-mode" />
                    <label for="dark-mode"></label>
                </div>
            </section>
        </div>

        <section>
            <h3>Crédits</h3>
            <p>Réalisé par Mathis Boultoureau & Ronan Renoux</p>
        </section>
    </main>

    <nav>
        <ul>
            <li>
                <a href="/notes">
                    <i class="material-icons">home</i>
                    <p>Accueil</p>
                </a>
            </li>
            <li>
                <a href="/notes">
                    <i class="material-icons">check_box</i>
                    <p>Notes</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="material-icons">calendar_today</i>
                    <p>Agenda</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="material-icons">menu_book</i>
                    <p>Cours</p>
                </a>
            </li>
            <li class="selected">
                <a href="/parametres">
                    <i class="material-icons">settings_applications</i>
                    <p>Paramètres</p>
                </a>
            </li>
        </ul>
    </nav>
</body>

</html>