<link rel="icon" href="../pagelogo.png" sizes="16x16" type="image/png">
<?php
if(isset($_POST['ajax']) && isset($_POST['dataTitle'])){
	
	echo $_POST['dataTitle']; 
	
	exit();
}
session_start();
include_once '../assets2/conn/dbconnect.php';


// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: patient/patient.php");
    exit;
}


$res = mysqli_query($con,"SELECT * FROM patient WHERE icPatient=".$_SESSION['icPatient']);
$userRow = mysqli_fetch_array($res,MYSQLI_ASSOC);

$resultss = mysqli_query($con, "SELECT * FROM patient WHERE icPatient=".$_SESSION['icPatient']);
$patientss = mysqli_fetch_array($resultss, MYSQLI_ASSOC);


//if (isset($_POST['submit4'])) {
		//$Pname = $_POST['Pname'];

		if(empty($petRow)){
			$res = mysqli_query($con,"SELECT * FROM petprofile WHERE icPet='1111'");
			$petRow = mysqli_fetch_array($res,MYSQLI_ASSOC);	
		}else{
			$respet = mysqli_query($con,"SELECT * FROM petprofile WHERE icPet=".$_SESSION['icPatient']);
			$petRow = mysqli_fetch_array($respet,MYSQLI_ASSOC);	
		}
//} elseif(empty($_POST['submit4'])){
//		$respet = mysqli_query($con,"SELECT * FROM petprofile WHERE icPet=".$_SESSION['icPatient']);
//		$petRow = mysqli_fetch_array($respet,MYSQLI_ASSOC);
//}


$resultsss = mysqli_query($con, "SELECT * FROM petprofile WHERE icPet=".$_SESSION['icPatient']);
$petss = mysqli_fetch_array($resultsss, MYSQLI_ASSOC);

?>
<!-- Owner Update Info -->
<?php
if (isset($_POST['submit'])) {
	//variables
	$patientFirstName = $_POST['fname'];
	$patientLastName = $_POST['lname'];
	$patientEmail = $_POST['username'];
	$patientMaritalStatus = $_POST['PMA'];
	$patientDOB = $_POST['patientDOB'];
	$patientGender = $_POST['patientGender'];
	$patientAddress = $_POST['patientAddress'];
	$patientPhone = $_POST['patientPhone'];

	$patientId = $_POST['icPatient'];
	// mysqli_query("UPDATE blogEntry SET content = $udcontent, title = $udtitle WHERE id = $id");
	$res = mysqli_query($con,"UPDATE patient SET fname='$patientFirstName', lname='$patientLastName', username='$patientEmail', patientMaritalStatus='$patientMaritalStatus', patientDOB='$patientDOB', patientGender='$patientGender', patientAddress='$patientAddress', patientPhone=$patientPhone WHERE icPatient=".$_SESSION['icPatient']);
	// $userRow=mysqli_fetch_array($res);
	header( 'Location: profile.php' ) ;
	$msg = "";
	$msg_class = "";
  
  // for the database
  $profileImageName = time() . '-' . $_FILES["profileImage"]["name"];
  // For image upload
  $target_dir = "images2/";
  $target_file = $target_dir . basename($profileImageName);
  // VALIDATION
  // validate image size. Size is calculated in Bytes
  if($_FILES['profileImage']['size'] > 200000) {
	$msg = "Image size should not be greated than 200 KB";
	$msg_class = "alert-danger";
  }
  // check if file exists
  if(file_exists($target_file)) {
	$msg = "File already exists";
	$msg_class = "alert-danger";
  }
  // Upload image only if no errors
  if (empty($error)) {
	if(move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)) {
	  $sql = "UPDATE patient SET profile_image='$profileImageName' WHERE icPatient='{$_SESSION['icPatient']}' ";
	  if(mysqli_query($con, $sql)){
		$msg = "Image uploaded and saved in the Database";
		$msg_class = "alert-success"; 
		header("location: ./profile.php");
	  } else {
		$msg = "There was an error in the database";
		$msg_class = "alert-danger";
	  }
	} else {
	  $error = "There was an erro uploading the file";
	  $msg = "alert-danger";
	}
  }
}



