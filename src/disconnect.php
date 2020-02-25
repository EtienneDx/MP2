<?php

require_once __DIR__ . "/../autoload.php" ;
require_once __DIR__ . "/includes/connection.php";
require_once __DIR__ . "/includes/deconnection.php";

session_start();

$error = null;
if(is_connected())// already connected
{
	clear_cookies();
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Déconnexion - Balance ton train</title>

    <link rel="stylesheet" href="./adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="./css/disconnect.css"/>
  </head>
  <body>
		<div id="container">
		  <div id="content">
				<div id="disconnect">Vous êtes bien déconnecté</div>
        <div class="box-body">
          <a href="connect.php" class="btn btn-info" id="go_back">Retourner sur le site</a>
        </div>
			</div>
	  </div>

    <script type="text/javascript" src="./adminlte/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="./adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>
