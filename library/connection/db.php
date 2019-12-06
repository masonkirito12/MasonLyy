<?php
if (!isset($_SESSION)) {
  session_start();
}
if($_SERVER['SERVER_NAME'] == "localhost"){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "bl_library";
}else{
	$servername = "aster.arvixe.com";
	$username = "sales";
	$password = "sales";
	$database = "bl_library";
}
// $servername = "localhost";
// 	$username = "root";
// 	$password = "";
// 	$database = "library";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}  
?>