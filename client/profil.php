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
    <title>Noteload - Profil</title>
    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
</head>

<body>
    <nav class="white" role="navigation">
        <div class="nav-wrapper container">
            <a id="logo-container" href="/main" class="brand-logo">Noteload</a>
            <ul class="right hide-on-med-and-down">
                <li><a href="/profil">Profil</a></li>
                <li><a href="/">Se déconnecter</a></li>
            </ul>
            <ul id="nav-mobile" class="sidenav">
                <li><a href="/profil">Profil</a></li>
                <li><a href="/">Se déconnecter</a></li>
            </ul>
            <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
    </nav>
    <div class="container">
        <div class="section">
            <div class="row">
                <h5>Profil :</h5>
            </div>
        </div>
        <div class="row">
        <div class="input-field col s6">
          <input disabled value="<?php echo $_SESSION["username"]; ?>" id="disabled" type="text" class="validate">
          <label for="disabled">username</label>
        </div>
        <?php 
            $config = parse_ini_file('../private/config.ini'); 
            $db = mysqli_connect($config['host'], $config['username'], $config['password'], $config['dbname']);
            $usercheck = 'SELECT * FROM users WHERE username="'.$_SESSION["username"].'"LIMIT 1';
            $result = mysqli_query($db, $usercheck);
            $user = mysqli_fetch_assoc($result);
        ?>
        <div class="input-field col s6">
          <input disabled value="<?php echo $user['email']; ?>" id="disabled" type="text" class="validate">
          <label for="disabled">email</label>
        </div>
    </div>
    


    
    <!--  Scripts-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
</body>

</html>