<?php
require_once 'config.php';
require_once 'session.php';
require_once 'user.php';

if(isset($_SESSION['bUserLoggedIn']) &&
	$_SESSION['bUserLoggedIn'] === true) {
	if($_SESSION['userType'] === 0) {
		header("location:adminDashboard.php");
	} else {
		header("location:userDashboard.php");
	}
	exit();
}

$error_msg = "";
if(isset($_POST) && isset($_POST['submit'])) {
	if(!isset($_POST['username']) ||
		empty($_POST['username'])) {
		$error_msg = "Please enter username";
	} else if (!isset($_POST['password']) ||
		empty($_POST['password'])) {
		$error_msg = "Please enter password";
	} else {
		$obj = new user();
		$userData = $obj->validateUser($dbConn, $_POST['username'], $_POST['password']);
		if(isset($userData) && $userData !== null) {
			$_SESSION['bUserLoggedIn'] = true;
			$_SESSION['userType'] = $userData['user_type'];
			$_SESSION['userData'] = $userData;
			if($_SESSION['userType'] === 0) {
				header("location:adminDashboard.php");
			} else {
				header("location:userDashboard.php");
			}
			exit();
		} else {
			$error_msg = "Username or password is incorrect";
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="libs/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="stylesheet/main.css">
	<script type="text/javascript" src="libs/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript" src="script/main.js"></script>
	<script type="text/javascript" src="libs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-default">
		    <ul class="nav navbar-nav navbar-right">
		    	<li><a href="index.php">Home</a></li>
		        <li><a href="login.php" class="menu-link">Login</a></li>
		    </ul>
		</nav>
	  	<div class="jumbotron">
		<form method="post" action="#">
			<div class="row">
				<div class="col-sm-4 text-right">
					<label>User Name</label>
				</div>
				<div class="col-sm-4">
					<input type="text" id="username" name="username" class="form-control" 
					value="<?php if(isset($_POST['username'])) echo $_POST['username'];?>"></input>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-4 text-right">
					<label>Password</label>
				</div>
				<div class="col-sm-4">
					<input type="password" id="password" name="password" class="form-control" 
					value="<?php if(isset($_POST['password'])) echo $_POST['password'];?>"></input>
				</div>		
			</div>
			<div class="row">
				<div class="col-sm-4">
				</div>
				<div class="col-sm-4">
					<a href="forgotPassword.php">Forgot Password?</a>
				</div>		
			</div>
			<br>
			<div class="row">
				<div class="col-sm-4">
				</div>
				<div class="col-sm-4">
					<label id="error_msg" class="text-danger"><?=$error_msg?></label>
				</div>		
			</div>
			<br>
			<div class="row">
				<div class="col-sm-4">
				</div>
				<div class="col-sm-4 text-center">
					<input type="submit" id="submit" name="submit" value="Login" class="btn btn-success" onclick="return validateLogin();"></input>
				</div>		
			</div>
		</form>
		</div>
	</div>
</body>
</html>