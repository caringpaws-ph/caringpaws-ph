<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE patient SET password = ? WHERE icPatient = ?";
        
        if($stmt = mysqli_prepare($mysqli , $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_icPatient);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_icPatient = $_SESSION["icPatient"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
      
                $_SESSION["success7"] = "<div style='" . "margin-bottom: 100px; padding-bottom: 20px;" . "' class=\"alert alert-success\">Your password has been reset! Sign in now!</div>";
                header("location: index.php");
                exit();
            } else{
                $_SESSION["failed7"] = "<div style='" . "margin-bottom: 100px; padding-bottom: 20px;" . "' class=\"alert alert-success\">Oops! Something went wrong. Please try again later.</div>";
                header("location: index.php");
                exit();
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($mysqli);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CaringPaws | Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        body{font: 14px sans-serif; vertical-align: middle; display: flex; justify-content: center; padding-top: 12%;}
        .wrapper{ width: 360px; padding: 20px; }
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
</head>
<body>
    
    <div class="wrapper">

        <a href="index.php"><img src="logo/logo.png" alt=""></a>
        <div style="padding-bottom: 20px;"></div>
        <h2 >Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <center><div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link ml-2" href="index.php">Cancel</a>
            </div><center>
        </form>
    </div>    
</body>
</html>