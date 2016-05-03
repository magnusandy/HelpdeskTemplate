<?php
// get the q parameter from URL
session_start();
date_default_timezone_set('America/Swift_Current');
$servername = "localhost";
$username = "root";
$dbname = "nathanhelpdesk";
$password = "";

$id = $_POST["id"];
//create connection to the database
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "UPDATE tickets SET status = 'Complete' WHERE id = '".$id."';";
	//$sql = "INSERT INTO tickets (dateCreated, dateUpdated, requestor, requestType, deviceType, description, priority, contactInfo, status) VALUES ('".$date."', '".$date."', '".$name."', '".$request."', '".$device."', '".$description."', '".$priority."', '".$contactInfo."', '".$status."');";
	$result = $conn->query($sql);
	echo $sql;
?>