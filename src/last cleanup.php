<?php

require_once __DIR__ . "/../autoload.php" ;
require_once __DIR__ . "/includes/connection.php";

session_start();

$repo = $entityManager->getRepository(Entity\Train::class);
$listetrain = $repo->findall();

foreach ($listetrain as &$train) {
	
	if(!$train)
	{
		header("Location: index.php?error=bad_train_id");
		die("Redirect");
	}

    <?php
	echo $train->getName();
	echo ' ' ;
	echo $train->getLastCleanup();
	echo('<td>');
	
	?>

}

?>