?>
<?php
$male="";
$female="";

	if ($userRow['patientGender']=='Male') {
		$male = "checked";	
	}elseif ($userRow['patientGender']=='Female') {
		$female = "checked";
	}

$newPatient="";
$oldPatient="";

	if ($userRow['patientMaritalStatus']=='New Pet Owner') {
		$newPatient = "checked";
	}elseif ($userRow['patientMaritalStatus']=='Old Pet Owner') {
		$oldPatient = "checked";
	}
?>

<!-- END Owner Update Info -->

<!-- Pet Update Info -->

<?php
if (isset($_POST['submit10'])) {

	//variables
		$Pname = $_POST['Pname'];
		$Breed = $_POST['Breed'];
		$Sex = $_POST['petSex'];
		$Age = $_POST['Age'];
		$PetDOB = $_POST['petDOB'];
		$Height = $_POST['Height'];
		$Weight = $_POST['Weight'];

		$respet = mysqli_query($con,"UPDATE petprofile SET Breed='$Breed', Sex='$Sex', Age='$Age', DateofBirth='$PetDOB', Height='$Height', Weight='$Weight' WHERE Pname='$Pname'");
		
		// $userRow=mysqli_fetch_array($res);
		header( 'Location: profile.php' ) ;

		$msg2 = "";
		$msg_class2 = "";
		
		  // for the database
		  $profileImageName2 = time() . '-' . $_FILES["petImage"]["name"];
		  // For image upload
		  $target_dir2 = "images2/";
		  $target_file2 = $target_dir2 . basename($profileImageName2);
		  // VALIDATION
		  // validate image size. Size is calculated in Bytes
		  if($_FILES['petImage']['size'] > 200000) {
			$msg2 = "Image size should not be greated than 200 KB";
			$msg_class2 = "alert-danger";
		  }
		  // check if file exists
		  if(file_exists($target_file2)) {
			$msg2 = "File already exists";
			$msg_class2 = "alert-danger";
		  }
		  // Upload image only if no errors
		  if (empty($error)) {
			if(move_uploaded_file($_FILES["petImage"]["tmp_name"], $target_file2)) {
			  $sql2 = "UPDATE petprofile SET profile_image='$profileImageName2' WHERE Pname='$Pname' ";
			  if(mysqli_query($con, $sql2)){
				$msg2 = "Image uploaded and saved in the Database";
				$msg_class2 = "alert-success"; 
				header("location: ./profile.php");
			  } else {
				$msg2 = "There was an error in the database";
				$msg_class2 = "alert-danger";
			  }
			} else {
			  $error = "There was an erro uploading the file";
			  $msg2 = "alert-danger";
			}
		  }
		
}
?>
<?php
$pmale="";
$pfemale="";

	if ($petRow['Sex']=='Male') {
		$pmale = "checked";	
	}elseif ($petRow['Sex']=='Female') {
		$pfemale = "checked";
	}
?>


<!-- Pet Add New Profile Info -->
<?php
if (isset($_POST['submit3'])) {
	
	//variables
		$PnameReg = $_POST['PnameReg'];
		$BreedReg = $_POST['BreedReg'];
		$SexReg = $_POST['petSexReg'];
		$AgeReg = $_POST['AgeReg'];
		$PetDOBReg = $_POST['petDOBReg'];
		$HeightReg = $_POST['HeightReg'];
		$WeightReg = $_POST['WeightReg'];

	
	$sql5 = "INSERT INTO petprofile (icPet, Pname, Breed, Sex, Age, DateofBirth, Height, Weight) VALUES (?,?,?,?,?,?,?,?)";
	
	if($stmt = $con->prepare($sql5)){
		
			$stmt->bind_param("ssssssss", $_SESSION['icPatient'], $PnameReg, $BreedReg, $SexReg, $AgeReg, $PetDOBReg, $HeightReg, $WeightReg);
		
			if($stmt->execute()){
				$msg = "";
				$msg_class = "";
				
				  // for the database
				  $profileImageName3 = time() . '-' . $_FILES["petUpload"]["name"];
				  // For image upload
				  $target_dir = "images2/";
				  $target_file = $target_dir . basename($profileImageName3);
				  // VALIDATION
				  // validate image size. Size is calculated in Bytes
				  if($_FILES['petUpload']['size'] > 200000) {
					$msg = "Image size should not be greated than 200 KB";
					$msg_class = "alert-danger";
				  }
				  // check if file exists
				  if(file_exists($target_file)) {
					$msg = "File already exists";
					$msg_class = "alert-danger";
				  }
				  // Upload image only if no errors
				  if (empty($error)) {
					if(move_uploaded_file($_FILES["petUpload"]["tmp_name"], $target_file)) {
					  $sql = "UPDATE petprofile SET profile_image='$profileImageName3' WHERE Pname='$PnameReg' ";
					  if(mysqli_query($con, $sql)){
						$msg = "Image uploaded and saved in the Database";
						$msg_class = "alert-success"; 
						header("location: ./profile.php");
					  } else {
						$msg = "There was an error in the database";
						$msg_class = "alert-danger";
					  }
					} else {
					  $error = "There was an erro uploading the file";
					  $msg = "alert-danger";
					}
				  }
				
				header( 'Location: profile.php' ) ;
				echo "Records inserted successfully.";
				
			} else{
				echo "ERROR: Could not able to execute" . $con->error;
			}
			
		$stmt->close();
	}
		
}

