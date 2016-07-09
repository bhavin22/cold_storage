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
		$stmt->bind_result($id, $author, $company, $designation, $testimonial);
		while ($row = $stmt->fetch()) {
			$testimonial = new stdClass();
			$testimonial->id = $id;
			$testimonial->company = $company;
			$testimonial->author = $author;
			$testimonial->company = $company;
			$testimonial->designation = $designation;
			$testimonial->testimonial = $testimonial;
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
			$project->company = $company;
			$project->author = $author;
			$project->company = $company;
			$arrProject[] = $project;
	    }
	    $stmt->free_result();
	    $stmt->close();
	    return $arrProject;
	}
}