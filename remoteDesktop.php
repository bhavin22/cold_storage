<?php
require_once 'config.php';
require_once 'session.php';
require_once 'user.php';

if(isset($_POST) && isset($_POST['submit'])) {

	if(!isset($_POST['user_ip']) || 
		empty($_POST['user_ip'])) {
		header("location:userDashboard.php");
		exit();
	} else {
		shell_exec("./utils/launch.sh --vnc 10.121.10.8:5900 --listen 6801");
	}

} else {
	header("location:userDashboard.php");
	exit();
}
?>