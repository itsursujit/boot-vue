<?php
       session_start();
       ob_start();

// Database Connection
$serverName   		= "localhost";
$databaseName 		= "location"; 
$username 	        = "root"; 
$password 		    = "root";

try {
	$db = new PDO("mysql:host={$serverName};dbname={$databaseName}", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
} catch (PDOException $e){
	return 'connection error '. $e->getMessage();
}	

$settings = $db -> query("SELECT * FROM settings")->fetch();