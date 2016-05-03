<!DOCTYPE html>

<?php
// get the q parameter from URL
session_start();
if($_SESSION["loggedIn"] != "YES")
{
	header("Location:admin.html");
}
else//
{
	$_SESSION["loggedIn"] = "";
}
date_default_timezone_set('America/Swift_Current');
$servername = "localhost";
$username = "root";
$dbname = "helpdesk";
$password = "";


//create connection to the database
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM tickets";
	$result = $conn->query($sql);
	$rows = $result->fetchall();		
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="help desk ticketing system">
    <meta name="author" content="Andrew Magnus">
	<!--Props for this library go to Stuart Langridge http://www.kryogenix.org/code/browser/sorttable/#ajaxtables-->
	<script src="js/sorttable.js"></script>
    <title>Help Desk</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
	.error {
		color: red;
	}
	
	th{
		background-color: #DCDCDC;
	}
	
	
	table.sortable th:not(.sorttable_sorted):not(.sorttable_sorted_reverse):not(.sorttable_nosort):after { 
    content: " \25B4\25BE" 
}
    </style>

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Help Desk</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a href="services.html">Services</a>
                    </li>
                    <li>
                        <a href="contact.html">Contact</a>
                    </li>
					<li class="active">
                        <a href="admin.html">Ticket Admin</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Admin View</h1>
				<table border="1" style="width:100%; " class="sortable">
				  <tr>
					<th>Ticket Number</th>
					<th>Date Created</th>		
					<th>Date Updated</th>
					<th>Requestor Name</th>
					<th>Request Type</th>		
					<th>Device Type</th>
					<th>Description</th>
					<th>Priority</th>		
					<th>Requestor Contact Info</th>
					<th>Status</th>
				  </tr>
					<?php
						//defined at top of page as a row of the ticket table
						foreach($rows as $row)
						{
							//build up a table row for at ticket
							$prioColor = prioColor($row['priority']);
							$description = wordwrap($row["description"], 70, "<br>", true);
							echo <<<END
							<tr>
								<td>$row[id]</td>
								<td>$row[dateCreated]</td>		
								<td>$row[dateUpdated]</td>
								<td>$row[requestor]</td>
								<td>$row[requestType]</td>		
								<td>$row[deviceType]</td>
								<td>$description</td>
								<td style="background-color: $prioColor;" >$row[priority]</td>		
								<td>$row[contactInfo]</td>
								<td>$row[status] <button>mark as resolved</button></td>
							</tr>
END;
						}
						
						function prioColor($prio)
						{
							if($prio == "Low")
							{
								return "#C2F0C2";
							}
							else if($prio == "Medium")
							{
								return "#FFFFC2";
							}
							else
							{
								return "#FFAD99";
							}
						}
					?>		
				</table>

            </div>
        </div>
    </div>

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
