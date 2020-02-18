<?php

use \Entity\User;

function clear_cookies()
{
	unset($_SESSION['username'])
	unset($_SESSION['password'])
}