<?php

require_once __DIR__ . "/../autoload.php" ;
require_once __DIR__ . "/includes/connection.php";

use Entity\User;

session_start();

$error = null;

if(is_connected())// already connected
{
  $redirect = $_SESSION['redirect'];
  unset($_SESSION['redirect']);
  header("Location: " . (isset($redirect) ? $redirect : 'index.php'));
  die('Redirect');
}
else if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password']))
{
	$user = get_user($_POST['username']);
  if($user)
  {
    $error = "Nom d'utilisateur déjà utilisé!";
  }
  elseif(strlen($_POST['username']) == 0)
  {
    $error = "Un nom d'utilisateur ne peut être vide!";
  }
  elseif(strlen($_POST['password']) < 4)
  {
    $error = "Un mot de passe doit contenir au minimum 4 charactères!";
  }
  elseif($_POST['password'] != $_POST['confirm_password'])
  {
    $error = "Les mots de passe ne correspondent pas!";
  }
  else
  {
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];

    $user = new User($_POST['username'], password_hash($_POST['password'], PASSWORD_DEFAULT));

    $entityManager->persist($user);
    $entityManager->flush();

    $redirect = $_SESSION['redirect'];
    unset($_SESSION['redirect']);
	  header("Location: " . (isset($redirect) ? $redirect : 'index.php'));
    die('Redirect');
  }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Créer un compte - Balance ton train</title>

    <link rel="stylesheet" href="./adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="./css/connect.css"/>
  </head>
  <body>
    <?php
    if($error !== null):
    ?>
    <p>Erreur : <?php echo $error; ?>
    <?php endif; ?>
		<div id="container">
		  <div id="formContent">
				<form method="POST" target="_self">
					<div class="form-group">
						<label for="username">Nom d'utilisateur : </label>
						<input type="text" class="form-control" name="username" id="username" placeholder="Username"></input>
					</div>
					<div class="form-group">
						<label for="password">Mot de passe : </label>
						<input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe"></input>
					</div>
					<div class="form-group">
						<label for="confirm_password">Confirmer le mot de passe : </label>
						<input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirmation mot de passe"></input>
					</div>
          <?php if($error !== null): ?>
  					<div class="alert alert-danger">
  	          <?php echo $error; ?>
  	        </div>
          <?php endif; ?>
					<input type="submit" class="btn btn-primary"></input>
					<div id="createAccount"><a href="signup.php">Créer mon compte</a></div>
				</form>
			</div>
	  </div>

    <script type="text/javascript" src="./adminlte/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="./adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>
