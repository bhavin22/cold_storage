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
$arrUser = array();
if(isset($_POST)) {
	if(isset($_POST['submit'])) {
		if(!isset($_POST['company_name']) ||
			empty($_POST['company_name'])) {
			$error_msg = "Please enter company name";
		} else if(!isset($_POST['user_name']) ||
			empty($_POST['user_name'])) {
			$error_msg = "Please enter user name";
		} else if (!isset($_POST['email']) ||
			empty($_POST['email'])) {
			$error_msg = "Please enter valid email address";
		} else if (!isset($_POST['ip']) ||
			empty($_POST['ip'])) {
			$error_msg = "Please enter valid ip address";
		} else if (!isset($_POST['password']) ||
			empty($_POST['password'])) {
			$error_msg = "Please enter valid password";
		} else if ($_POST['repassword'] !== $_POST['password']) {
			$error_msg = "Both password should be same";
		} else if(!isset($_POST['address1']) ||
			empty($_POST['address1'])) {
			$error_msg = "Please enter address1";
		} else if(!isset($_POST['address2']) ||
			empty($_POST['address2'])) {
			$error_msg = "Please enter address2";
		} else if(!isset($_POST['city']) ||
			empty($_POST['city'])) {
			$error_msg = "Please enter city";
		} else if(!isset($_POST['country']) ||
			empty($_POST['country'])) {
			$error_msg = "Please enter country";
		} else if(!isset($_POST['zip_code']) ||
			empty($_POST['zip_code'])) {
			$error_msg = "Please enter zip code";
		} else if(!isset($_POST['phone_number']) ||
			empty($_POST['phone_number'])) {
			$error_msg = "Please enter phone number";
		} else {
			$obj = new user();
			$response = $obj->createUser($dbConn, $_POST['company_name'], $_POST['user_name'], $_POST['email'], $_POST['ip'], $_POST['password'], $_POST['address1'], $_POST['address2'], $_POST['city'], $_POST['country'], $_POST['zip_code'], $_POST['phone_number']);
			if($response->bUserExist) {
				$error_msg = "User_name already exist";
			} else {
				$arrUser = $response->arrUser;
				unset($_POST);
			}
		}
	} else if(isset($_POST['delete'])) {
		$obj = new user();
		$arrUser = $obj->deleteUsers($dbConn, $_POST['userId']);
	} else {
		$obj = new user();
		$arrUser = $obj->getUsers($dbConn);
	}
} else {
	$obj = new user();
	$arrUser = $obj->getUsers($dbConn);
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
		<nav class="navbar navbar-default">
		    <ul class="nav navbar-nav navbar-right">
		    	<li><a href="index.php">Home</a></li>
		        <li><a href="logout.php" class="menu-link">Logout</a></li>
		    </ul>
		</nav>
  		<div class="jumbotron">

  			<ul class="nav nav-tabs">
			  	<li class="active"><a data-toggle="tab" href="#addUser">Add User</a></li>
			  	<li><a data-toggle="tab" href="#deleteUser">Delete User</a></li>
			  	<li><a data-toggle="tab" href="#editUser">Edit User</a></li>
			  	<li><a data-toggle="tab" href="#addProject">Add Project</a></li>
			</ul>

			<div class="tab-content">
			  	<div id="addUser" class="tab-pane fade in active">
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
							<div class="col-sm-6 bottom-padding">
								<input type="text" id="company_name" name="company_name" class="form-control" placeholder="Company Name"
								value="<?php if(isset($_POST['company_name'])) echo $_POST['company_name'];?>"></input>
							</div>
							<div class="col-sm-6 bottom-padding">
								<input type="text" id="user_name" name="user_name" class="form-control" placeholder="User Name"
								value="<?php if(isset($_POST['user_name'])) echo $_POST['user_name'];?>"></input>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 bottom-padding">
								<input type="text" id="email" name="email" class="form-control" placeholder="Email Address"
								value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>"></input>
							</div>
							<div class="col-sm-6 bottom-padding">
								<input type="text" id="ip" name="ip" class="form-control" placeholder="IP Address"
								value="<?php if(isset($_POST['ip'])) echo $_POST['ip'];?>"></input>
							</div>	
						</div>
						<div class="row">
							<div class="col-sm-6 bottom-padding">
								<input type="text" id="address1" name="address1" class="form-control" placeholder="Address 1"
								value="<?php if(isset($_POST['address1'])) echo $_POST['address1'];?>"></input>
							</div>
							<div class="col-sm-6 bottom-padding">
								<input type="text" id="address2" name="address2" class="form-control" placeholder="Address 2"
								value="<?php if(isset($_POST['address2'])) echo $_POST['address2'];?>"></input>
							</div>		
						</div>
						<div class="row">
							<div class="col-sm-6 bottom-padding">
								<input type="text" id="city" name="city" class="form-control" placeholder="City"
								value="<?php if(isset($_POST['city'])) echo $_POST['city'];?>"></input>
							</div>		
							<div class="col-sm-6 bottom-padding">
								<input type="text" id="country" name="country" class="form-control" placeholder="Country"
								value="<?php if(isset($_POST['country'])) echo $_POST['country'];?>"></input>
							</div>	
						</div>
						<div class="row">
							<div class="col-sm-6 bottom-padding">
								<input type="text" id="zip_code" name="zip_code" class="form-control" placeholder="Zip Code"
								value="<?php if(isset($_POST['zip_code'])) echo $_POST['zip_code'];?>"></input>
							</div>
							<div class="col-sm-6 bottom-padding">
								<input type="text" id="phone_number" name="phone_number" class="form-control" placeholder="Phone Numver"
								value="<?php if(isset($_POST['phone_number'])) echo $_POST['phone_number'];?>"></input>
							</div>	
						</div>
						<div class="row">
							<div class="col-sm-6 bottom-padding">
								<input type="password" id="password" name="password" class="form-control" placeholder="Password"
								value="<?php if(isset($_POST['password'])) echo $_POST['password'];?>"></input>
								<span class="field-info">Atleast 6 characters, 1 number and 1 special character</span>
							</div>	
							<div class="col-sm-6 bottom-padding">
								<input type="password" id="repassword" name="repassword" class="form-control" placeholder="Confirm Password"
								value="<?php if(isset($_POST['repassword'])) echo $_POST['repassword'];?>"></input>
							</div>		
						</div>
						<div class="row">
							<div class="col-sm-3">
							</div>
							<div class="col-sm-6 bottom-padding">
								<input type="submit" id="submit" name="submit" value="Create User" class="btn btn-success btn-block" onclick="return validateUserData();"></input>
							</div>		
						</div>
					</form>
			  	</div>
			  	<div id="deleteUser" class="tab-pane fade in active">
			  	<br>
				    <table class="table">
			      		<thead>
			      			<tr>
			      			<th>select</th>
			      			<th>User Name</th>
			      			<th>Company Name</th>
			      			<th>IP</th>
			      			<th>Phone Number</th>
			      			<th></th>
			      			<th></th>
			      			</tr>
			      		</thead>
			      		<tbody>	      	
				        <?php
				        for ($i=0; $i < count($arrUser); $i++) { 
				        	echo "<tr>";
				        	echo "<td><input type='checkbox' class='userCheckbox' value='".$arrUser[$i]->id."'></input></td>";
				        	echo "<td>".$arrUser[$i]->user_name."</td>";
				        	echo "<td>".$arrUser[$i]->company_name."</td>";
				        	echo "<td>".$arrUser[$i]->user_ip."</td>";
				        	echo "<td>".$arrUser[$i]->phone_number."</td>";
				        	
				        	echo "</tr>";
				        }
				        ?>
			        	</tbody>
			        </table>
			        
	        		<form method="post">
	        			<input type="hidden" name="userId" class="userId" value=""></input>
	        			<div class="row">
				        	<div class="col-xs-3"></div>
				        	<div class="col-xs-6">
				        		<input type="submit" id="delete" class='btn btn-success btn-block' name="delete" value="Delete User"></input>
				        	</div>
				        </div>
	        		</form>
			  	</div>
			  	<div id="editUser" class="tab-pane fade in active">
			  		<br>
		  			<div class="row">
		  				<div class="col-xs-3"></div>
		  				<div class="col-xs-6">
		  					<select id="editUserList" class="form-control">
					  			<option selected disabled>Select User To Edit</option>
					  			<?php
						        for ($i=0; $i < count($arrUser); $i++) { 
						        	
						        	echo "<option value='".$arrUser[$i]->id."'>".$arrUser[$i]->user_name."</option>";
						        }
						        ?>
					  		</select>
		  				</div>
		  			</div>
			  	</div>
			  	<div id="addProject" class="tab-pane fade in active">
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
							<div class="col-sm-6 bottom-padding">
								<input type="text" id="project_title" name="title" class="form-control" placeholder="Project Title"
								value="<?php if(isset($_POST['project_title'])) echo $_POST['project_title'];?>"></input>
							</div>
							<div class="col-sm-6 bottom-padding">
								<input type="text" id="project_description" name="project_description" class="form-control" placeholder="Project Description"
								value="<?php if(isset($_POST['project_description'])) echo $_POST['project_description'];?>"></input>
							</div>
							<div class="col-sm-6 bottom-padding">
								<input type="file" id="project_image" name="project_image" accept="image/*">
							</div>		
						</div>
						<div class="row">
							<div class="col-sm-3">
							</div>
							<div class="col-sm-6 bottom-padding">
								<input type="submit" id="submit_project" name="submit_project" value="Create Project" class="btn btn-success btn-block" onclick="return validateUserData();"></input>
							</div>		
						</div>
					</form>
			  	</div>
			</div>
		</div>
	</div>
</body>
</html>