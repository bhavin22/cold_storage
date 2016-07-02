<?php
require_once 'config.php';
require_once 'session.php';
require_once 'user.php';
require_once 'email.php';

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
	if(!isset($_POST['email']) ||
		empty($_POST['email'])) {
		$error_msg = "Please enter valid email";
	} else {
		$obj = new user();
		$response = $obj->validateEmail($dbConn, $_POST['email']);
		if(isset($response) && $response->bEmailExist) {
			$obj = new email();
			$error_msg = $obj->sendEmail($_POST['email'], $response->token);
		} else {
			$error_msg = "Email does not exist";
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
					<label>Email</label>
				</div>
				<div class="col-sm-4">
					<input type="text" id="email" name="email" class="form-control" 
					value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>"></input>
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
					<input type="submit" id="submit" name="submit" value="Send Email" class="btn btn-success" onclick="return validateEmail();"></input>
				</div>		
			</div>
		</form>
		</div>
	</div>
</body>
</html>