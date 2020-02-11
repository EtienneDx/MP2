<?php

require_once __DIR__ . "/../autoload.php" ;
require_once __DIR__ . "/includes/connection.php";

session_start();

verify_connection();
$user = get_user();

if(!isset($_GET['note']))
{
	header("Location: index.php?error=no_note_specified");
	die("Redirect");
}
$repo = $entityManager->getRepository(Entity\Notation::class);
$note = $repo->find($_GET['note']);
if(!$note)
{
	header("Location: index.php?error=bad_note_id");
	die("Redirect");
}
if(!is_null($note->getUser()))
{
	header("Location: index.php?error=already_claimed_note");
	die("Redirect");
}

$note->setUser($user);

$entityManager->flush();

header("Location: index.php?info=claimed_note");
die("Redirect");
