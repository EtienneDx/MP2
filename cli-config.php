<?php
require_once "autoload.php";

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
