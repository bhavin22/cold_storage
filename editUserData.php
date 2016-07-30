<?php
require_once 'config.php';
require_once 'session.php';
require_once 'user.php';

if(!isset($_SESSION['bUserLoggedIn']) ||
	$_SESSION['bUserLoggedIn'] !== true || 
	$_SESSION['userType'] !== 0) {
	header("location:login.php");
	exit();
}

$error_msg = "";
$userData = array();
if(isset($_POST) && isset($_POST['edit'])) {
	if(!isset($_POST['company_name']) ||
		empty($_POST['company_name'])) {
		$error_msg = "Please enter company name.";
	} else if (!isset($_POST['ip']) ||
		empty($_POST['ip'])) {
		$error_msg = "Please enter valid ip address.";
	} else if(!isset($_POST['phone_number']) ||
		empty($_POST['phone_number'])) {
		$error_msg = "Please enter phone number.";
	} else {
		$obj = new user();
		$response = $obj->editUser($dbConn, $_POST['id'], $_POST['company_name'], $_POST['ip'],  $_POST['address1'], $_POST['address2'], $_POST['city'], $_POST['country'], $_POST['zip_code'], $_POST['phone_number']);
		
		unset($_POST);
		header("location:adminDashboard.php");
	}
} else if(isset($_GET['id'])) {
	$obj = new user();
	$userData = $obj->getUserData($dbConn, $_GET['id']);
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
	<link rel="stylesheet" href="libs/font-awesome/css/font-awesome.min.css">
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src="script/main.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-default custom-nav-bar">
			<a class="navbar-brand logo" href="index.php"></a> 
		    <ul class="nav navbar-nav navbar-right">
		    	<li><a href="index.php">Home</a></li>
		    	<li><a href="logout.php" class="menu-link">Logout</a></li>
		    </ul>
		</nav>
  		<div class="jumbotron">
  		<h3 class="text-center">User : <?php if(isset($userData->user_name)) echo $userData->user_name; else if(isset($_POST['user_name'])) echo $_POST['user_name'];?></h3>
		
		<form method="post" action="#">
		<div class="row">
			<div class="col-sm-3">
			</div>
			<div class="col-sm-6 text-center">
				<label id="error_msg" class="text-danger"><?=$error_msg?></label>
			</div>		
		</div>
		<br>
		<input type="hidden" name="id" class="form-control"	value="<?php if(isset($userData->id)) echo $userData->id; else if(isset($_POST['id'])) echo $_POST['id'];?>"></input>
		<input type="hidden" name="user_name" class="form-control"	value="<?php if(isset($userData->user_name)) echo $userData->user_name; else if(isset($_POST['user_name'])) echo $_POST['user_name'];?>"></input>
		<div class="row">
			<div class="col-sm-6 bottom-padding">
				<input type="text" id="company_name" name="company_name" class="form-control" placeholder="Company Name"
				value="<?php if(isset($userData->company_name)) echo $userData->company_name; else if(isset($_POST['company_name'])) echo $_POST['company_name'];?>"></input>
			</div>
			<div class="col-sm-6 bottom-padding">
				<input type="text" id="ip" name="ip" class="form-control" placeholder="IP Address"
				value="<?php if(isset($userData->ip)) echo $userData->ip; else if(isset($_POST['ip'])) echo $_POST['ip'];?>"></input>
			</div>	
		</div>
		<div class="row">
			<div class="col-sm-6 bottom-padding">
				<input type="text" id="address1" name="address1" class="form-control" placeholder="Address 1"
				value="<?php if(isset($userData->address1)) echo $userData->address1; else if(isset($_POST['address1'])) echo $_POST['address1'];?>"></input>
			</div>
			<div class="col-sm-6 bottom-padding">
				<input type="text" id="address2" name="address2" class="form-control" placeholder="Address 2"
				value="<?php if(isset($userData->address2)) echo $userData->address2; else if(isset($_POST['address2'])) echo $_POST['address2'];?>"></input>
			</div>		
		</div>
		<div class="row">
			<div class="col-sm-6 bottom-padding">
				<input type="text" id="city" name="city" class="form-control" placeholder="City"
				value="<?php if(isset($userData->city)) echo $userData->city; else if(isset($_POST['city'])) echo $_POST['city'];?>"></input>
			</div>		
			<div class="col-sm-6 bottom-padding">
				<input type="text" id="country" name="country" class="form-control" placeholder="Country"
				value="<?php if(isset($userData->country)) echo $userData->country; else if(isset($_POST['country'])) echo $_POST['country'];?>"></input>
			</div>	
		</div>
		<div class="row">
			<div class="col-sm-6 bottom-padding">
				<input type="text" id="zip_code" name="zip_code" class="form-control" placeholder="Zip Code"
				value="<?php if(isset($userData->zip_code)) echo $userData->zip_code; else if(isset($_POST['zip_code'])) echo $_POST['zip_code'];?>"></input>
			</div>
			<div class="col-sm-6 bottom-padding">
				<input type="text" id="phone_number" name="phone_number" class="form-control" placeholder="Phone Number"
				value="<?php if(isset($userData->phone_number)) echo $userData->phone_number; else if(isset($_POST['phone_number'])) echo $_POST['phone_number'];?>"></input>
			</div>	
		</div>
		<div class="row">
			<div class="col-sm-6">
				<input type="submit" id="edit" name="edit" value="Save" class="btn btn-success btn-block" onclick="return validateEditUserData();"></input>
			</div>
			<div class="col-sm-6 bottom-padding">
				<input type="button" id="cancelEditing" value="Cancel" class="btn btn-success btn-block"></input>
			</div>		
		</div>
		</form>
		</div>
	</div>
</body>
</html>