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
	if(!isset($_POST['user_name']) ||
		empty($_POST['user_name'])) {
		$error_msg = "Please enter user name.";
	} else if (!isset($_POST['password']) ||
		empty($_POST['password'])) {
		$error_msg = "Please enter password.";
	} else {
		$obj = new user();
		$userData = $obj->validateUser($dbConn, $_POST['user_name'], $_POST['password']);
		if(isset($userData) && $userData !== null && isset($userData['id'])) {
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
			$error_msg = "Username or password is incorrect.";
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/main.css">
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src="script/main.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-default custom-nav-bar">
			<a class="navbar-brand logo" href="index.php"></a> 
		    <ul class="nav navbar-nav navbar-right">
		    	<li><a href="index.php" class="menu-link">Home</a></li>
		    </ul>
		</nav>
	  	<div class="jumbotron">
		<form method="post" action="#">
			<div class="row">
				<div class="col-sm-3">
				</div>
				<div class="col-sm-6">
					<label id="error_msg" class="text-danger"><?=$error_msg?></label>
				</div>		
			</div>
			<br>
			<div class="row">
				<div class="col-sm-3">
				</div>
				<div class="col-sm-6">
					<input type="text" id="user_name" name="user_name" class="form-control"  placeholder="User Name"
					value="<?php if(isset($_POST['user_name'])) echo $_POST['user_name'];?>"></input>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-3">
				</div>
				<div class="col-sm-6">
					<input type="password" id="password" name="password" class="form-control" placeholder="Password" 
					value="<?php if(isset($_POST['password'])) echo $_POST['password'];?>"></input>
				</div>		
			</div>
			<br>
			<div class="row">
				<div class="col-sm-3">
				</div>
				<div class="col-sm-6">
					<input type="submit" id="submit" name="submit" value="Login" class="btn btn-success btn-block" onclick="return validateLogin();"></input>
				</div>		
			</div>
			<br>
			<div class="row">
				<div class="col-sm-3">
				</div>
				<div class="col-sm-6 text-center">
					<a href="forgotPassword.php">Forgot Password?</a>
				</div>		
			</div>
		</form>
		</div>
	</div>
</body>
</html>