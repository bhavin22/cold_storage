<?php
require_once 'session.php';

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
	<link rel="stylesheet" type="text/css" href="libs/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="stylesheet/main.css">
	<script type="text/javascript" src="libs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
  		<div class="jumbotron">
			<a href="#" class="btn btn-success">View</a>
			<a href="logout.php" class="btn btn-success">Logout</a>
		</div>
	</div>
</body>
</html>