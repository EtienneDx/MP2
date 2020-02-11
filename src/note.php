<?php

require_once __DIR__ . "/../autoload.php" ;
require_once __DIR__ . "/includes/connection.php";

use Entity\Notation;

session_start();

if(!isset($_POST['train_id']))
{
	header("Location: index.php?error=no_train_id");
	die("Redirect");
}
$repo = $entityManager->getRepository(Entity\Train::class);
$train = $repo->find($_POST['train_id']);
if(!$train)
{
	header("Location: index.php?error=bad_train_id");
	die("Redirect");
}

if(!isset($_POST['note']))
{
	header("Location: index.php?error=no_note_provided");
	die("Redirect");
}
$note = intval($_POST['note']);
if($note <= 0 || $note > 5)
{
	header("Location: index.php?error=bad_note" . $note);
	die("Redirect");
}

$user = get_user();
$notation = new Notation($note, new DateTime("now"), $user ? $user : null, $train);

$entityManager->persist($notation);

$entityManager->flush();

$id = $notation->getId();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Merci d'avoir noté ce train - Balance ton train</title>

    <link rel="stylesheet" href="./adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="./css/notation.css"/>
  </head>
  <body>
		<div id="container">
		  <div id="formContent">
				<h3>Balance ton train</h3>
				<p>Merci d'avoir noté la propreté de ce train, nous allons communiquer ces résultats aux équipes de nettoyage au plus vite.</p>
				<?php if($user): ?>
					<p>Votre score a été actualisé avec cette notation!</p>
					<a href="index.php" class="btn btn-success">Voir mon score</a>
				<?php
					else:
						$_SESSION['redirect'] = "claim_note.php?note=" . $id;
				?>
					<p>Pour modifier votre score et gagner des badges, veuillez vous connecter, ou rejoindre le réseau Balance ton train!</p>
					<div>
						<a href="signup.php" class="btn btn-info" style="margin-right: 10px;">S'inscrire</a><a href="connect.php" class="btn btn-success">Se connecter</a>
					</div>
				<?php endif; ?>
			</div>
	  </div>

    <script type="text/javascript" src="./adminlte/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="./adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="./js/notation.js"></script>
  </body>
</html>
