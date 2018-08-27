<?php 
       ob_start();
	
$serverName   = "localhost";
$databaseName = "location";
$username     = "root";
$password     = "root";

$connection = mysqli_connect($serverName, $username, $password, $databaseName);
if (!$connection)  die("Connection failed: " . mysqli_connect_error());

mysqli_set_charset($connection, "utf8");