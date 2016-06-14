<?php
class user {
	
	public function __construct() {
		
	}

	public function validateUser($dbConn, $username, $password) {
		$userType = null;
		$query = "SELECT user_type FROM users WHERE user_name = ? AND password = ?";
		$stmt = $dbConn->prepare($query);
		$stmt->bind_param("ss", $username, $password);
		
		$stmt->execute();
		$stmt->bind_result($user_type);
		    
	    while ($stmt->fetch()) {
	    	$userType = $user_type;	
	    }
	    $stmt->close();

	    return $userType;
	}

	public function createUser($dbConn, $username, $email, $password) {
		
	}	
}
?>