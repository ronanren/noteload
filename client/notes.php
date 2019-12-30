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
    <title>Noteload</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="dark">
    <main>
        <header>
            <img src="img/profile_picture.jpg" alt="<?php echo $_SESSION['username']; ?>" />
            <p>
                <strong>Continuez sur cette lancée,</strong> <br />
                <?php echo $_SESSION['username']; ?>
            </p>
        </header>

        <section>
            <h2>Notes</h2>

            <?php

            set_error_handler(function($errno, $errstr, $errfile, $errline, $errcontext) {
                // error was suppressed with the @-operator
                if (0 === error_reporting()) {
                    return false;
                }

                throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
            });
            echo "<table class='centered'>\n\n";
            try {
                $f = fopen("../data/".$_SESSION['username'].".csv", "r");
                while (($line = fgetcsv($f)) !== false) {
                    echo "<tr>";
                    foreach ($line as $cell) {
                        echo "<td>" . $cell . "</td>";
                    }
                        echo "</tr>\n";
                    }
                fclose($f); 
                echo "\n</table></body></html>";
            }
            catch (ErrorException $e) {
                echo 'Vos notes seront afficher prochainement sous maximum 1 heure...';
            }
            ?>
            <p class="more-info">Dernière vérification : Aujourd'hui, à 14:08</p>
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
            <li class="selected">
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
            <li>
                <a href="/parametres">
                    <i class="material-icons">settings_applications</i>
                    <p>Paramètres</p>
                </a>
            </li>
        </ul>
    </nav>
</body>

</html>