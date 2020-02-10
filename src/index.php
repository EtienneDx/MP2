<?php
// src/index.php
require_once __DIR__ . "/../autoload.php" ;
require_once __DIR__ . "/includes/connection.php";

session_start();

verify_connection();

echo("sth");
