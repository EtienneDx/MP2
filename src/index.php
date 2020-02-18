<?php
// src/index.php
require_once __DIR__ . "/../autoload.php" ;
require_once __DIR__ . "/includes/connection.php";

session_start();

verify_connection();
$user = get_user();

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Balance ton train</title>

    <link rel="stylesheet" href="./adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="./adminlte/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="./adminlte/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="./adminlte/dist/css/AdminLTE.min.css">
    <!-- custom skin -->
    <link rel="stylesheet" href="./css/alte-skin.css">
	</head>
	<body class="alte-skin fixed">
		<div class="wrapper">
			<header class="main-header">
				<a href="index.php" class="logo">
					<!-- mini logo for sidebar mini 50x50 pixels -->
					<span class="logo-mini">BtT</span>
					<!-- logo for regular state and mobile devices -->
					<img class="logo-lg" src="img/logo.png" alt="Balance ton Train" style="max-width: 100%;max-height: 100%"/>
				</a>

				<nav class="navbar navbar-static-top" role="navigation">
					<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
						<span class="sr-only">Toggle navigation</span>
					</a>

					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<!-- The user image in the navbar-->
									<!-- hidden-xs hides the username on small devices so only the image appears. -->
									<span class="hidden-xs"><?php echo $user->getUsername(); ?></span>
								</a>
								<ul class="dropdown-menu">
									<!-- The user image in the menu -->
									<li class="user-header">
										<p>
											<?php echo $user->getUsername(); ?>
										</p>
									</li>
									<!-- Menu Footer-->
									<li class="user-footer">
										<div class="pull-left">
											<a href="#" class="btn btn-default btn-flat">Profil</a>
										</div>
										<div class="pull-right">
											<a href="./disconnect.php" class="btn btn-default btn-flat">Se deconnecter</a>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</nav>
			</header>
			<aside class="main-sidebar">
				<section class="sidebar">
					<ul class="sidebar-menu" data-widget="tree">
						<li class="header">Balance ton Train<small> - Version 1.0</small></li>
						<!-- Optionally, you can add icons to the links -->
						<li class="active"><a href="index.php"><i class="fa fa-dashboard"></i> <span>Accueil</span></a></li>
					</ul>
				</section>
			</aside>
			<div class="content-wrapper content-wrapper-open">
        <section class="content container-fluid">
          <div id="infos" class="box">
						<div class="box-header with-border">
							<h3 class="box-title">Statistiques</h3>
						</div>
						<div class="box-body">
							<?php if($user->getTrainsCount() == 0): ?>
								Vous n'avez jamais voté sur la propreté d'un train!
							<?php else: ?>
								Vous avez voté <?php echo count($user->getNotations()); ?> fois sur la propreté
								<?php if($user->getTrainsCount() > 1): ?>
									de <?php echo $user->getTrainsCount(); ?> trains différents pour le moment.
								<?php else: ?>
									d'un seul train pour le moment.
								<?php endif; ?>
							<?php endif; ?>
						</div>
          </div>
          <div id="temp" class="box">
						<div class="box-header with-border">
							<h3 class="box-title">Liens temporaires</h3>
						</div>
						<div class="box-body">
							<?php
							$train = $em->getRepository(\Entity\Train::class)->findOneBy([]);
							?>
							<ul>
								<?php if($train): ?>
									<li><a href="./notation.php?train_id=1"</li>
								<?php else: ?>
									<li>Aucun train n'a été créé, impossible d'en noter pour le moment! (Il faut temporairement le créer directement via phpmyadmin)</li>
								<?php endif; ?>
							</ul>
						</div>
          </div>
        </section>
      </div>
		</div>

		<!-- jQuery 3 -->
    <script src="./adminlte/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="./adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./adminlte/dist/js/adminlte.min.js"></script>
    <script src="./adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="./adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="./adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="./adminlte/bower_components/fastclick/lib/fastclick.js"></script>
	</body>
</html>
