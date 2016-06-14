<?php
require_once 'session.php';

if(isset($_SESSION['bUserLoggedIn']) &&
	$_SESSION['bUserLoggedIn'] === true) {
	session_unset(); 
	session_destroy(); 
	header("location:login.php");
}
?>