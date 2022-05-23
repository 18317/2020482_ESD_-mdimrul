<?php
date_default_timezone_set("Europe/Dublin");
$date = date( "Y-m-d" );
$datetime = date( "Y-m-d, H:i:s" );
$server = "localhost";
$db = "store"; 
$username = "root";
$password = "";
	
try {
    $connect = new PDO("mysql:host=$server;dbname=$db", $username, $password );
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
		header("location:index.php");	 
    exit;
}

?>