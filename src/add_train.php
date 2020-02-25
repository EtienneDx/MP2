<?php
// src/index.php
require_once __DIR__ . "/../autoload.php" ;
require_once __DIR__ . "/includes/connection.php";
use \Entity\Train;

session_start();

verify_connection();
$user = get_user();
$error = null;
if(!$user->getRole())
{
	$error = "Il ne s'agit pas d'un compte administrateur!";
}

$name = $_POST['train_name'];
if($name)
{
	$n_train = new Train($name, new DateTime());
	$entityManager->persist($n_train);
	$entityManager->flush();
	if($entityManager->contains($n_train))
	{
		$redirect = $_SESSION['redirect'];
		unset($_SESSION['redirect']);
		header("Location: " . (isset($redirect) ? $redirect : 'index.php'));
		die('Redirect');
	}
	else
	{
		$error = "Erreur dans l'ajout du train!";

	}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Administrateur - Ajouter un train</title>

    <link rel="stylesheet" href="./adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="./css/add_train.css"/>
  </head>
  <body>
		<div id="container">
		  <div id="formContent">
				<form method="POST" target="_self">
					<div class="form-group">
						<label for="train_name">Nom du train : </label>
						<input type="text" class="form-control" name="train_name" id="train_name" placeholder="Train name"></input>
					</div>
          <?php if($error !== null): ?>
  					<div class="alert alert-danger">
  	          <?php echo $error; ?>
  	        </div>
          <?php endif; ?>
					<input type="submit" class="btn btn-primary"></input>
				</form>
			</div>
	  </div>

    <script type="text/javascript" src="./adminlte/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="./adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>