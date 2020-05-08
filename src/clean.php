<?php

require_once __DIR__ . "/../autoload.php" ;
require_once __DIR__ . "/includes/connection.php";

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

$train->setLastCleanup(new DateTime("now"));

$entityManager->flush();


header("Location: index.php");
die("Redirect");
