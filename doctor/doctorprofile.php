<?php
session_start();
include_once '../assets2/conn/dbconnect.php';
// include_once 'connection/server.php';
if(!isset($_SESSION['doctorSession']))
{
header("Location: ../sched.php");
}

$usersession = $_SESSION['doctorSession'];
$res = mysqli_query($con,"SELECT * FROM doctor WHERE doctorId=".$usersession);
$userRow = mysqli_fetch_array($res,MYSQLI_ASSOC);

if (isset($_POST['submit'])) {
    //variables
    $doctorFirstName = $_POST['doctorFirstName'];
    $doctorLastName = $_POST['doctorLastName'];
    $doctorPhone = $_POST['doctorPhone'];
    $doctorEmail = $_POST['doctorEmail'];
    $doctorAddress = $_POST['doctorAddress'];
    //$docImage = $_POST['docImage'];

    $res=mysqli_query($con,"UPDATE doctor SET doctorFirstName='$doctorFirstName', doctorLastName='$doctorLastName', doctorPhone='$doctorPhone', doctorEmail='$doctorEmail', doctorAddress='$doctorAddress' WHERE doctorId=".$_SESSION['doctorSession']);
    
    // $userRow=mysqli_fetch_array($res);
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
        $sql = "UPDATE doctor SET profile_image='$profileImageName' WHERE doctorId='{$_SESSION['doctorSession']}' ";
        if(mysqli_query($con, $sql)){
            $msg = "Image uploaded and saved in the Database";
            $msg_class = "alert-success"; 
            header("location: ./doctorprofile.php");
        } else {
            $msg = "There was an error in the database";
            $msg_class = "alert-danger";
        }
        } else {
        $error = "There was an error uploading the file";
        $msg = "alert-danger";
        }
    }



    header( 'Location: doctorprofile.php' ) ;
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>CaringPaws | Doctor Profile</title>
        <!-- Bootstrap Core CSS -->
        <link href="assets/css/bootstrap.css" rel="stylesheet"> 
        <link href="assets/css/material.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="assets/css/sb-admin.css" rel="stylesheet">
        <link href="assets/css/time/bootstrap-clockpicker.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        <!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
        <!-- Custom Fonts -->
    <style>
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

        .placeholder {
        font-size: 12px;
        }
