<link rel="icon" href="pagelogo.png" sizes="16x16" type="image/png">
<?php
session_start();	
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$fname = $lname = $username = $password = $confirm_password = $icPatient = $month = $day = $year = $petGender = $petDOB = $patientDOB = "";
$fname_err = $lname_err = $username_err = $password_err = $confirm_password_err = $icPatient_err = $patientDOB_err = $petGender_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Validate firstname
    if(empty(trim($_POST["fname"]))){
      $fname_err = "Please enter first name.";
  } else{
      // Prepare a select statement
      $sql = "SELECT id FROM patient WHERE fname = ?";
      
      if($stmt = $mysqli->prepare($sql)){
          // Bind variables to the prepared statement as parameters
          $stmt->bind_param("s", $param_fname);
          
          // Set parameters
          $param_fname = trim($_POST["fname"]);
          
          // Attempt to execute the prepared statement
          if($stmt->execute()){
              // store result
              $stmt->store_result();
              $fname = trim($_POST["fname"]);

          } else{
              echo "Oops! Something went wrong. Please try again later.";
          }

          // Close statement
          $stmt->close();
      }
  }

  // Validate lastname
  if(empty(trim($_POST["lname"]))){
    $lname_err = "Please enter last name.";
} else{
    // Prepare a select statement
    $sql = "SELECT id FROM patient WHERE lname = ?";
    
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("s", $param_lname);
        
        // Set parameters
        $param_lname = trim($_POST["lname"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // store result
            $stmt->store_result();
            $lname = trim($_POST["lname"]);

        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }
}

    // Validate email
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM patient WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $username_err = "This email is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

          // Validate IC Number
  if(empty(trim($_POST["icPatient"]))){
    $icPatient_err = "Please enter an ID No.";
  } else{
    // Prepare a select statement
    $sql = "SELECT id FROM patient WHERE icPatient = ?";
    
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("s", $param_icPatient);

        // Set parameters
        $param_icPatient = trim($_POST["icPatient"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // store result
            $stmt->store_result();
            
            if($stmt->num_rows == 1){
                $icPatient_err = "This ID No. is already taken.";
            } else{
                $icPatient = trim($_POST["icPatient"]);
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }
}

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
// Validate Pet Birthdate
if(empty(trim($_POST["date"]))){
    $patientDOB_err = "Please enter Pet Birthdate";
  } else{

    // Combine Y/M/D
    $patientDOB = trim($_POST['date']);

    // Prepare a select statement
    $sql = "SELECT id FROM patient WHERE patientDOB = ?";
    
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("s", $param_patientDOB);
        
        // Set parameters
        $param_patientDOB = $patientDOB;

        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // store result
            $stmt->store_result();
            $patientDOB = $patientDOB;

            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }
}

// Validate Pet Gender
if(empty(trim($_POST["patientGender"]))){
    $petGender_err = "Please select a pet gender";
  } else{

    // Prepare a select statement
    $sql = "SELECT id FROM patient WHERE patientGender = ?";
    
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("s", $param_petGender);
        
        // Set parameters
        $param_petGender = trim($_POST["patientGender"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // store result
            $stmt->store_result();
            $petGender = trim($_POST["patientGender"]);

            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }
}


    // Check input errors before inserting in database
    if(empty($icPatient_err) && empty($fname_err) && empty($lname_err) && empty($username_err) &&  empty($password_err) && empty($confirm_password_err) && empty($patientDOB_err) && empty($petGender_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO patient (icPatient, fname, lname, username, password, patientDOB, patientGender) VALUES (?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssssss", $param_icPatient, $param_fname, $param_lname, $param_username, $param_password, $param_patientDOB, $param_petGender);
            
            // Set parameters
            $param_icPatient = $icPatient;
            $param_fname = $fname;
            $param_lname = $lname;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_patientDOB = $patientDOB;
            $param_petGender = $petGender;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                $_SESSION["success6"] = "<div style='" . "margin-bottom: 100px; padding-bottom: 20px;" . "' class=\"alert alert-success\">Your account has been registered! Sign in now!</div>";
                header("location: index.php");
                exit();
                //if ($stmt2 = $mysqli->prepare("INSERT INTO petprofile (icPet) VALUES (?)")) {
                //    $stmt2->bind_param('s', $param_icPatient);

                //    $param_icPatient = $icPatient;

                //    if (!$stmt2->execute()) {
                //        throw new Exception($stmt2->error);
                //    } else{
                //        echo "Error insert to petprofile";
                //    }
                //}


            } else{
                $_SESSION["failed6"] = "<div style='" . "margin-bottom: 100px;" . "' class=\"alert alert-warning\">Something went wrong. Please try again later.</div>";
                header("location: index.php");
                exit();
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $mysqli->close();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css3/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css3/bootstrap.min.css">

    <!--  jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
    <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
    <link rel="stylesheet" href="./css/bootstrap-iso.css" />

    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

    <!-- Style -->
    <style>
        body {
        font-family: "Roboto", sans-serif;
        background-color: #fff; 
        }
        p {
        color: #b3b3b3;
        font-weight: 30; }
        h1, h2, h3, h4, h5, h6,
        .h1, .h2, .h3, .h4, .h5, .h6 {
        font-family: "Roboto", sans-serif; }
        a {
        -webkit-transition: .3s all ease;
        -o-transition: .3s all ease;
        transition: .3s all ease; }
        a:hover {
            text-decoration: none !important; }
        .content {
            padding: 7rem 0; }
        h2 {
            font-size: 20px; }
        .half, .half .container > .row {
            height: 100vh; }
        @media (max-width: 500px) {
        .half .bg {
            height: 500px; } }
        .half .contents, .half .bg {
            width: 100%; }
        @media (max-width: 1199.98px) {
        .half .contents, .half .bg {
            width: 100%; } }
        .half .contents .form-group, .half .bg .form-group {
            /* spaces ng inputs */ margin-bottom: .2rem;
            border: 2px solid #efefef;
    /* ETO UNG LAPAD NUNG INPUTS */ padding: 5px 5px;
            border-bottom: none; }
            .half .contents .form-group.first, .half .bg .form-group.first {
            border-top-left-radius: 7px;
            border-top-right-radius: 7px; }
            .half .contents .form-group.last, .half .bg .form-group.last {
            border-bottom: 1px solid #efefef;
            border-bottom-left-radius: 7px;
            border-bottom-right-radius: 7px; }
            .half .contents .form-group label, .half .bg .form-group label {
            font-size: 12px;
            display: block;
            margin-bottom: 0;
            color: #b3b3b3; }
        .half .contents .form-control, .half .bg .form-control {
            border: none;
            padding: 0;
            font-size: 10px;
            border-radius: 0; }
            .half .contents .form-control:active, .half .contents .form-control:focus, .half .bg .form-control:active, .half .bg .form-control:focus {
            outline: none;
            -webkit-box-shadow: none;
            box-shadow: none; }

        .half .bg {
        background-size: cover;
        background-position: center; }

        .half a {
        color: #888;
        text-decoration: underline; }

        .half .btn {
        height: 54px;
        padding-left: 30px;
        padding-right: 30px; }

        .half .forgot-pass {
        position: relative;
        top: 2px;
        font-size: 14px; }

        .control {
        display: block;
        position: relative;
        padding-left: 30px;
        margin-bottom: 15px;
        cursor: pointer;
        font-size: 14px; }
        .control .caption {
            position: relative;
            top: .2rem;
            color: #888; }

        .control input {
        position: absolute;
        z-index: -1;
        opacity: 0; }

        .control__indicator {
        position: absolute;
        top: 2px;
        left: 0;
        height: 20px;
        width: 20px;
        background: #e6e6e6;
        border-radius: 4px; }

        .control--radio .control__indicator {
        border-radius: 50%; }

        .control:hover input ~ .control__indicator,
        .control input:focus ~ .control__indicator {
        background: #ccc; }

        .control input:checked ~ .control__indicator {
        background: #007bff; }

        .control:hover input:not([disabled]):checked ~ .control__indicator,
        .control input:checked:focus ~ .control__indicator {
        background: #1a88ff; }

        .control input:disabled ~ .control__indicator {
        background: #e6e6e6;
        opacity: 0.9;
        pointer-events: none; }

        .control__indicator:after {
        font-family: 'icomoon';
        content: '\e5ca';
        position: absolute;
        display: none;
        font-size: 16px;
        -webkit-transition: .3s all ease;
        -o-transition: .3s all ease;
        transition: .3s all ease; }

        .control input:checked ~ .control__indicator:after {
        display: block;
        color: #fff; }

        .control--checkbox .control__indicator:after {
        top: 50%;
        left: 50%;
        margin-top: -1px;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%); }

        .control--checkbox input:disabled ~ .control__indicator:after {
        border-color: #7b7b7b; }

        .control--checkbox input:disabled:checked ~ .control__indicator {
        background-color: #7e0cf5;
        opacity: .2; }

  </style>
<!--  jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
<link rel="stylesheet" href="./css/bootstrap-iso.css" />

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    <title>Caring Paws | Sign Up</title>
  </head>
  <body>
  
  

  <div  class="d-lg-flex half">
    
    <!--<div class="contents order-1 order-md-2">-->         
                 
      <div class="container">
            
        <div class="row align-items-center justify-content-center" >


                <a href="index.php"><img src="logo/logo.png" alt="" height="70px"></a>
       

            <hr>

          <div class="col-md-4" ><!--style="padding-top: 100px; padding-bottom: 100px;"-->
            <h3>Sign Up to <strong>CaringPaws</strong></h3>
            <p class="mb-4">Complete the required details in order to sign up.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

              <div class="form-group form-group  <?php echo (!empty($fname_err)) ? 'has-error' : ''; ?> first">
                <!--<label for="username">First Name</label>-->
                <input name="fname" type="text" class="form-control" placeholder="First name" id="fname" value="<?php echo $fname; ?>">
                <span class="help-block"><?php echo $fname_err; ?></span>
              </div>
              
              <div class="form-group form-group  <?php echo (!empty($lname_err)) ? 'has-error' : ''; ?> first">
                <!--<label for="username">Last Name</label>-->
                <input name="lname" type="text" class="form-control" placeholder="Last Name" id="lname" value="<?php echo $lname; ?>">
                <span class="help-block"><?php echo $lname_err; ?></span>
              </div>

              <div class="form-group form-group  <?php echo (!empty($username_err)) ? 'has-error' : ''; ?> first">
                <!--<label for="username">Email</label>-->
                <input name="username" type="text" class="form-control" placeholder="Email" id="username" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
              </div>

              <div class="form-group form-group  <?php echo (!empty($icPatient_err)) ? 'has-error' : ''; ?> first">
                <!--<label for="username">IC Number</label>-->
                <input name="icPatient" type="text" class="form-control" placeholder="IC Number" id="icPatient" value="<?php echo $icPatient; ?>">
                <span class="help-block"><?php echo $icPatient_err; ?></span>
              </div>

              <div class="form-group form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?> first">
                <!--<label for="password">Password</label>-->
                <input name="password" type="password" class="form-control" placeholder="New Password" id="password" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
              </div>

              <div class="form-group form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?> last mb-3">
                <!--<label for="password"> Confirm Password</label>-->
                <input name="confirm_password" type="password" class="form-control" placeholder="Confirm Password" id="password" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
              </div>
              
              <div class="form-group">       
                    <input class="form-control" id="date" name="date" placeholder="YYYY/MM/DD" type="text"/>
              </div>
              
                        <div class="form-group form-group <?php echo (!empty($petGender_err)) ? 'has-error' : ''; ?> last mb-3">    
                                    <div class="col-xs-4 col-md-4">
                                        <label>Gender</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="patientGender" value="Male" required/> Male
                                        </label>
                                        <label class="radio-inline" >
                                            <input type="radio" name="patientGender" value="Female" required/> Female
                                        </label>
                                    </div>
                        </div>
              <p style="align: justify; text-align: justify;">By clicking Sign Up, you agree about using your personal information in CaringPaws. You may receive Email Notifications from us.</p>
              <input type="submit" value="Sign Up" class="btn btn-block btn-primary">
              
              <br>
              <p>Have an account? <a href="index.php">Sign In</a>.</p>
            </form>
          </div>
        </div>
      </div>
    </div>
<!--<div class="bg order-2 order-md-1" style="height: 160%; background-image: url('assets/img/gallery/about.png');"></div>-->
  </div>
    
    
    <script>
    $(document).ready(function(){
      var date_input=$('input[name="date"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
</script>
  </body>
</html>