<?php
// src/index.php
require_once __DIR__ . "/../autoload.php" ;
require_once __DIR__ . "/includes/connection.php";

session_start();

verify_connection();
$user = get_user();

if(!isset($_GET['train_id']))
{
	header("Location: index.php?error=no_train_id");
	die("Redirect");
}
$repo = $entityManager->getRepository(Entity\Train::class);
$train = $repo->find($_GET['train_id']);
if(!$train)
{
	header("Location: index.php?error=bad_train_id");
	die("Redirect");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Connexion - Balance ton train</title>

    <link rel="stylesheet" href="./adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="./css/notation.css"/>
  </head>
  <body>
		<div id="container">
		  <div id="formContent">
				<h3>Balance ton train</h3>
				<p>D'après vous, quel est le niveau de propreté de ce train?</p>
				<div id="starContainer">
					<div>
						<img src="./img/star_empty.jpg"/>
						<img src="./img/star_full.jpg"/>
					</div>
					<div>
						<img src="./img/star_empty.jpg"/>
						<img src="./img/star_full.jpg"/>
					</div>
					<div>
						<img src="./img/star_empty.jpg"/>
						<img src="./img/star_full.jpg"/>
					</div>
					<div>
						<img src="./img/star_empty.jpg"/>
						<img src="./img/star_full.jpg"/>
					</div>
					<div>
						<img src="./img/star_empty.jpg"/>
						<img src="./img/star_full.jpg"/>
					</div>
				</div>
				<br><br>
				<button id="send" class="btn btn-info">Envoyer ma réponse</button>
			</div>
	  </div>

    <script type="text/javascript" src="./adminlte/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="./adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="./js/notation.js"></script>
  </body>
</html>
