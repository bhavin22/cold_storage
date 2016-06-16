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
		$response = new stdClass();
		$response->bUserExist = false;
		$response->arrUser = array();

		$query = "SELECT * FROM users WHERE user_name = ? OR email = ?";
		$stmt = $dbConn->prepare($query);
		$stmt->bind_param("ss", $username, $email);
		
		$stmt->execute();
		$result = $stmt->get_result();
		while ($row = $result->fetch_assoc()) {
	    	$response->bUserExist = true;	
	    }
	    $stmt->close();

	    if($response->bUserExist) {
	    	return $response;
	    }


		$query = "INSERT INTO users(user_name, email, password, user_type, user_ip) values(?,?,?,1,?)";
		$stmt = $dbConn->prepare($query);
		$stmt->bind_param("ssss", $username, $email, $password, $ip);
		$stmt->execute();	
		$stmt->close();

		$query = "SELECT * FROM users WHERE user_type = 1";
		$stmt = $dbConn->prepare($query);
		$result = $stmt->execute();
		$result = $stmt->get_result();
		while ($row = $result->fetch_assoc()) {
			$response->arrUser[] = $row;
	    }
	    $stmt->close();
	    return $response;
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

	public function validateEmail($dbConn, $email) {
		$bEmailExist = false;
		$query = "SELECT * FROM users WHERE email = ?";
		$stmt = $dbConn->prepare($query);
		$stmt->bind_param("s", $email);
		
		$stmt->execute();
		$result = $stmt->get_result();
		while ($row = $result->fetch_assoc()) {
	    	$bEmailExist = true;	
	    }
	    $stmt->close();
	    if(!$bEmailExist) {
	    	return $bEmailExist;
	    }
	    
	    $query = "UPDATE users SET bPasswordModify = 1 WHERE email = ?";
		$stmt = $dbConn->prepare($query);
		$stmt->bind_param("s", $email);
		
		$stmt->execute();
	    $stmt->close();
	    return $bEmailExist;
	}

	public function validateResetPassword($dbConn, $email) {
		$bValid = false;
		$query = "SELECT * FROM users WHERE email = ? AND bPasswordModify = 1";
		$stmt = $dbConn->prepare($query);
		$stmt->bind_param("s", $email);
		
		$stmt->execute();
		$result = $stmt->get_result();
		var_dump($result);
		exit();
		while ($row = $result->fetch_assoc()) {
	    	$bValid = true;	
	    }
	    $stmt->close();
	    return $bValid;
	}

	public function resetPassword($dbConn, $email, $password) {
		$query = "UPDATE users SET password = ?, bPasswordModify = 0 WHERE email = ?";
		$stmt = $dbConn->prepare($query);
		$stmt->bind_param("ss", $password, $email);
		
		$stmt->execute();
	}
}
?>