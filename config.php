<?php

$hostname='localhost';
$username='root';
$password='';
$dbname='icahmt';

try 
{
    $dbConn = mysqli_connect($hostname,$username,$password,$dbname);
    if (mysqli_connect_errno())
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
}
catch(PDOException $e)
{
	echo "please create database first";
	exit();
}

?>