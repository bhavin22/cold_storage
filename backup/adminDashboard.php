<?php
require_once 'config.php';
require_once 'session.php';
require_once 'user.php';

if(!isset($_SESSION['bUserLoggedIn']) ||
	$_SESSION['bUserLoggedIn'] !== true) {
	header("location:login.php");
	exit();
}

$error_msg = "";
$arrUser = array();
if(isset($_POST) && isset($_POST['submit'])) {
	if(!isset($_POST['username']) ||
		empty($_POST['username'])) {
		$error_msg = "Please enter username";
	} else if (!isset($_POST['email']) ||
		empty($_POST['email'])) {
		$error_msg = "Please enter valid email address";
	} else if (!isset($_POST['password']) ||
		empty($_POST['password'])) {
		$error_msg = "Please enter valid password";
	} else if (!isset($_POST['ip']) ||
		empty($_POST['ip'])) {
		$error_msg = "Please enter valid ip address";
	} else {
		$obj = new user();
		$response = $obj->createUser($dbConn, $_POST['username'], $_POST['email'], $_POST['password'], $_POST['ip']);
		if($response->bUserExist) {
			$error_msg = "Username already exist";
		} else {
			$arrUser = $response->arrUser;
			unset($_POST);
		}
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
	<link rel="stylesheet" type="text/css" href="libs/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="stylesheet/main.css">
	<script type="text/javascript" src="libs/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript" src="script/main.js"></script>
	<script type="text/javascript" src="libs/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>
	<!-- Modal -->
	<div id="userListModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Users</h4>
	      </div>
	      <div class="modal-body scrollable-div">
	      	<table class="table">
	      		<thead>
	      			<tr>
	      			<th>Username</th>
	      			<th>Email</th>
	      			<th>IP</th>
	      			</tr>
	      		</thead>
	      		<tbody>	      	
		        <?php
		        for ($i=0; $i < count($arrUser); $i++) { 
		        	echo "<tr>";
		        	echo "<td>".$arrUser[$i]['user_name']."</td>";
		        	echo "<td>".$arrUser[$i]['email']."</td>";
		        	echo "<td>".$arrUser[$i]['user_ip']."</td>";
		        	echo "</tr>";
		        }
		        ?>
	        	</tbody>
	        </table>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>
	<div class="container">
		<nav class="navbar navbar-default">
		    <ul class="nav navbar-nav navbar-right">
		    	<li><a href="index.php">Home</a></li>
		    	<li><a href="#" data-toggle="modal" data-target="#userListModal">User List</a></li>
		        <li><a href="logout.php" class="menu-link">Logout</a></li>
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
					<label>Email</label>
				</div>
				<div class="col-sm-4">
					<input type="text" id="email" name="email" class="form-control" 
					value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>"></input>
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
					<span class="field-info">Atleast 6 characters, 1 number and 1 special character</span>
				</div>		
			</div>
			<br>
			<div class="row">
				<div class="col-sm-4 text-right">
					<label>IP Address</label>
				</div>
				<div class="col-sm-4">
					<input type="text" id="ip" name="ip" class="form-control" 
					value="<?php if(isset($_POST['ip'])) echo $_POST['ip'];?>"></input>
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
					<input type="submit" id="submit" name="submit" value="Create User" class="btn btn-success" onclick="return validateUserData();"></input>
				</div>		
			</div>
		</form>
		</div>
	</div>
</body>
</html>