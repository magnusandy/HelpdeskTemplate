<?php
// get the q parameter from URL
session_start();

date_default_timezone_set('America/Swift_Current');
$servername = "localhost";
$username = "root";
$dbname = "helpdesk";
$password = "";

$pass = $_POST["password"];
$hash = hash('sha256', $pass);
//create connection to the database
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "select password from password;";
	$result = $conn->query($sql);
	$row = $result->fetch();

	//checks  the hash against the stored database version
	if($hash == $row["password"])
	{
		$_SESSION["loggedIn"] = "YES";
		echo "true";
	}
	else
	{
		$_SESSION["loggedIn"] = "";
		echo "false";
	}
	
		
?>