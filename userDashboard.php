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
$error_msg = "";
if(isset($_POST) && isset($_POST['submit'])) {	
	if(!isset($_POST['author']) ||
		empty($_POST['author'])) {
		$error_msg = "Please enter customer name";
	} else if(!isset($_POST['company']) ||
		empty($_POST['company'])) {
		$error_msg = "Please enter company name";
	} else if(!isset($_POST['designation']) ||
		empty($_POST['designation'])) {
		$error_msg = "Please enter designation";
	} else if(!isset($_POST['testimonial']) ||
		empty($_POST['testimonial'])) {
		$error_msg = "Please enter testimonial";
	} else {
		$obj = new siteContent();
		$obj->addTestimonial($dbConn, $_POST['author'], $_POST['company'], $_POST['designation'], $_POST['testimonial']);
		unset($_POST);
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
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="script/main.js"></script>
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
  				<h3 class="col-sm-12 text-center">
  					<?= $_SESSION['userData']['company_name']?>
  				</h3>
  			</div>
  			<br>
  			<ul class="nav nav-tabs">
			  	<li class="active"><a data-toggle="tab" href="#view">View</a></li>
			  	<li><a data-toggle="tab" href="#addTestimonial">Add Testimonial</a></li>
			</ul>

			<div class="tab-content">
			  	<div id="view" class="tab-pane fade in active">
			  		<br>
			  		<div class="text-center">
  						<a href="http://<?=$_SESSION['userData']['user_ip']?>" target="_blank" class="btn btn-success">View</a>
  					</div>
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
								<input type="submit" id="submit" name="submit" value="Add Testimonial" class="btn btn-success btn-block" onclick="return validateTestimonialData();"></input>
							</div>		
						</div>
					</form>
			  	</div>
			</div>
  		</div>
	</div>
</body>
</html>