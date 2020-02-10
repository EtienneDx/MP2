<?php

require_once __DIR__ . "/../autoload.php" ;
require_once __DIR__ . "/includes/connection.php";

session_start();

$error = null;

if(is_connected())// already connected
{
  $redirect = $_SESSION['redirect'];
  unset($_SESSION['redirect']);
  header("Location: " . (isset($redirect) ? $redirect : 'index.php'));
  die('Redirect');
}
else if(isset($_POST['username']) && isset($_POST['password']))
{
	$user = get_user($_POST['username']);
  if(!$user)
  {
    $error = "Nom d'utilisateur incorrect!";
  }
  else
  {
    if(password_verify($_POST['password'], $user->getPassword()))// check if the hash matches
    {
      $_SESSION['username'] = $_POST['username'];
      $_SESSION['password'] = $_POST['password'];

      $redirect = $_SESSION['redirect'];
      unset($_SESSION['redirect']);
		  header("Location: " . (isset($redirect) ? $redirect : 'index.php'));
      die('Redirect');
    }
    else
    {
      $error = "Mot de passe incorrect!";
    }
  }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Connexion - Balance ton train</title>

    <link rel="stylesheet" href="./adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="./css/connect.css"/>
  </head>
  <body>
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