</style>
    </head>
    <body>
        <div id="wrapper">

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="doctordashboard.php">
                    <img  src="assets/logo.png" height="25px"><!-- Dr. <?php //echo $userRow['doctorLastName'];?> Dashboard -->
                    </a>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-nav navbar-right">
                    
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Dr. <?php echo $userRow['doctorFirstName']; ?> <?php echo $userRow['doctorLastName']; ?><b class="caret"></b></a>
                       
                        <ul class="dropdown-menu">
                            <!--<li>
                                <a href="doctorprofile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                            </li>
                            <li class="divider"></li>-->
                           

                            <li>
                                <a href="logout.php?logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>


                </ul>
                
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li>
                            <a href="doctordashboard.php"><i class="fa fa-fw fa-dashboard"></i> Appointment List</a>
                        </li>
                        <li>
                            <a href="addschedule.php"><i class="fa fa-fw fa-table"></i> Doctor Schedule</a>
                        </li>
                        <li>
                            <a href="patientlist.php"><i class="fa fa-fw fa-edit"></i> Patient List</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>
            <!-- navigation end -->


            <div id="page-wrapper">
                <div class="container-fluid">
                    
                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header" style="font-weight: bold;">
                            Your Profile
                            </h3>
                            <ol class="breadcrumb">
                                <li class="active">
                                    <i class="fa fa-calendar"></i> Doctor Profile
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- Page Heading end-->

                    <!-- panel start -->
                    <div class="panel panel-primary">

                        <!-- panel heading starat -->
                        <div class="panel-heading">
                            <h3 class="panel-title">Doctor Details</h3>
                        </div>
                        <!-- panel heading end -->

                        <div class="panel-body">
                        <!-- panel content start -->
                          <div class="container">
            <section style="padding-bottom: 50px; padding-top: 50px;">
                <div class="row">
                    <!-- start -->
                    <!-- USER PROFILE ROW STARTS-->
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            
                            <div class="user-wrapper">

                                <img src="<?php if(empty($userRow['profile_image'])){
									echo 'images2/ownerDefault.png';
							}
								else{
									echo 'images2/' . $userRow['profile_image'];
								};
							 ?>" class="img-responsive" />




                                <div class="description">
                                    <h4 style="font-weight: bold;">Dr. <?php echo $userRow['doctorFirstName']; ?> <?php echo $userRow['doctorLastName']; ?></h4>
                                    <hr />
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Update Profile</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-9 col-sm-9  user-wrapper">
                            <div class="description">
                                <h3 style="font-weight: bold;">Doctor Information </h3>
                                <hr />
                                
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        
                                        
                                        <table class="table table-user-information" align="center">
                                            <tbody>
                                                
                                                
                                                <tr>
                                                    <td style="font-weight: bold;">Dr. ID</td>
                                                    <td><?php echo $userRow['doctorId']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: bold;">IC No.</td>
                                                    <td><?php echo $userRow['icDoctor']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: bold;">Address</td>
                                                    <td><?php echo $userRow['doctorAddress']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: bold;">Contact No.</td>
                                                    <td><?php echo $userRow['doctorPhone']; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: bold;">E-mail</td>
                                                    <td><?php echo $userRow['doctorEmail']; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: bold;">Date of Birth</td>
                                                    <td><?php echo $userRow['doctorDOB']; ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                    <!-- USER PROFILE ROW END-->
                    <div class="col-md-4">
                        
                        <!-- Large modal -->
                        
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 style="font-weight: bold;"class="modal-title" id="myModalLabel">Update Profile</h4>
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
                <h4>Update Image</h4>
              </div>

              <img name="docImage" src="<?php if(empty($userRow['profile_image'])){
									echo 'images2/ownerDefault.png';
							}
								else{
									echo 'images2/' . $userRow['profile_image'];
								};
							 ?>" onClick="triggerClick()" id="profileDisplay"  style="width: 150px; height: 150px;">
			</span>
            <input type="file"  name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">

          </div>
                                            <table class="table table-user-information">
                                                <tbody>
                                                    <tr>
                                                        <td style="font-weight: bold;">IC No.</td>
                                                        <td><?php echo $userRow['icDoctor']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-weight: bold;">First Name</td>
                                                        <td><input type="text" class="form-control" name="doctorFirstName" value="<?php echo $userRow['doctorFirstName']; ?>"  /></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-weight: bold;">Last Name</td>
                                                        <td><input type="text" class="form-control" name="doctorLastName" value="<?php echo $userRow['doctorLastName']; ?>"  /></td>
                                                    </tr>
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    <tr>
                                                        <td style="font-weight: bold;">Phone No.</td>
                                                        <td><input type="text" class="form-control" name="doctorPhone" value="<?php echo $userRow['doctorPhone']; ?>"  /></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-weight: bold;">E-mail</td>
                                                        <td><input type="text" class="form-control" name="doctorEmail" value="<?php echo $userRow['doctorEmail']; ?>"  /></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-weight: bold;">Address</td>
                                                        <td><textarea class="form-control" name="doctorAddress"  ><?php echo $userRow['doctorAddress']; ?></textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="submit" name="submit" class="btn btn-info" value="Update Info"></td>
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
                        
                    </div>
                        <!-- panel content end -->
                        <!-- panel end -->
                        </div>
                    </div>
                    <!-- panel start -->

                </div>
            </div>
        <!-- /#wrapper -->


       
        <!-- jQuery -->
        <script src="../patient/assets/js/jquery.js"></script>
        
        <!-- Bootstrap Core JavaScript -->
        <script src="../patient/assets/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap-clockpicker.js"></script>
        <!-- Latest compiled and minified JavaScript -->
         <!-- script for jquery datatable start-->
        <!-- Include Date Range Picker -->
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
    </body>
</html>