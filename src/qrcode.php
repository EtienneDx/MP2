<?php

require_once _DIR_ . "/../autoload.php" ;
require_once _DIR_ . "/includes/connection.php";

session_start();

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
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Qr code - Balance ton train</title>

		<link rel="stylesheet" href="./adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="./css/notation.css"/>
	</head>
	<body>
		<div id="container">
			<div id="formContent">
				<h3>Qr code</h3>
				<img src="https://api.qrserver.com/v1/create-qr-code/?data=http://localhost:8000/notation.php?train_id=<?php echo $train->getId();?>&size=250x250" alt="" title="" />
			</div>
		</div>
		<script type="text/javascript" src="./adminlte/bower_components/jquery/dist/jquery.min.js"></script>
		<script type="text/javascript" src="./adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="./js/notation.js"></script>
	</body>
</html>
