<link rel="icon" href="../pagelogo.png" sizes="16x16" type="image/png">
<?php
// Initialize the session
session_start();
include_once '../assets2/conn/dbconnect.php';
$session=$_SESSION['icPatient'];
$res=mysqli_query($con, "SELECT a.*, b.*,c.* FROM patient a
	JOIN appointment b
		On a.icPatient = b.patientIc
	JOIN doctorschedule c
		On b.scheduleId = c.scheduleId
	WHERE b.patientIc ='$session'");
	if (!$res) {
		die( "Error running $sql: " . mysqli_error());
	}
	$userRow=mysqli_fetch_array($res);

	$res2=mysqli_query($con,"SELECT * FROM patient WHERE icPatient=".$session);

	if ($res2===false) {
		echo mysql_error();
	} 
	
	$userRow2=mysqli_fetch_array($res2,MYSQLI_ASSOC);

	$resultsss = mysqli_query($con, "SELECT * FROM petprofile WHERE icPet='$session'");
	$patientsss = mysqli_fetch_array($resultsss);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Caring Paws | Appointment</title>
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="../assets2/css/material.css" rel="stylesheet">
		<!-- <link href="../assets2/css/default/style.css" rel="stylesheet"> -->
		<link href="../assets2/css/blocks.css" rcel="stylesheet">
		<link href="../assets2/css/date/bootstrap-datepicker.css" rel="stylesheet">
		<link href="../assets2/css/date/bootstrap-datepicker3.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" />

	</head>
	<body>
		<!-- navigation -->
		<nav class="navbar navbar-default " role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="patient.php"><img alt="Brand" src="assets/logo.png" height="25px"></a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<ul class="nav navbar-nav">
							<!-- <li><a href="patient.php">Home</a></li>-->
							<!-- <li><a href="profile.php?patientId=<?php echo $userRow['icPatient']; ?>" >Profile</a></li> -->
							<!--<li><a href="patientapplist.php?patientId=<?php //echo $userRow['icPatient']; ?>">Appointment</a></li>-->
							<!--<li><a href="patient.php">Schedule</a></li>-->
						</ul>
					</ul>
					
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userRow2['fname']; ?> <?php echo $userRow2['lname']; ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
							<li>
									<a href="patient.php"><i class="glyphicon glyphicon-list-alt"></i> Schedule</a>
								</li>
								<li>
									<a href="profile.php?patientId=<?php echo $userRow['icPatient']; ?>"><i class="glyphicon glyphicon-user"></i> Profile</a>
								</li>
								<!--<li>
									<a href="patientapplist.php?patientId=<?php //echo $userRow['icPatient']; ?>"><i class="glyphicon glyphicon-file"></i> Appointment</a>
								</li>-->
								<li class="divider"></li>
								<li>
									<a href="../logout.php?logout"><i class="glyphicon glyphicon-off"></i> Log Out</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- navigation -->
<!-- display appoinment start -->
<?php

if (mysqli_num_rows($res)==0) {
	echo "<center><div style='margin: 80 80; font-weight: bold;' class='alert alert-danger' role='alert'>No schedule is available yet. Book now!.</div><center>";
	
	} else {
echo "<div class='container'>";
echo "<div class='row'>";
echo "<div class='page-header'>";
echo "<h1 style=" . "'font-weight: bold;'" . ">" . $userRow2['fname'] . "'s Appointment List </h1>";
echo "</div>";
echo "<div class='panel panel-primary'>";
echo "<div style=" . "'font-weight: bold;'" . "class='panel-heading'>Your List of Appointment</div>";
echo "<div class='panel-body'>";
echo "<table class='table table-hover'>";
echo "<thead>";
echo "<tr>";
echo "<th>Application I.D </th>";
echo "<th>IC No. </th>";
echo "<th>Owner Last Name </th>";
echo "<th>Pet Name </th>";
echo "<th>Scheduled Day </th>";
echo "<th>Scheduled Date </th>";
echo "<th>Start Time</th>";
echo "<th>End Time</th>";
echo "<th>Copy of Form</th>";
echo "</tr>";
echo "</thead>";
$res = mysqli_query($con, "SELECT a.*, b.*,c.*
		FROM patient a
		JOIN appointment b
		On a.icPatient = b.patientIc
		JOIN doctorschedule c
		On b.scheduleId=c.scheduleId
		WHERE b.patientIc ='$session'");

if (!$res) {
die("Error running $sql: " . mysqli_error());
}


while ($userRow = mysqli_fetch_array($res)) {
echo "<tbody>";
echo "<tr>";
echo "<td>" . $userRow['appId'] . "</td>";
echo "<td>" . $userRow['patientIc'] . "</td>";
echo "<td>" . $userRow['lname'] . "</td>";
echo "<td>" . $userRow['ChosenPet'] . "</td>";
echo "<td>" . $userRow['scheduleDay'] . "</td>";
echo "<td>" . $userRow['scheduleDate'] . "</td>";
echo "<td>" . $userRow['startTime'] . "</td>";
echo "<td>" . $userRow['endTime'] . "</td>";
echo "<td><a href='invoice.php?appid=".$userRow['appId']."' target='_blank'><span class='glyphicon glyphicon-print' aria-hidden='true'></span></a> </td>";
}

echo "</tr>";
echo "</tbody>";
echo "</table>";
	}
?>
	</div>
</div>
</div>
</div>
<!-- display appoinment end -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>