<link rel="icon" href="../pagelogo.png" sizes="16x16" type="image/png">
<?php
session_start();
include_once '../assets2/conn/dbconnect.php';
$session= $_SESSION['icPatient'];
// $appid=null;
// $appdate=null;
if (isset($_GET['scheduleDate']) && isset($_GET['appid'])) {
	$appdate =$_GET['scheduleDate'];
	$appid = $_GET['appid'];
}
// on b.icPatient = a.icPatient
$res = mysqli_query($con,"SELECT a.*, b.* FROM doctorschedule a INNER JOIN patient b
WHERE a.scheduleDate='$appdate' AND scheduleId=$appid AND b.icPatient=$session");
$userRow = mysqli_fetch_array($res,MYSQLI_ASSOC);

//fetch profile image
$resultss = mysqli_query($con, "SELECT * FROM patient WHERE icPatient=".$_SESSION['icPatient']);
$patientss = mysqli_fetch_array($resultss, MYSQLI_ASSOC);

//INSERT
if (isset($_POST['appointment'])) {

	$checker = $_SESSION['checker'];
	$checker = "1";
	$_SESSION['checker'] = $checker;

$patientIc = mysqli_real_escape_string($con,$userRow['icPatient']);
$scheduleid = mysqli_real_escape_string($con,$appid);
$ChosenPetName = mysqli_real_escape_string($con,$_POST['Pname']);
$symptom = mysqli_real_escape_string($con,$_POST['symptom']);
$comment = mysqli_real_escape_string($con,$_POST['comment']);
$avail = "Not Available";


$query = "INSERT INTO appointment (  patientIc , scheduleId , ChosenPet , appSymptom , appComment  )
VALUES ( '$patientIc', '$scheduleid', '$ChosenPetName', '$symptom', '$comment') ";

//update table appointment schedule
$sql = "UPDATE doctorschedule SET bookAvail = '$avail' WHERE scheduleId = $scheduleid" ;
$scheduleres=mysqli_query($con,$sql);
if ($scheduleres) {
	$btn= "disable";
} 


$result = mysqli_query($con,$query);
// echo $result;
if( $result )
{
?>
<script type="text/javascript">
alert('Appointment made successfully.');
</script>
<?php
header("Location: patientapplist.php");
}
else
{
	echo mysqli_error($con);
?>
<script type="text/javascript">
alert('Appointment booking fail. Please try again.');
</script>
<?php
header("Location: patient.php");
}
//dapat dari generator end
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		
		<title>Caring Paws | Appoinment</title>
		<link href="../assets2/css/bootstrap.min.css" rel="stylesheet">
		<link href="../assets2/css/default/style.css" rel="stylesheet">
		<link href="../assets2/css/default/blocks.css" rcel="stylesheet">


		<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
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
							<li><a href="patient.php">Home</a></li>
							<!-- <li><a href="profile.php?patientId=<?php echo $userRow['icPatient']; ?>" >Profile</a></li> -->
							<li><a href="patientapplist.php?patientId=<?php echo $userRow['icPatient']; ?>">Appointment</a></li>
						</ul>
					</ul>
					
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userRow['fname']; ?> <?php echo $userRow['lname']; ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>
									<a href="profile.php?patientId=<?php echo $userRow['icPatient']; ?>"><i class="fa fa-fw fa-user"></i> Profile</a>
								</li>
								<li>
									<a href="patientapplist.php?patientId=<?php echo $userRow['icPatient']; ?>"><i class="glyphicon glyphicon-file"></i> Appointment</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="../logout.php?logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- navigation -->
		<div class="container">
			<section style="padding-bottom: 50px; padding-top: 50px;">
				<div class="row">
					<!-- start -->
					<!-- USER PROFILE ROW STARTS-->
					<div class="row">
						<div class="col-md-3 col-sm-3">
							
							<div class="user-wrapper">



							
							<img src="
							
										<?php 
											if(empty($patientss['profile_image'])){
												echo 'images2/ownerDefault.png';
											}
											else{
												echo 'images2/' . $patientss['profile_image'];
											};
							 			?>
										 
										 
							"  
							 
							 
							 
							 
							 width="200" height="200" alt="">
								<div class="description">
									<h3 style="font-weight:bold;"><?php echo $userRow['fname']; ?> <?php echo $userRow['lname']; ?></h3>
									<h5><strong> Owner </strong></h5>

									<hr/>
			
								</div>
							</div>
						</div>
						
						<div class="col-md-9 col-sm-9  user-wrapper">
							<div class="description">
								
								
								<div class="panel panel-default">
									<div class="panel-body" style='background: #d4d1d5;' >
										
										
									<form class="form" role="form" method="POST" accept-charset="UTF-8" >
                                            <div class="panel panel-default" >
                                                <div class="panel-heading" style='color: #f6f3f7; 
                                                                                  background: #f06060; 
                                                                                  border: 0px solid;
                                                                                  font-weight: bold;';>Patient Information</div>
                                                <div class="panel-body" style=' height: 100px;
                                                    background: #bb8181;
                                                    color: #f6f3f7;
                                                    font-size: 11pt;
                                                    padding: 10px;
                                                    border: 0px solid;
                                                    font-weight: bold' >
                                                    
                                                    Patient Name: <?php echo $userRow['fname'] ?> <?php echo $userRow['lname'] ?><br>
                                                    Patient IC: <?php echo $userRow['icPatient'] ?><br>
                                                    Contact Number: <?php echo $userRow['patientPhone'] ?><br>
                                                    Address: <?php echo $userRow['patientAddress'] ?>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-heading" style='color: #f6f3f7; 
                                                                                  background: #f06060; 
                                                                                  border: 0px solid;
                                                                                  font-weight: bold;'>Appointment Information</div>
                                                <div class="panel-body" style=' height: 100px;
                                                    background: #bb8181;
                                                    color: #f6f3f7;
                                                    font-size: 11pt;
                                                    padding: 10px;
                                                    border: 0px solid;
                                                    font-weight: bold'>
                                                    Day: <?php echo $userRow['scheduleDay'] ?><br>
                                                    Date: <?php echo $userRow['scheduleDate'] ?><br>
                                                    Time: <?php echo $userRow['startTime'] ?> - <?php echo $userRow['endTime'] ?><br>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="recipient-name" class="control-label">Pet Symptom/s</label>
                                                <input type="text" class="form-control" name="symptom" required>
                                            </div>
											<div class="form-group">
                                                <label for="recipient-name" class="control-label">Choose Your Pet</label>

												<Select class="form-control" name="Pname" required>

																<?php
																	
																	$ChosenPname = mysqli_query($con, "SELECT Pname From petprofile WHERE icPet=".$_SESSION['icPatient']);  // Use select query here 
																	$DPname = null;
																	while($DPname = mysqli_fetch_array($ChosenPname))
																	{
																	
																		echo "<option value='". $DPname['Pname'] ."'>" .$DPname['Pname'] ."</option>";  // displaying data in option menu
																		
																	}	

																?>  
										
												</select>


                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="control-label">Remarks</label>
                                                <textarea class="form-control" name="comment" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" name="appointment" id="submit" class="btn btn-primary" value="Make Appointment">
                                            </div>
                                        </form>
									</div>
								</div>
								
							</div>
							
						</div>
					</div>
					<!-- USER PROFILE ROW END-->
					<!-- end -->			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Messenger Chat Plugin Code -->
    <div id="fb-root"></div>

<!-- Your Chat Plugin code -->
<div id="fb-customer-chat" class="fb-customerchat"></div>

<script>
	var chatbox = document.getElementById('fb-customer-chat');
	chatbox.setAttribute("page_id", "100419709047028");
	chatbox.setAttribute("attribution", "biz_inbox");

	window.fbAsyncInit = function() {
	FB.init({
		xfbml            : true,
		version          : 'v11.0'
	});
	};

	(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
	fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>
					<script src="assets/js/jquery.js"></script>
			<script src="assets/js/bootstrap.min.js"></script>


				</body>
			</html>