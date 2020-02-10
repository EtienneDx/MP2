<?php

use \Entity\User;

function is_connected()
{
	if(!isset($_SESSION['password']))
		return false;
	$user = get_user();
	if($user && password_verify($_SESSION['password'], $user->getPassword()))
		return true;
	return false;
}

function verify_connection()
{
	if(!is_connected())
	{
		header('Location: connect.php');
		die('Redirect');
	}
}

function get_user($username = "")
{
	global $entityManager;
	if($username === "" && isset($_SESSION['username']))
		$username = $_SESSION['username'];
	if(!$username || $username === "")
		return false;
	$repo = $entityManager->getRepository(User::class);
	return $repo->findOneBy(["username" => $username]);
}
