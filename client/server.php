<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$config = parse_ini_file('../private/config.ini'); 
$db = mysqli_connect($config['host'], $config['username'], $config['password'], $config['dbname']);

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password']);
  $recaptcha_response = $_POST['g-recaptcha-response'];

  $recaptcha = file_get_contents($config['url'] . '?secret=' . $config['secret_key'] . '&response=' . $recaptcha_response);
  $recaptcha = json_decode($recaptcha);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Le nom d'utilisateur est requis."); }
  if (empty($email)) { array_push($errors, "L'adresse email est requis."); }
  if (empty($password_1)) { array_push($errors, "Le mot de passe est requis."); }
  if ($recaptcha->score < 0.8)
  {
    array_push($errors, "Votre score reCAPTCHA est trop faible. Essayez depuis un autre appareil ou réseau. N'utilisez pas de bot ou de systèmes automatisés.");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Ce nom d'utilisateur existe déjà.");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Cette adresse email existe déjà.");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = $password_1;//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "Vous êtes désormais connecté.";
  	header('location: notes');
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $recaptcha_response = $_POST['g-recaptcha-response'];

  $recaptcha = file_get_contents($config['url'] . '?secret=' . $config['secret_key'] . '&response=' . $recaptcha_response);
  $recaptcha = json_decode($recaptcha);

  if (empty($username)) {
    array_push($errors, "Le nom d'utilisateur est requis.");
  }
  if (empty($password)) {
    array_push($errors, "Le mot de passe est requis.");
  }
  if ($recaptcha->score < 0.7)
  {
    array_push($errors, "Votre score reCAPTCHA est trop faible. Essayez depuis un autre appareil ou réseau. N'utilisez pas de bot ou de systèmes automatisés.");
  }

  if (count($errors) == 0) {
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "Vous êtes connecté.";
      header('location: notes');
    }else {
      array_push($errors, "Nom d'utilisateur ou mot de passe incorrect.");
    }
  }
}

?>