?>
<?php
$pmale2="";
$pfemale2="";

	if ($petRow['Sex']=='Male') {
		$pmale2 = "checked";	
	}elseif ($petRow['Sex']=='Female') {
		$pfemale2 = "checked";
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Caring Paws | Profile</title>
		<!-- Bootstrap -->
		<link href="./assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="./assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
		<link href="./assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
		<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css"/>
		<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css"/>
		<link href="assets/css/default/style1.css" rel="stylesheet">
		<link href="assets/css/default/table.css" rel="stylesheet">

		<!--  jQuery -->
		<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
<link rel="stylesheet" href="./css/bootstrap-iso.css" />

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
		<!--<link href="./assets/css/default/blocks.css" rel="stylesheet"> -->
		<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
		<!--Font Awesome (added because you use icons in your prepend/append)-->
		<!-- <link href="assets/css/material.css" rel="stylesheet"> -->
	<style>
		body{
			background: radial-gradient(circle, rgba(255,229,240,1) 0%, rgba(237,195,195,1) 100%); 
		}
		iframe{
  display: none;
}
		.form-div { margin-top: 100px; border: 1px solid #e0e0e0; }
			#profileDisplay { display: block; height: 250px; width: 50%; margin: 0px auto; border-radius: 50%; }
			#petDisplay { display: block; height: 250px; width: 50%; margin: 0px auto; border-radius: 50%; }
			#petShow { display: block; height: 250px; width: 50%; margin: 0px auto; border-radius: 50%; }
			
		.img-placeholder {
			width: 150px;
			color: white;
			height: 150px;
			background: black;
			opacity: .7;
			height: 150px;
			border-radius: 50%;
			z-index: 2;
			position: absolute;
			left: 50%;
			transform: translateX(-50%);
			display: none;
		}
		.img-placeholder h4 {
			margin-top: 40%;
			color: white;
		}
		.img-div:hover .img-placeholder {
			display: block;
			cursor: pointer;
		}
		.hidden {
  display: none;
}

.placeholder {
  font-size: 12px;
}

	</style>
		<script type="text/javascript" src="selectedPet.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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
							<!--<li><a href="patient.php">Schedule</a></li>-->
							<!-- <li><a href="profile.php?patientId=<?php //echo $userRow['icPatient']; ?>" >Profile</a></li> -->
							<!--<li><a href="patientapplist.php?patientId=<?php //echo $userRow['icPatient']; ?>">Appointment</a></li>-->
						</ul>
					</ul>
					
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userRow['fname']; ?> <?php echo $userRow['lname']; ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>
									<a href="patient.php"><i class="glyphicon glyphicon-list-alt"></i> Schedule</a>
								</li>
								<!--<li>
									<a href="profile.php?patientId=<?php echo $userRow['icPatient']; ?>"><i class="fa fa-fw fa-user"></i> Profile</a>
								</li>-->
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
		<!--<form  action="<?php //$_PHP_SELF ?>" method="post" >-->
										
		<!--</form>-->
		<div class="container">
			<section style="padding-bottom: 100px; padding-top: 100px;">
				
					<!-- start -->
					<!-- USER PROFILE ROW STARTS-->
						
						<div class="col-md-3">
							<div class="user-wrapper">
							<img src="<?php if(empty($patientss['profile_image'])){
									echo 'images2/ownerDefault.png';
							}
								else{
									echo 'images2/' . $patientss['profile_image'];
								};
							 ?>"  width="200" height="200" alt="">
							
								<div class="description">
									<h4 style="font-weight: bold;"><?php echo $userRow['fname']; ?> <?php echo $userRow['lname']; ?></h4>
									<h5> Owner </h5>
									<hr/>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Update Profile</button>
									<hr/>
								</div>
								
							</div>
						</div>
						
						<div class="col-md-9 col-sm-9  user-wrapper">

	<div class="description">
								

										<table  class="flatTable">

										<tr class="titleTr">
											<td class="titleTd">Personal Information</td>
											<td class="titleTd"></td>
											<td class="titleTd"></td>
											<td class="titleTd"></td>
											<td class="titleTd"></td>
											<td class="titleTd"></td>
											<td class="titleTd"></td>
										</tr>
											<tr class="headingTr">
													<td>Vet Record</td>
													<td>Date of Birth</td>
													<td>Gender</td>
													<td>Address</td>
													<td>Contact No.</td>
													<td>Email</td>
													<td>Photo</td>
											</tr>
													
											<tr>	
													<td><?php echo $userRow['patientMaritalStatus']; ?></td>
													<td><?php echo $userRow['patientDOB']; ?></td>
													<td><?php echo $userRow['patientGender']; ?></td>
													<td><?php echo $userRow['patientAddress']; ?>
													<td><?php echo $userRow['patientPhone']; ?>
													<td><?php echo $userRow['username']; ?>
						<td style="padding: 10px 10px;"><div class="col-md-3">
							<div class="user-wrapper">
								<img src="<?php 
										if(empty($userRow["profile_image"])){
											echo 'images2/petDefault.png';	
										}
										else{
											echo 'images2/' . $userRow["profile_image"];
										};
								?>"  width="100" height="100" alt="">
								</div>
							</div></td>
											</tr>
																						
										</table>
								
							</div>
							
						</div>
					<!-- USER PROFILE ROW END-->
					<!-- end -->



					<div class="col-md-4">
						
						<!-- Large modal -->
						
						<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 style="font-weight: bold;"class="modal-title" id="myModalLabel">Update Your Profile</h4>
									</div>
									<div class="modal-body">
										<!-- form start -->
        <form action="<?php $_PHP_SELF ?>" method="post" enctype="multipart/form-data">

          <?php if (!empty($msg)): ?>
            <div class="alert <?php echo $msg_class ?>" role="alert">
              <?php echo $msg; ?>
            </div>
          <?php endif; ?>

          <div class="form-group text-center" style="position: relative;" >
            <span class="img-div">
				
              <div class="text-center img-placeholder"  onClick="triggerClick()">
                <h4 style="font-size: 20px;font-weight: bold;">Update Profile Image</h4>
              </div>

              <img src="<?php if(empty($patientss['profile_image'])){
									echo 'images2/ownerDefault.png';
							}
								else{
									echo 'images2/' . $patientss['profile_image'];
								};
							 ?>" onClick="triggerClick()" id="profileDisplay"  style="width: 150px; height: 150px;">
			</span>
            <input type="file"  name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">

          </div>
          <!--<div class="form-group">
            <center><button type="submit" name="save_profile" class="btn btn-info">Update Photo</button><center>
          </div>-->
      
											<table class="table table-user-information">
												<tbody>
													<tr>
														<td style="font-weight: bold;">IC Number</td>
														<td><?php echo $userRow['icPatient']; ?></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">First Name</td>
														<td><input type="text" class="form-control" name="fname" value="<?php echo $userRow['fname']; ?>"  /></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">Last Name</td>
														<td><input type="text" class="form-control" name="lname" value="<?php echo $userRow['lname']; ?>"  /></td>
													</tr>
												
													
													<!-- radio button -->
													<tr>
														<td style="font-weight: bold;">Vet Record</td>
														<td>
															<div class="radio">
																<label><input type="radio" name="PMA" value="New Pet Owner" <?php echo $newPatient; ?>>New Pet Owner</label>
															</div>
															<div class="radio">
																<label><input type="radio" name="PMA" value="Old Pet Owner" <?php echo $oldPatient; ?>>Old Pet Owner</label>
															</div>
															
														</td>
													</tr>
													<!-- radio button end -->
													<tr>
														<td style="font-weight: bold;">Date of Birth</td>
														<!-- <td><input type="text" class="form-control" name="patientDOB" value="<?php echo $userRow['patientDOB']; ?>"  /></td> -->
														<td>
															<div class="form-group ">
																
																<div class="input-group">
																	<div class="input-group-addon">
																		<i class="fa fa-calendar"></i>
																	</div>
																	<input class="form-control" id="patientDOB" name="patientDOB" placeholder="YYYY/MM/DD" type="date" value="<?php echo $userRow['patientDOB']; ?>"/>
																	
																</div>
															</div>
														</td>
														
													</tr>
													<!-- radio button -->
													<tr>
														<td style="font-weight: bold;">Gender</td>
														<td>
															<div class="radio">
																<label><input type="radio" name="patientGender" value="Male" <?php echo $male; ?>>Male</label>
															</div>
															<div class="radio">
																<label><input type="radio" name="patientGender" value="Female" <?php echo $female; ?>>Female</label>
															</div>
														</td>
													</tr>
													<!-- radio button end -->
													
													<tr>
														<td style="font-weight: bold;">Phone number</td>
														<td><input type="text" class="form-control" name="patientPhone" value="<?php echo $userRow['patientPhone']; ?>"  /></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">Email</td>
														<td><input type="text" class="form-control" name="username" value="<?php echo $userRow['username']; ?>"  /></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">Address</td>
														<td><textarea class="form-control" name="patientAddress"  ><?php echo $userRow['patientAddress']; ?></textarea></td>
													</tr>
													<tr>
														<td>
															<input type="submit" name="submit" class="btn btn-info" value="Update"></td>
														</tr>
													</tbody>
													
												</table>
												
												
												
											</form>
											<!-- form end -->
										</div>
										
									</div>
								</div>
							</div>
							<br /><br/>
						</div>
						
					
					<!-- ROW END -->
				</section>
				<!-- SECTION END -->
			</div>
			<!-- CONATINER END -->


			<!-- PET PROFILE -->
			<div class="container">
			<section style="padding-bottom: 100px; padding-top: 100px;">
				
					<!-- start -->
					<!-- PET PROFILE ROW STARTS-->
						
						<div class="col-md-3">
							<div class="user-wrapper">
								<!--<img src="<?php 
										//if(empty($petss["profile_image"])){
										//	echo 'images2/petDefault.png';	
										//}
										//else{
										//	echo 'images2/' . $petss["profile_image"];
										//};
								?>"  width="200" height="200" alt="">-->
								
									<center><div class="description" style="align-items: center;">
										<!--<h4 style="font-weight: bold;"><?php //echo $petRow['Pname']; ?></h4>-->
										<button type="submit" class="btn btn-primary"  data-toggle="modal" data-target="#myModal3" >Add New Pet</button>
										<hr/>
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">Update Pet</button>
										<hr/>
									</div><center>
							</div>
						</div>
						
					
						<div class="col-md-9 col-sm-9  user-wrapper">
							<div class="description">
						
							

						<center><table id="careTable" class="flatTable" >
						<tr class="titleTr">
						<td class="titleTd" style="<?php $dispNone; ?>">Pet Information
						</td>
						<td class="titleTd"></td>
						<td class="titleTd">
						<td class="titleTd"></td><td class="titleTd"></td>
						<td class="titleTd"></td><td class="titleTd"></td>
						<td class="titleTd"></td></tr>
						<tr class="headingTr"><td>Pet Name</td>
						<td>Breed</td><td>Sex</td><td>Age</td><td>Date of Birth</td><td>Height</td><td>Weight</td><td>Photo</td><tr>
							<?php
                            $connnn = mysqli_connect("sql6.freemysqlhosting.net", "sql6472772", "Bftyfpt58L", "sql6472772");
                            if ($connnn-> connect_error) {
                                die ("Connection failed:" . $connnn-> connect_error);
                            }
                                
                                $sql7 = "SELECT Pname, Breed, Sex, Age, DateofBirth, Height, Weight, profile_image from petprofile WHERE icPet=".$_SESSION['icPatient'];
                                $result7 = $connnn-> query($sql7);

                                if ($result7 !== false && $result7->num_rows > 0) {
                                    while ($row7 = $result7-> fetch_assoc()) {
										$petimg = empty($row7["profile_image"]) ? 'images2/petDefault.png' : 'images2/' . $row7["profile_image"];
                                        echo "<td>" . $row7["Pname"] . "</td><td>" . $row7["Breed"] . "</td><td>" . $row7["Sex"] . "</td><td>" . $row7["Age"] . "</td><td>" . $row7["DateofBirth"] . "</td><td>" . $row7["Height"] . "</td><td>" . $row7["Weight"] . "</td><td style='" . "padding: 10px 10px;" . "'>" . "<img style=" . "'width:100px; height:100px;'" . "src=' " . $petimg . " '></td></tr>";
                                        }
                                    echo "</table>";
                                    }
                                    else{
										$dispNone = "display:none;";
                                		echo "<center><div style='" . "margin-bottom: 100px;" . "font-weight: bold;" . "' class=\"alert alert-danger\">Add Your Pet Now!</div><center>";
                                }
                                $connnn-> close();
                        ?>
										
									
										</table><center>
								
						
		  				</div>
					</div>
					<!-- PET PROFILE ROW END-->
					<!-- end -->



					<div class="col-md-4">
						
						<!-- Large modal -->
						
						<!-- Modal -->
						<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 style="font-weight: bold;"class="modal-title" id="myModalLabel">Update Pet</h4>
									</div>
									<div class="modal-body">
										<!-- form start -->

		<form action="<?php $_PHP_SELF ?>" method="post" enctype="multipart/form-data">

		<table class="table table-user-information">
			<tbody>
			<tr>
				<td style="font-weight: bold;">Choose Pet Name</td>
				<td> 
													
					<Select id="PN" onchange="selectedPet()" class="form-control" name="Pname" style="font-weight: bold;">
						<?php
							$ChosenPname = mysqli_query($con, "SELECT Pname From petprofile WHERE icPet=".$_SESSION['icPatient']);  // Use select query here 
									echo "<option>Choose your Pet</option>";							
								while($DPname = mysqli_fetch_array($ChosenPname)){
									echo "<option value='". $DPname['Pname'] ."'>" .$DPname['Pname'] ."</option>";  // displaying data in option menu
								}	
						?>  
															
					</select>
														
				</td>
			</tr>
			</tbody >
		</table>
		
          

          




											<table class="table table-user-information">
												<tbody id="disdetails">
									
													
												</tbody >	
											</table>
																	
												
											</form>
											<!-- form end -->
										</div>
										
									</div>
								</div>
							</div>
							<br /><br/>
						</div>
















						<div class="col-md-4">
						
						<!-- Large modal -->
						
						<!-- Modal -->
						<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 style="font-weight: bold;" class="modal-title" id="myModalLabel">Register Pet</h4>
									</div>
									<div class="modal-body">
										<!-- form start -->

        <form action="<?php $_PHP_SELF ?>" method="post" enctype="multipart/form-data">

          <?php if (!empty($msg)): ?>
            <div class="alert <?php echo $msg_class ?>" role="alert">
              <?php echo $msg; ?>
            </div>
          <?php endif; ?>

          <div class="form-group text-center" style="position: relative;" >
            <span class="img-div">
				
              <div class="text-center img-placeholder"  onClick="triggerClick3()">
                <h4 style="font-weight: bold;">Upload Pet Image</h4>
              </div>

            <img src="images2/petDefault.png" style="width: 150px; height: 150px;" onClick="triggerClick3()" id="petShow">
				</span>
            <input type="file" name="petUpload" onChange="displayImage3(this)" id="petUpload" class="form-control" style="display: none;">

          </div>
          <!--div class="form-group">
            <center><button type="submit" name="save_profile2" class="btn btn-info">Upload Photo</button><center>
          </div>-->
											<table class="table table-user-information">
												<tbody>

													<!--<tr>
														<td>IC Pet</td>
														<td><input type="text" style="color:black;" class="form-control" name="icPet" value="<?php // echo $petRow['icPet']; ?>" disabled></td>
													</tr>-->
													<tr>
														<td style="font-weight: bold;">Pet Name</td>
														<td><input type="text" class="form-control" name="PnameReg" value="<?php //echo $petRow['Pname']; ?>"  /></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">Breed</td>
														<td><input type="text" class="form-control" name="BreedReg" value="<?php //echo $petRow['Breed']; ?>"  /></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">Sex</td>
														<td>
															<div class="radio">
																<label><input type="radio" name="petSexReg" value="Male" <?php //echo $pmale; ?>>Male</label>
															</div>
															<div class="radio">
																<label><input type="radio" name="petSexReg" value="Female" <?php //echo $pfemale; ?>>Female</label>
															</div>
														</td>
													</tr>
														<tr>
															<td style="font-weight: bold;">Age</td>
															<td id="agecompute"><input type="text" class="form-control" name="AgeReg" disabled value=""/></td>
														</tr>
													<tr>
														<td style="font-weight: bold;">Date of Birth</td>
														<!-- <td><input type="text" class="form-control" name="patientDOB" value="<?php //echo $petRow['Date of Birth']; ?>"  /></td> -->
														<td>
															<div class="form-group ">
																
																<div class="input-group">
																	<div class="input-group-addon">
																		<i class="fa fa-calendar">
																		</i>
																	</div>
																	<input class="form-control" id="pDOBr" name="petDOBReg" placeholder="YYYY/MM/DD" type="date" value="<?php //echo $petRow['DateofBirth']; ?>"/>
																</div>
															</div>
														</td>
														
													</tr>
													<tr>
														<td style="font-weight: bold;">Height</td>
														<td><input type="text" class="form-control" name="HeightReg" value="<?php //echo $petRow['Height']; ?>"  /></td>
													</tr>
													<tr>
														<td style="font-weight: bold;">Weight</td>
														<td><input type="text" class="form-control" name="WeightReg" value="<?php //echo $petRow['Weight']; ?>"  /></td>
													</tr>
													<tr>
														<td><input  type="submit" name="submit3" class="btn btn-info" value="Register"></td>
													
													
													</tr>
													
												
													</tbody>
													
												</table>
																	
												
											</form>
											<!-- form end -->
										</div>
										
									</div>
								</div>
							</div>
							<br /><br/>
						</div>
						
					
					<!-- ROW END -->
				</section>
				<!-- SECTION END -->
			</div>
			<!-- CONATINER END -->

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

			<script src="assets/js/jquery.js"></script>
			<script src="assets/js/bootstrap.min.js"></script>		
			
		<script>
			var x = document.getElementById("pDOBr");
			
			x.onchange = function(){
				var birthdate = this.value;	//alert(birthdate);

				$.ajax({
					url:"https://caringpaws-ph.herokuapp.com/patient/showAge.php",
					method: "POST",
					data:{ birthdate : birthdate },
					success:function(data){
						$("#agecompute").html(data);
					}
				})
			}
		</script>

			<script>
				function triggerClick(e) {
    				document.querySelector('#profileImage').click();
  				}
			function displayImage(e) {
				if (e.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e){
					document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
				}
				reader.readAsDataURL(e.files[0]);
				}
			}
  			</script>

			<script>
				function triggerClick2(e) {
    				document.querySelector('#petImage').click();
  				}
			function displayImage2(e) {
				if (e.files[0]) {
				var reader2 = new FileReader();
				reader2.onload = function(e){
					document.querySelector('#petDisplay').setAttribute('src', e.target.result);
				}
				reader2.readAsDataURL(e.files[0]);
				}
			}
  			</script>

			<script>
				function triggerClick3(e) {
    				document.querySelector('#petUpload').click();
  				}
			function displayImage3(e) {
				if (e.files[0]) {
				var reader3 = new FileReader();
				reader3.onload = function(e){
					document.querySelector('#petShow').setAttribute('src', e.target.result);
				}
				reader3.readAsDataURL(e.files[0]);
				}
			}
  			</script>

			<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
			

</script>
<!--<iframe name="frame"></iframe>-->
		</body>
	</html>