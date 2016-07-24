<?php
class siteContent {
	
	public function __construct() {
		
	}

	public function getTestimonials($dbConn) {
		$arrTestimonial = array();
		$query = "SELECT id, author, company, designation, testimonial FROM testimonials";
		$stmt = $dbConn->prepare($query);
		$result = $stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($id, $author, $company, $designation, $testimonialText);
		while ($row = $stmt->fetch()) {
			$testimonial = new stdClass();
			$testimonial->id = $id;
			$testimonial->author = $author;
			$testimonial->company = $company;
			$testimonial->designation = $designation;
			$testimonial->testimonial = $testimonialText;
			$arrTestimonial[] = $testimonial;
	    }
	    $stmt->free_result();
	    $stmt->close();
	    return $arrTestimonial;
	}

	public function getProjects($dbConn) {
		$arrProject = array();
		$query = "SELECT id, title, description, image FROM projects";
		$stmt = $dbConn->prepare($query);
		$result = $stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($id, $title, $description, $image);
		while ($row = $stmt->fetch()) {
			$project = new stdClass();
			$project->id = $id;
			$project->title = $title;
			$project->description = $description;
			$project->image = $image;
			$arrProject[] = $project;
	    }
	    $stmt->free_result();
	    $stmt->close();
	    return $arrProject;
	}

	public function addTestimonial($dbConn, $author, $company, $designation, $testimonial) {
		$query = "INSERT INTO testimonials(author, company, designation, testimonial) values(?, ?, ?, ?)";
		$stmt = $dbConn->prepare($query);
		$stmt->bind_param("ssss", $author, $company, $designation, $testimonial);
		$stmt->execute();	
		$stmt->close();
	}

	public function addProject($dbConn, $title, $description, $imageFile) {
		$projectImageDir = "./images/projects";
		$tmp_name = $imageFile["tmp_name"];
        $name =$imageFile["name"];
        $imagePath = "$projectImageDir/$name";
        move_uploaded_file($tmp_name, $imagePath);

		$query = "INSERT INTO projects(title, description, image) values(?, ?, ?)";
		$stmt = $dbConn->prepare($query);
		$stmt->bind_param("sss", $title, $description, $imagePath);
		$stmt->execute();	
		$stmt->close();
	}

	public function deleteProjects($dbConn, $projectId) {
		$arrId = explode(',', $projectId);
		$query = "DELETE FROM projects WHERE id IN (";
		for($i=0; $i<count($arrId); $i++) {
			$query .= "'".$arrId[$i]."',";
		}
		$query = rtrim($query, ',');
		$query .= ");";
		$stmt = $dbConn->prepare($query);
		$stmt->execute();
	}

	public function deleteTestimonial($dbConn, $testimonialId) {
		$arrId = explode(',', $testimonialId);
		$query = "DELETE FROM testimonials WHERE id IN (";
		for($i=0; $i<count($arrId); $i++) {
			$query .= "'".$arrId[$i]."',";
		}
		$query = rtrim($query, ',');
		$query .= ");";
		$stmt = $dbConn->prepare($query);
		$stmt->execute();
	}
}