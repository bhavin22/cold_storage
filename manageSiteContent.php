<?php
require_once 'config.php';
require_once 'session.php';
require_once 'user.php';
require_once 'siteContent.php';

if(!isset($_SESSION['bUserLoggedIn']) ||
	$_SESSION['bUserLoggedIn'] !== true ||
	$_SESSION['userType'] !== 0) {
	header("location:login.php");
	exit();
}

$add_project_error_msg = "";
$delete_project_error_msg = "";
$delete_testimonial_error_msg = "";
if(isset($_POST)) {
	if(isset($_POST['submit_project'])) {
		if(!isset($_POST['project_title']) ||
			empty($_POST['project_title'])) {
			$add_project_error_msg = "Please enter project title.";
		} else if(!isset($_POST['project_description']) ||
			empty($_POST['project_description'])) {
			$add_project_error_msg = "Please enter project description.";
		} else if(!isset($_FILES['project_image']['name']) ||
			empty($_FILES['project_image']['name'])) {
			$add_project_error_msg = "Please select image.";
		} else {
			$obj = new siteContent();
			$obj->addProject($dbConn, $_POST['project_title'], $_POST['project_description'], $_FILES['project_image']);
			unset($_POST);
		}
	} else if(isset($_POST['delete_project'])) {
		if(!isset($_POST['selectedProjects']) || 
			empty($_POST['selectedProjects']) || $_POST['selectedProjects'] === '') {
			$delete_project_error_msg = "Please select projects to delete.";
		} else {
			$obj = new siteContent();
			$obj->deleteProjects($dbConn, $_POST['selectedProjects']);
			unset($_POST);
		}
	} else if(isset($_POST['delete_testimonial'])) {
		if(!isset($_POST['selectedTestimonials']) || 
			empty($_POST['selectedTestimonials']) || $_POST['selectedTestimonials'] === '') {
			$delete_testimonial_error_msg = "Please select testimonials to delete.";
		} else {
			$obj = new siteContent();
			$obj->deleteTestimonial($dbConn, $_POST['selectedTestimonials']);
			unset($_POST);
		}
	}
} 

$obj = new siteContent();
$arrProject = $obj->getProjects($dbConn);
$arrTestimonial = $obj->getTestimonials($dbConn);
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
		    	<li><a href="adminDashboard.php">Manage Users</a></li>
		        <li><a href="logout.php" class="menu-link">Logout</a></li>
		    </ul>
		</nav>
  		<div class="jumbotron">

  			<ul class="nav nav-tabs">
			  	<li class="active"><a data-toggle="tab" href="#addProject">Add Project</a></li>
			  	<li><a data-toggle="tab" href="#deleteProject">Delete Project</a></li>
			  	<li><a data-toggle="tab" href="#deleteTestimonial">Delete Testimonial</a></li>
			</ul>

			<div class="tab-content">
			  	<div id="addProject" class="tab-pane fade in active">
			  	<br>
			  		<form method="post" action="#" enctype="multipart/form-data">
			  			<div class="row">
							<div class="col-sm-3">
							</div>
							<div class="col-sm-6 text-center">
								<label id="add_project_error_msg" class="text-danger"><?=$add_project_error_msg?></label>
							</div>		
						</div>
						<br>
						<div class="row">
							<div class="col-sm-6 bottom-padding">
								<input type="text" id="project_title" name="project_title" class="form-control" placeholder="Project Title"
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
								<input type="submit" id="submit_project" name="submit_project" value="Create Project" class="btn btn-success btn-block" onclick="return validateProjectData();"></input>
							</div>		
						</div>
					</form>
			  	</div>
			  	<div id="deleteProject" class="tab-pane fade">
			  	<br>
			  		<div class="row">
						<div class="col-sm-3">
						</div>
						<div class="col-sm-6 text-center">
							<label id="delete_project_error_msg" class="text-danger"><?=$delete_project_error_msg?></label>
						</div>		
					</div>
					<br>
				    <table class="table">
			      		<thead>
			      			<tr>
			      			<th>select</th>
			      			<th>Title</th>
			      			</tr>
			      		</thead>
			      		<tbody>	      	
				        <?php
				        for ($i=0; $i < count($arrProject); $i++) { 
				        	echo "<tr>";
				        	echo "<td><input type='checkbox' class='projectCheckbox' value='".$arrProject[$i]->id."'></input></td>";
				        	echo "<td>".$arrProject[$i]->title."</td>";
				        	echo "</tr>";
				        }
				        ?>
			        	</tbody>
			        </table>
			        
	        		<form method="post">
	        			<input type="hidden" name="selectedProjects" id="selectedProjects" value=""></input>
	        			<div class="row">
				        	<div class="col-xs-3"></div>
				        	<div class="col-xs-6">
				        		<input type="submit" id="delete_project" class='btn btn-success btn-block' name="delete_project" value="Delete Project" onclick="return validateDeleteProjectData();"></input>
				        	</div>
				        </div>
	        		</form>
			  	</div>
			  	<div id="deleteTestimonial" class="tab-pane fade">
			  	<br>
			  		<div class="row">
						<div class="col-sm-3">
						</div>
						<div class="col-sm-6 text-center">
							<label id="delete_testimonial_error_msg" class="text-danger"><?=$delete_testimonial_error_msg?></label>
						</div>		
					</div>
					<br>
				    <table class="table">
			      		<thead>
			      			<tr>
			      			<th>select</th>
			      			<th>Author</th>
			      			<th>Company</th>
			      			<th>Designation</th>
			      			</tr>
			      		</thead>
			      		<tbody>	      	
				        <?php
				        for ($i=0; $i < count($arrTestimonial); $i++) { 
				        	echo "<tr>";
				        	echo "<td><input type='checkbox' class='testimonialCheckbox' value='".$arrTestimonial[$i]->id."'></input></td>";
				        	echo "<td>".$arrTestimonial[$i]->author."</td>";
				        	echo "<td>".$arrTestimonial[$i]->company."</td>";
				        	echo "<td>".$arrTestimonial[$i]->designation."</td>";
				        	echo "</tr>";
				        }
				        ?>
			        	</tbody>
			        </table>
			        
	        		<form method="post">
	        			<input type="hidden" name="selectedTestimonials" id="selectedTestimonials" value=""></input>
	        			<div class="row">
				        	<div class="col-xs-3"></div>
				        	<div class="col-xs-6">
				        		<input type="submit" id="delete_testimonial" class='btn btn-success btn-block' name="delete_testimonial" value="Delete Testimonial" onclick="return validateDeleteTestimonialData();"></input>
				        	</div>
				        </div>
	        		</form>
			  	</div>
			</div>
		</div>
	</div>
</body>
</html>