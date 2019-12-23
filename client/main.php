<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: connection.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: connection.php");
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Noteload - Main</title>
    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
</head>

<body>
    <nav class="white" role="navigation">
        <div class="nav-wrapper container">
            <a id="logo-container" href="main.php" class="brand-logo">Logo</a>
            <ul class="right hide-on-med-and-down">
                <li><a href="profil.php">Profil</a></li>
                <li><a href="index.html">Se déconnecter</a></li>
            </ul>
            <ul id="nav-mobile" class="sidenav">
                <li><a href="profil.php">Profil</a></li>
                <li><a href="index.html">Se déconnecter</a></li>
            </ul>
            <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
    </nav>
    <div class="container">
        <div class="section">
            <div class="row">
                <h5 class="center">Bienvenue sur notre site <?php echo $_SESSION['username']; ?></h5>
            </div>
        </div>
        <?php

        set_error_handler(function($errno, $errstr, $errfile, $errline, $errcontext) {
        // error was suppressed with the @-operator
        if (0 === error_reporting()) {
            return false;
        }

        throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
    });
            echo "<html><body><table class='centered'>\n\n";
            try {
                $f = fopen("data/".$_SESSION['username'].".csv", "r");
                while (($line = fgetcsv($f)) !== false) {
                        echo "<tr>";
                        foreach ($line as $cell) {
                                echo "<td>" . iconv( "Windows-1252", "UTF-8", $cell) . "</td>";
                        }
                        echo "</tr>\n";
                }
                fclose($f); 
            echo "\n</table></body></html>";

            }
            catch (ErrorException $e) {
                    echo 'Vos notes seront la prochainement...';
                }
             ?>
             <script>
                function emptyCellsOnly(row) {
                  var cells =  row.cells;
                  for(var j = 0; j < cells.length; j++) {
                    if(cells[j].innerHTML !== '') {
                      return false;
                    }
                  }
                  return true;
                }
                var rows = document.getElementsByTagName('tr');
                for(var i = 0; i < rows.length; i++) {
                  if(emptyCellsOnly(rows[i])) {
                    rows[i].style.display = 'none';
                  }
                }
            </script>
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
                        <li><a class="white-text" href="profil.php">Profil</a></li>
                        <li><a class="white-text" href="index.html">Se déconnecter</a></li>
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
</body>

</html>