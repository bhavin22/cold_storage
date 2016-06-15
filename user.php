<?php
class user {
	
	public function __construct() {
		
	}

	public function validateUser($dbConn, $username, $password) {
		$userData = null;
		$query = "SELECT * FROM users WHERE user_name = ? AND password = ?";
		$stmt = $dbConn->prepare($query);
		$stmt->bind_param("ss", $username, $password);
		
		$stmt->execute();
		$result = $stmt->get_result();
		while ($row = $result->fetch_assoc()) {
	    	$userData = $row;	
	    }
	    $stmt->close();

	    return $userData;
	}

	public function createUser($dbConn, $username, $email, $password, $ip) {
		$query = "INSERT INTO users(user_name, email, password, user_type, user_ip) values(?,?,?,1,?)";
		$stmt = $dbConn->prepare($query);
		$stmt->bind_param("ssss", $username, $email, $password, $ip);
		$stmt->execute();	
		$stmt->close();

		$arrUser = array();
		$query = "SELECT * FROM users WHERE user_type = 1";
		$stmt = $dbConn->prepare($query);
		$result = $stmt->execute();
		$result = $stmt->get_result();
		while ($row = $result->fetch_assoc()) {
			$arrUser[] = $row;
	    }
	    $stmt->close();
	    return $arrUser;
	}

	public function getUsers($dbConn) {
		$arrUser = array();
		$query = "SELECT * FROM users WHERE user_type = 1";
		$stmt = $dbConn->prepare($query);
		$result = $stmt->execute();
		$result = $stmt->get_result();
		while ($row = $result->fetch_assoc()) {
			$arrUser[] = $row;
	    }
	    $stmt->close();
	    return $arrUser;
	}
}
?>