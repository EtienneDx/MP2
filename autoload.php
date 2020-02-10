<?php
require_once 'vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$dotenv = Dotenv\Dotenv::create(__DIR__);// load environment variables
$dotenv->load();
$dotenv->required('DEV')->isBoolean();
$dotenv->required('DATABASE_URL');

$ormConfig = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $_ENV["DEV"], null, null, false);

$entityManager = EntityManager::create(array('url' => $_ENV["DATABASE_URL"]), $ormConfig);
