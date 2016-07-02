<?php
class user {
	
	public function __construct() {
		
	}

	public function validateUser($dbConn, $username, $password) {
		$userData = array();
		$query = "SELECT id, user_type, user_ip FROM users WHERE user_name = ? AND password = ?";
		$stmt = $dbConn->prepare($query);
		$stmt->bind_param("ss", $username, $password);
		
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($id, $user_type, $user_ip);
		while ($row = $stmt->fetch()) {
			$userData['id'] = $id;
			$userData['user_type'] = $user_type;
			$userData['user_ip'] = $user_ip;
	    }
	    $stmt->free_result();
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
		$stmt->store_result();
		$num_of_rows = $stmt->num_rows;
		if($num_of_rows > 0) {
	    	$response->bUserExist = true;	
		}
	    $stmt->free_result();
	    $stmt->close();

	    if($response->bUserExist) {
	    	return $response;
	    }


		$query = "INSERT INTO users(user_name, email, password, user_type, user_ip) values(?,?,?,1,?)";
		$stmt = $dbConn->prepare($query);
		$stmt->bind_param("ssss", $username, $email, $password, $ip);
		$stmt->execute();	
		$stmt->close();

		$query = "SELECT user_name, email, user_ip FROM users WHERE user_type = 1";
		$stmt = $dbConn->prepare($query);
		$result = $stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($user_name, $email, $user_ip);

		while ($row = $stmt->fetch()) {
			$user = new stdClass();
			$user->user_name = $user_name;
			$user->email = $email;
			$user->user_ip = $user_ip;
			$response->arrUser[] = $user;
	    }
	    $stmt->free_result();
	    $stmt->close();
	    return $response;
	}

	public function getUsers($dbConn) {
		$arrUser = array();
		$query = "SELECT user_name, email, user_ip FROM users WHERE user_type = 1";
		$stmt = $dbConn->prepare($query);
		$result = $stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($user_name, $email, $user_ip);
		while ($row = $stmt->fetch()) {
			$user = new stdClass();
			$user->user_name = $user_name;
			$user->email = $email;
			$user->user_ip = $user_ip;
			$arrUser[] = $user;
	    }
	    $stmt->free_result();
	    $stmt->close();
	    return $arrUser;
	}

	public function validateEmail($dbConn, $email) {
		$response = new stdClass();
		$response->bEmailExist = false;
		$response->token = null;
		$query = "SELECT * FROM users WHERE email = ?";
		$stmt = $dbConn->prepare($query);
		$stmt->bind_param("s", $email);
		
		$stmt->execute();
		$stmt->store_result();
		$num_of_rows = $stmt->num_rows;
		
		if ($num_of_rows > 0) {
	    	$response->bEmailExist = true;	
	    }
	    $stmt->free_result();
	    $stmt->close();
	    if(!$response->bEmailExist) {
	    	return $response;
	    }
	    
	    $response->token = $this->generateRandomString();
	    $query = "UPDATE users SET resetPasswordToken = '".$response->token."' WHERE email = ?";
		$stmt = $dbConn->prepare($query);
		$stmt->bind_param("s", $email);
		
		$stmt->execute();
	    $stmt->close();
	    return $response;
	}

	public function validateResetPassword($dbConn, $email, $token) {
		$bValid = false;

		$query = "SELECT * FROM users WHERE email = ? AND resetPasswordToken = ?";
		$stmt = $dbConn->prepare($query);
		$stmt->bind_param("ss", $email, $token);
		
		$stmt->execute();
		$stmt->store_result();
		$num_of_rows = $stmt->num_rows;
		if ($num_of_rows > 0) {
	    	$bValid = true;
	    }
	    $stmt->free_result();
	    $stmt->close();
	    return $bValid;
	}

	public function resetPassword($dbConn, $email, $password) {
		$query = "UPDATE users SET password = ?, resetPasswordToken = null WHERE email = ?";
		$stmt = $dbConn->prepare($query);
		$stmt->bind_param("ss", $password, $email);
		
		$stmt->execute();
	}

	function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
}
?>