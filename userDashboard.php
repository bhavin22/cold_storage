<?php
require_once 'config.php';
require_once 'session.php';
require_once 'user.php';

if(!isset($_SESSION['bUserLoggedIn']) ||
	$_SESSION['bUserLoggedIn'] !== true) {
	header("location:login.php");
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/main.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-default">
		    <ul class="nav navbar-nav navbar-right">
		    	<li><a href="index.php">Home</a></li>
		        <li><a href="logout.php" class="menu-link">Logout</a></li>
		    </ul>
		</nav>
  		<div class="jumbotron">
  			<div class="row">
  				<div class="col-sm-12 text-center">
  					<?= $_SESSION['userData']['company_name']?>
  				</div>
  			</div>
  			<br>
  			<div class="row">
  				<div class="col-sm-12 text-center">
  					<a href="http://<?=$_SESSION['userData']['user_ip']?>" target="_blank" class="btn btn-success">View</a>
  				</div>
  			</div>
  		</div>
	</div>
</body>
</html>