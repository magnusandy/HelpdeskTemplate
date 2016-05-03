<?php
// get the q parameter from URL
session_start();
date_default_timezone_set('America/Swift_Current');
$servername = "localhost";
$username = "root";
$dbname = "helpdesk";
$password = "";

$name = $_POST["name"];
$device = $_POST["device"];
$request = $_POST["request"];
$contactInfo = $_POST["contactInfo"];
$description = $_POST["description"];
$priority = $_POST["priority"];
$date = date('Y/m/d H:i:s');
$status = "Pending";
$message = <<<END
Ticket sender: $name\r\n
Ticket contact info: $contactInfo\r\n
Ticket date: $date\r\n
Ticket type: $request\r\n
Ticket device: $device\r\n
Ticket Description: $description\r\n
Ticket priority: $priority\r\n
END;
$message = wordwrap($message, 70, "\r\n", true);
$emailSubj = "Ticket From: ".$name;
//CUSTOMIZE ON SERVER
//mail("EMAIL@Email.com", $emailSubj, $message); //send email to notify of request
//create connection to the database
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO tickets (dateCreated, dateUpdated, requestor, requestType, deviceType, description, priority, contactInfo, status) VALUES ('".$date."', '".$date."', '".$name."', '".$request."', '".$device."', '".$description."', '".$priority."', '".$contactInfo."', '".$status."');";
	$result = $conn->query($sql);
	echo $sql;
?>