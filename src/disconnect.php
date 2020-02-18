<?php

require_once __DIR__ . "/../autoload.php" ;
require_once __DIR__ . "/includes/deconnection.php";

session_start();

$error = null;
if(is_connected())// already connected
{
  $redirect = $_SESSION['redirect'];
  unset($_SESSION['redirect']);
  header("Location: " . (isset($redirect) ? $redirect : 'index.php'));
  die('Redirect');
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Déconnexion - Balance ton train</title>

    <link rel="stylesheet" href="./adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="./css/disconnect.css"/>
  </head>
  <body>
		<div id="container">
		  <div id="formContent">
				<form method="POST" target="_self">
					<div class="form-group">
						<label for="disconnect">Se déconnecter : </label>
						<input type="text" class="form-control" name="disconnect" id="disconnect" placeholder="Se déconnecter"></input>
					</div>
          <?php if($error !== null): ?>
  					<div class="alert alert-danger">
  	          <?php echo $error; ?>
  	        </div>
          <?php endif; ?>
				</form>
			</div>
	  </div>

    <script type="text/javascript" src="./adminlte/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="./adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>
