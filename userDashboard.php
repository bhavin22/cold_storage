<?php
require_once 'config.php';
require_once 'session.php';
require_once 'user.php';
require_once 'siteContent.php';

if(!isset($_SESSION['bUserLoggedIn']) ||
	$_SESSION['bUserLoggedIn'] !== true ||
	$_SESSION['userType'] !== 1) {
	header("location:login.php");
	exit();
}
$userData = array();
$error_msg = "";
$edit_profile_error_msg = "";
if(isset($_POST) && isset($_POST['submit'])) {	
	if(!isset($_POST['author']) ||
		empty($_POST['author'])) {
		$error_msg = "Please enter customer name.";
	} else if(!isset($_POST['company']) ||
		empty($_POST['company'])) {
		$error_msg = "Please enter company name.";
	} else if(!isset($_POST['designation']) ||
		empty($_POST['designation'])) {
		$error_msg = "Please enter designation.";
	} else if(!isset($_POST['testimonial']) ||
		empty($_POST['testimonial'])) {
		$error_msg = "Please enter testimonial.";
	} else {
		$obj = new siteContent();
		$obj->addTestimonial($dbConn, $_POST['author'], $_POST['company'], $_POST['designation'], $_POST['testimonial']);
		unset($_POST);
	}
} else if(isset($_POST) && isset($_POST['editProfile'])) {
	if(!isset($_POST['phone_number']) ||
		empty($_POST['phone_number'])) {
		$error_msg = "Please enter phone number.";
		exit();
	} else {
		$obj = new user();
		$response = $obj->editUserProfile($dbConn, $_SESSION['userData']['id'], $_POST['address1'], $_POST['address2'], $_POST['city'], $_POST['country'], $_POST['zip_code'], $_POST['phone_number']);
	}
} 

$obj = new user();
$userData = $obj->getUserData($dbConn, $_SESSION['userData']['id']);

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/main.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="script/main.js"></script>
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
  			<div class="row">
  				<h3 class="col-sm-12 text-center">
  					<?= $_SESSION['userData']['company_name']?>
  				</h3>
  			</div>
  			<br>
  			<ul class="nav nav-tabs">
			  	<li class="active"><a data-toggle="tab" href="#view">View</a></li>
			  	<li><a data-toggle="tab" href="#editProfile">Edit Profile</a></li>
			  	<li><a data-toggle="tab" href="#addTestimonial">Add Testimonial</a></li>
			</ul>

			<div class="tab-content">
			  	<div id="view" class="tab-pane fade in active">
			  		<br>
			  		<div class="text-center">
			  		<form method="post" action="remoteDesktop.php">
			  			<input type="hidden" name="user_ip" id="user_ip" value="<?=$_SESSION['userData']['user_ip']?>">
			  			<input class="btn btn-small btn-success" type="submit" name="submit" id="view" value="view">
			  		</form>
			  		</div>
			  		
			  		<div class="text-center">
  						<!-- <a href="http://<?=$_SESSION['userData']['user_ip']?>:4080" target="_blank" class="btn btn-success">View</a> -->
  					</div>
			  	</div>
			
				<div id="editProfile" class="tab-pane fade">
					<br>
					<form method="post" action="#">
						<div class="row">
							<div class="col-sm-3">
							</div>
							<div class="col-sm-6 text-center">
								<label id="edit_profile_error_msg" class="text-danger"><?=$edit_profile_error_msg?></label>
							</div>		
						</div>
						<br>
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
								<input type="submit" id="editProfile" name="editProfile" value="Save" class="btn btn-success btn-block" onclick="return validateEditProfileData();"></input>
							</div>	
						</div>
						</form>
				</div>
			  	<div id="addTestimonial" class="tab-pane fade">
			  		<br>
			  		<form method="post" action="#">
			  			<div class="row">
							<div class="col-sm-3">
							</div>
							<div class="col-sm-6 text-center">
								<label id="error_msg" class="text-danger"><?=$error_msg?></label>
							</div>		
						</div>
						<br>
						<div class="row">
							<div class="col-sm-3">
							</div>
							<div class="col-sm-6">
								<input type="text" id="author" name="author" class="form-control" placeholder="Customer Name"
								value="<?php if(isset($_POST['author'])) echo $_POST['author'];?>"></input>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-3">
							</div>
							<div class="col-sm-6">
								<input type="text" id="company" name="company" class="form-control" placeholder="Company Name"
								value="<?php if(isset($_POST['company'])) echo $_POST['company'];?>"></input>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-3">
							</div>
							<div class="col-sm-6">
								<input type="text" id="designation" name="designation" class="form-control" placeholder="Customer Designation"
								value="<?php if(isset($_POST['designation'])) echo $_POST['designation'];?>"></input>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-3">
							</div>
							<div class="col-sm-6">
								<textarea id="testimonial" name="testimonial" class="form-control" placeholder="Testimonial"
								value="<?php if(isset($_POST['testimonial'])) echo $_POST['testimonial'];?>"></textarea> 
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-3">
							</div>
							<div class="col-sm-6 bottom-padding">
								<input type="submit" id="submit" name="submit" value="Add" class="btn btn-success btn-block" onclick="return validateTestimonialData();"></input>
							</div>		
						</div>
					</form>
			  	</div>
			</div>
  		</div>
	</div>
</body>
</html>