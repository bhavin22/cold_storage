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

	if(!isset($_POST['password']) || 
		empty($_POST['password'])) {
		$error_msg = "Please enter valid password";
	} else if(!isset($_POST['repassword']) || 
		empty($_POST['repassword']) || 
		$_POST['repassword'] !== $_POST['password']) {
		$error_msg = "Both password should be same";
	} else {
		$obj = new user();
		$obj->resetPassword($dbConn, $_GET['email'], $_POST['password']);
		
		header("location:login.php");
		exit();
	}

} else if(isset($_GET) && isset($_GET['email']) && isset($_GET['token'])) {
	$obj = new user();
	$bValid = $obj->validateResetPassword($dbConn, $_GET['email'], strval($_GET['token']));
	if(!isset($bValid) || !$bValid) {
		header("location:login.php");
		exit();
	}
} else {
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
	<script type="text/javascript" src="script/main.js"></script>
	<script src="js/bootstrap.min.js"></script>
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
					<label>Password</label>
				</div>
				<div class="col-sm-4">
					<input type="password" id="password" name="password" class="form-control" 
					value="<?php if(isset($_POST['password'])) echo $_POST['password'];?>"></input>
					<span class="field-info">Atleast 6 characters, 1 number and 1 special character</span>
				</div>		
			</div>
			<br>
			<div class="row">
				<div class="col-sm-4 text-right">
					<label>Confirm Password</label>
				</div>
				<div class="col-sm-4">
					<input type="password" id="repassword" name="repassword" class="form-control" 
					value="<?php if(isset($_POST['repassword'])) echo $_POST['repassword'];?>"></input>
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
					<input type="submit" id="submit" name="submit" value="Reset Password" class="btn btn-success" onclick="return validatePasswords();"></input>
				</div>		
			</div>
		</form>
		</div>
	</div>
</body>
</html>