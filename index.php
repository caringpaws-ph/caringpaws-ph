<link rel="icon" href="pagelogo.png" sizes="16x16" type="image/png">

<?php
// Initialize the session
session_start();
// if (isset($_SESSION['icPatient'])){
    $checker = "";
    if(isset($_SESSION['checker'])){
        $checker = $_SESSION['checker'];
        if($checker == 1){
            $_SESSION['checker'] = $checker;
            echo '<script language="javascript">';
            echo '</script>';
        }else{
            $checker = 0;
            $_SESSION['checker'] = $checker;
            echo '<script language="javascript">';
            echo '</script>';
        }
    }else{
        $checker = 0;
        $_SESSION['checker'] = $checker;
        echo '<script language="javascript">';
        echo '</script>';
    }
 
// Include config file
require_once "config.php";



// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["icPatient"]))){
        $username_err = "Please enter IC No.";
    } else{
        $username = trim($_POST["icPatient"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, icPatient, password FROM patient WHERE icPatient = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();
                
                // Check if username exists, if yes then verify password
                if($stmt->num_rows == 1){                    
                    // Bind result variables
                    $stmt->bind_result($id, $username, $hashed_password);
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["icPatient"] = $username;      
                            
                            if(!empty($_POST["remember"])) {
                                setcookie ("icPatient",$_POST["icPatient"],time()+ 3600);
                                setcookie ("password",$_POST["password"],time()+ 3600);
                                echo "Cookies Set Successfuly";
                            } else {
                                setcookie("icPatient","");
                                setcookie("password","");
                                echo "Cookies Not Set";
                            }
                            
                            // Redirect user to welcome page
                            header("location: ./index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that IC No.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $mysqli->close();
}
?>
<?php

  if (isset($_SESSION['icPatient']))    
  {    
    $sql = "SELECT * FROM patient WHERE icPatient='". $_SESSION['icPatient']."'"; //sql code 
    $results = mysqli_query($mysqli, $sql); //sends sql code
        if(mysqli_num_rows($results) > 0){
            $row = mysqli_fetch_assoc($results);
        }    
    }   

  ///////////////////////////////////////

  if(isset($_SESSION['icPatient']))
  {
    $sql6 = "SELECT username FROM patient WHERE icPatient='". $_SESSION['icPatient']."'"; //sql code 
    $results6 = mysqli_query($mysqli, $sql6); //sends sql code

        if(mysqli_num_rows($results6) > 0){
            $row6 = mysqli_fetch_assoc($results6);
        }
    }

?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Caring Paws | Home</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <script src="https://kit.fontawesome.com/119baa66af.js" crossorigin="anonymous"></script>

    <style>
.firstaid{
    height: 200px;
}
.petadvice{
    height: 200px;
}
.getideas{
    height: 200px;
}
.secondop{
    height: 200px;
}

table{
    
    width: 100%;
    border-spacing: 60px;
   
}

.center{
    background-image:url(assets/img/hero/hero2.png);
    background-position: center;
    margin: auto;
    width: 100%;
    height: 100%;
    padding: 100px;
    position: relative;
}
.para{
    margin: auto;
    width: 80%;
    padding: 10px;
    text-align: center;
}
.h2o{
    padding-left: 30px;
}
.taas{
    text-align: center;
    
}
.paa{
    margin: auto;
    width: 80%;
    padding: 10px;
    text-align: center;
}
.wrapper{
    position: relative;
}

@import url('https://fonts.googleapis.com/css?family=Hind:300,400&display=swap');

 .accordion .accordion-item {
	 border-bottom: 1px solid #e5e5e5;
}
 .accordion .accordion-item button[aria-expanded='true'] {
	 border-bottom: 1px solid #ff2121;
}
 .accordion button {
	 position: relative;
	 display: block;
	 text-align: left;
	 width: 100%;
	 padding: 1em 0;
	 color: #7288a2;
	 font-size: 1.15rem;
	 font-weight: 400;
	 border: none;
	 background: none;
	 outline: none;
}
 .accordion button:hover, .accordion button:focus {
	 cursor: pointer;
	 color: #dca73a;
}
 .accordion button:hover::after, .accordion button:focus::after {
	 cursor: pointer;
	 color: #03b5d2;
	 border: 1px solid #03b5d2;
}
 .accordion button .accordion-title {
	 padding: 1em 1.5em 1em 0;
}
 .accordion button .icon {
	 display: inline-block;
	 position: absolute;
	 top: 18px;
	 right: 0;
	 width: 22px;
	 height: 22px;
	 border: 1px solid;
	 border-radius: 22px;
}
 .accordion button .icon::before {
	 display: block;
	 position: absolute;
	 content: '';
	 top: 9px;
	 left: 5px;
	 width: 10px;
	 height: 2px;
	 background: currentColor;
}
 .accordion button .icon::after {
	 display: block;
	 position: absolute;
	 content: '';
	 top: 5px;
	 left: 9px;
	 width: 2px;
	 height: 10px;
	 background: currentColor;
}
 .accordion button[aria-expanded='true'] {
	 color: #ff2121;
}
 .accordion button[aria-expanded='true'] .icon::after {
	 width: 0;
}
 .accordion button[aria-expanded='true'] + .accordion-content {
	 opacity: 1;
	 max-height: 15em;
	 transition: all 200ms linear;
	 will-change: opacity, max-height;
}
 .accordion .accordion-content {
	 opacity: 0;
	 max-height: 0;
	 overflow: hidden;
	 transition: opacity 200ms linear, max-height 200ms linear;
	 will-change: opacity, max-height;
}
 .accordion .accordion-content p {
	 font-size: 1rem;
	 font-weight: 300;
	 margin: 2em 0;
}
</style>
<script>
    function myFunction(e) {

        var x;
        var r = confirm("Login first");

        if (r == true) {
            x = "You pressed OK!";
            e.preventDefault();
        }
        else {
            x = "You pressed Cancel!";
            e.preventDefault();
        }

        document.getElementById("").onbeforeunload = x;
    }
</script>
</head>

<body>

    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->

    <header>

        <!--? Header Start -->
        <div class="header-area header-transparent">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2 col-md-1">
                            <div class="logo">
                                <a href="maindashboard.php"><img src="logo/logo.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10 col-md-10">
                            <div class="menu-main d-flex align-items-center justify-content-end">
                                <!-- Main-menu -->
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav> 
                                        <ul id="navigation">
                                            <!--<li><a href="index.php">Home</a></li>-->
                                            <li><a href="about.php" style="font-weight: bold;">About</a></li>
                                            <li><a href="services.php" style="font-weight: bold;">Services</a></li>
                                            <!--<li><a href="blog1.php">Educational Center</a>-->
                                                <!--<ul class="submenu">-->
                                                    <!--<li><a href="blog1.php">Blog</a></li>-->
                                                    <!--blog_details.html-->
                                                    <!--<li><a href="blog1.php">Blog Details</a></li>-->
                                                    <!--<li><a href="elements.html">Element</a></li>-->
                                                <!--</ul>-->
                                            <!--</li>-->
                                            <li><a href="contact.php" style="font-weight: bold;">Contact</a></li>

                                            <li>
                                                <?php if(isset($_SESSION['loggedin'])): ?>
                                                    <!-- show HTML logout button -->
                                                    <a href="./patient/patient.php" style="font-weight: bold;">Appointment</a>
                                                <?php else: ?>
                                                    <!-- show HTML login button -->
                                                    <a href="javascript:window.location.href=myFunction();" style="font-weight: bold;">Appointment</a>
                                                <?php endif; ?>
                                            </li>
                                          
                                            <li style="">
                                            
                                            <?php if(isset($_SESSION['loggedin'])): ?>
                                                        <!-- show HTML logout button -->
                                                            <a href="logout.php" style="padding:27px 36px; padding:18px 36px; color: white; font-weight: bold; background:#ff2121; border-radius:30px;">Sign Out</a>
            <ul class="submenu" style="width: 100%;">
            
        
                            <center><span class="ml-auto" ><a href="resetpass.php" class="forgot-pass" value="" style="font-weight: bold;">Forgot Password</a></span><center>
                            

            </ul>
                                                            
                                            <?php else: ?>
                                                        <!-- show HTML login button -->
                                                        <a href="#" style="padding:27px 80px; padding:18px 80px; color: white; font-weight: bold; background:#ff2121; border-radius:30px;">Sign in</a>
                                                            <ul class="submenu" style="padding: 10px 10px; padding-bottom: 3px; width: 100%; align-items: center;">
            
            
                                                        <h3>Sign In to <strong>CaringPaws</strong></h3>
                                                            <p class="mb-4">Welcome to CaringPaws. We take care of your love ones.</p>
                                                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                                                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?> first">
                                                                        <label for="username">IC No.</label>
                                                                        <input name="icPatient" type="text" class="form-control" placeholder="ID Number" id="icPatient" value="<?php if(isset($_COOKIE["icPatient"])) { echo $_COOKIE["icPatient"]; } ?>">
                                                                        <span class="help-block"><?php echo $username_err; ?></span>
                                                                    </div>
                                                                    <div class="form-group form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?> last mb-3">
                                                                        <label for="password">Password</label>
                                                                        <input name="password" type="password" class="form-control" placeholder="Password" id="password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>">
                                                                        <span class="help-block"><?php echo $password_err; ?></span>
                                                                    </div>
                                                                    <br>
                                                                        <center><span class="mb-auto" style="color: black;">Remember me  <input class="control control--checkbox mb-0"type="checkbox" name="remember" checked="checked"/><!--<div class="control__indicator"></div>--></span><center>
                                                                    <br>
                                                                        <input type="submit" value="Log In" class="btn btn-block btn-primary"/>
                                                                    <br>
                                                                    <br>
                                                                      
                                                                        <span class="mb-auto" >Need to CaringPaws?<a href="register.php" style="font-weight: bold;">Join now</a>.</span>
                                                                </form>
           
                                                        </ul>

                                            <?php endif; ?>
                                            
                                            </li>
                                        </ul>

                                    </nav>
                                </div>

                            </div>    
                        </div>   
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>    
                        
    <?php if (isset($_SESSION['success6']))    
    {    
        echo $_SESSION['success6'] ;
        unset($_SESSION['success6']);
    } 
    if(isset($_SESSION['failed6'])){
        echo $_SESSION['failed6'] ;
        unset($_SESSION['failed6']);

    }?>
    <?php if (isset($_SESSION['success7']))    
    {    
        echo $_SESSION['success7'] ;
        unset($_SESSION['success7']);
    } 
    if(isset($_SESSION['failed7'])){
        echo $_SESSION['failed7'] ;
        unset($_SESSION['failed7']);

    }?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>

    <main> 

        <!--? Slider Area Start-->
        <div class="slider-area">
            <div class="slider-active dot-style">
                <!-- Slider Single -->
                <div class="single-slider d-flex align-items-center slider-height">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-7 col-lg-8 col-md-10 ">
                                <!-- Video icon 
                                <div class="video-icon">
                                    <a class="popup-video btn-icon" href="" data-animation="bounceIn" data-delay=".4s">
                                        <i class="fas fa-play"></i>
                                    </a>
                                </div>-->
                                <div class="hero__caption">
                                    <span data-animation="fadeInUp" data-delay=".3s">Need an urgent help?</span>
                                    <h1  data-animation="fadeInUp" data-delay=".3s">Connect With Us.</h1>
                                    <p data-animation="fadeInUp" data-delay=".6s">CaringPaws is your trusted source of pet care information. <br>Talk to a vet today! Contact us now and make an appointment today.</p>
                                    <a href="https://m.me/CaringPawsPH" class="hero-btn" data-animation="fadeInLeft" data-delay=".3s">Message Now<i class="ti-arrow-right"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
                <!-- Slider Single -->
                <div class="single-slider d-flex align-items-center slider-height">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-7 col-lg-8 col-md-10 ">
                                <!-- Video icon -->
                                <!--<div class="video-icon">
                                    <a class="popup-video btn-icon" href="" data-animation="bounceIn" data-delay=".4s">
                                        <i class="fas fa-play"></i>
                                    </a>
                                </div>-->
                                <div class="hero__caption">
                                    <span data-animation="fadeInUp" data-delay=".3s">Here in CaringPaws,</span>
                                    <h1 data-animation="fadeInUp" data-delay=".3s"  style="padding-right: 3px;">We Care for Your Pets.</h1>
                                    <p data-animation="fadeInUp" data-delay=".6s">CaringPaws is your trusted source of pet care information. <br>Talk to a vet today! Contact us now and make an appointment today.</p>
                                    <a href="http://localhost/caringpaws/index.php#contact-form-top" class="hero-btn" data-animation="fadeInLeft" data-delay=".3s">Email Us<i class="ti-arrow-right"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
            <!-- slider Social -->
            <div class="button-text d-none d-md-block">
            <span></span>
            </div>
        </div>
        <!-- Slider Area End -->
        
        <!--? Our Services Start -->
    <div class="container" style="margin: 0 auto; padding: 8rem; width: 52rem;">
    <?php
    if (isset($_SESSION['success2']))    
    {    
        echo $_SESSION['success2'] ;
        unset($_SESSION['success2']);
    } 
    if(isset($_SESSION['failed2'])){
        echo $_SESSION['failed2'] ;
        unset($_SESSION['failed2']);
    }
    ?>

        <center><h2>Educational Center</h2><center>


        <br>
            <center><p class="sample-text">CaringPaws is your trusted source of pet care information. Obtain brief answers or chat with a veterinarian privately about your dog, cat or any other pet.</p></center>
        </br>



        <div class="accordion">

            <div class="accordion-item">
                    <tr>
                    <th><button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">Health</span><span class="icon" aria-hidden="true"></span></button></th>
                        <?php if(isset($_SESSION['loggedin'])): ?>
                        <div class="accordion-content">
                            <table id="healthTable">
                            <?php
                                $connn = mysqli_connect("localhost", "root", "", "db_healthcare");
                                if ($connn-> connect_error) {
                                    die ("Connection failed:" . $connn-> connect_error);
                                }
                                
                                $sql1 = "SELECT Health, Link from health";
                                $result1 = $connn-> query($sql1);

                                if ($result1-> num_rows > 0) {
                                    while ($row1 = $result1-> fetch_assoc()) {
                                        echo "<tr><td style=" . "display:none;" . ">". $row1["Health"] . "</td><td>" . "<button type=" . "button" . " class=" . "btnSelect" .  " onclick=" . "window.location.href='" . $row1["Link"] . "';" . " id=" . "accordion-button-1" . ">" . "<center>" . $row1["Health"] . "<center>" . "</button>" ."</td></tr>";
                                        }
                                    echo "</table>";
                                    }

                                    else{
                                echo "No result.";
                                }

                                $connn-> close();

                            ?>
                        </div>
                        <?php else: ?>
                            <div class="accordion-content"><a href="javascript:window.location.href=myFunction();">
                                <table id="healthTable">
                                <?php
                                    $connn = mysqli_connect("localhost", "root", "", "db_healthcare");
                                    if ($connn-> connect_error) {
                                        die ("Connection failed:" . $connn-> connect_error);
                                    }
                                    
                                    $sql1 = "SELECT Health, Link from health";
                                    $result1 = $connn-> query($sql1);

                                    if ($result1-> num_rows > 0) {
                                        while ($row1 = $result1-> fetch_assoc()) {
                                            echo "<tr><td style=" . "display:none;" . ">". $row1["Health"] . "</td><td>" . "<button type=" . "button" . " class=" . "btnSelect" .  " onclick=" . "window.location.href='" . $row1["Link"] . "';" . " id=" . "accordion-button-1" . ">" . "<center>" . $row1["Health"] . "<center>" . "</button>" ."</td></tr>";
                                            }
                                        echo "</table>";
                                        }

                                        else{
                                    echo "No result.";
                                    }

                                    $connn-> close();

                                ?>
                            </a></div>
                        <?php endif; ?>
                    </tr>
                </table>
            </div>


            <div class="accordion-item">
                <tr>
                <th><button id="accordion-button-2" aria-expanded="false"><span class="accordion-title">Behavior</span><span class="icon" aria-hidden="true"></span></button></th>
                <?php if(isset($_SESSION['loggedin'])): ?>
                <div class="accordion-content">
                    <table id="behaviorTable">
                        <?php
                            $connnn = mysqli_connect("localhost", "root", "", "db_healthcare");
                            if ($connnn-> connect_error) {
                                die ("Connection failed:" . $connnn-> connect_error);
                            }
                                
                                $sql2 = "SELECT Behavior, Link from behavior";
                                $result2 = $connnn-> query($sql2);

                                if ( $result2-> num_rows > 0 ) {
                                    while ( $row2 = $result2-> fetch_assoc()) {
                                        echo "<tr><td style=" . "display:none;" . ">". $row2["Behavior"] . "</td><td>" . "<button type=" . "button" . " class=" . "btnSelect2" .  " onclick=" . "window.location.href='" . $row2["Link"] . "';" . " id=" . "accordion-button-2" . ">" . "<center>" . $row2["Behavior"] . "<center>" . "</button>" ."</td></tr>";
                                        }
                                    echo "</table>";
                                    }
                                    else{
                                echo "No result.";
                                }
                                $connnn-> close();
                        ?>
                </div>
                        <?php else: ?>
                            <div class="accordion-content"><a href="javascript:window.location.href=myFunction();">
                    <table id="behaviorTable">
                        <?php
                            $connnn = mysqli_connect("localhost", "root", "", "db_healthcare");
                            if ($connnn-> connect_error) {
                                die ("Connection failed:" . $connnn-> connect_error);
                            }
                                
                                $sql2 = "SELECT Behavior, Link from behavior";
                                $result2 = $connnn-> query($sql2);

                                if ( $result2-> num_rows > 0 ) {
                                    while ( $row2 = $result2-> fetch_assoc()) {
                                        echo "<tr><td style=" . "display:none;" . ">". $row2["Behavior"] . "</td><td>" . "<button type=" . "button" . " class=" . "btnSelect2" .  " onclick=" . "window.location.href='" . $row2["Link"] . "';" . " id=" . "accordion-button-2" . ">" . "<center>" . $row2["Behavior"] . "<center>" . "</button>" ."</td></tr>";
                                        }
                                    echo "</table>";
                                    }
                                    else{
                                echo "No result.";
                                }
                                $connnn-> close();
                        ?></a>
                    </div>
                <?php endif; ?>
                    </tr>
                </table>
            </div>

            <div class="accordion-item">
                <tr>
                <th><button id="accordion-button-3" aria-expanded="false"><span class="accordion-title">Nutrition</span><span class="icon" aria-hidden="true"></span></button></th>
                <?php if(isset($_SESSION['loggedin'])): ?>
                    <div class="accordion-content">
                        <table id="nutritionTable">
                            <?php
                                $connnnn = mysqli_connect("localhost", "root", "", "db_healthcare");
                                if ($connnnn-> connect_error) {
                                    die ("Connection failed:" . $connnnn-> connect_error);
                                }
                                    
                                    $sql3 = "SELECT Nutrition, Link from nutrition";
                                    $result3 = $connnnn-> query($sql3);

                                    if ($result3-> num_rows > 0) {
                                        while ( $row3 = $result3-> fetch_assoc()) {
                                            echo "<tr><td style=" . "display:none;" . ">". $row3["Nutrition"] . "</td><td>" . "<button type=" . "button" . " class=" . "btnSelect3" .  " onclick=" . "window.location.href='" . $row3["Link"] . "';" . " id=" . "accordion-button-3" . ">" . "<center>" . $row3["Nutrition"] . "<center>" . "</button>" ."</td></tr>";
                                            }
                                        echo "</table>";
                                        }
                                        else{
                                    echo "No result.";
                                    }
                                    $connnnn-> close();
                            ?>
                    </div>
                <?php else: ?>
                    <div class="accordion-content"><a href="javascript:window.location.href=myFunction();">
                        <table id="nutritionTable">
                            <?php
                                $connnnn = mysqli_connect("localhost", "root", "", "db_healthcare");
                                if ($connnnn-> connect_error) {
                                    die ("Connection failed:" . $connnnn-> connect_error);
                                }
                                    
                                    $sql3 = "SELECT Nutrition, Link from nutrition";
                                    $result3 = $connnnn-> query($sql3);

                                    if ($result3-> num_rows > 0) {
                                        while ( $row3 = $result3-> fetch_assoc()) {
                                            echo "<tr><td style=" . "display:none;" . ">". $row3["Nutrition"] . "</td><td>" . "<button type=" . "button" . " class=" . "btnSelect3" .  " onclick=" . "window.location.href='" . $row3["Link"] . "';" . " id=" . "accordion-button-3" . ">" . "<center>" . $row3["Nutrition"] . "<center>" . "</button>" ."</td></tr>";
                                            }
                                        echo "</table>";
                                        }
                                        else{
                                    echo "No result.";
                                    }
                                    $connnnn-> close();
                            ?></a>
                    </div>
                <?php endif; ?>
                    </tr>
                </table>
            </div>

            <div class="accordion-item">
                <tr>
                <th><button id="accordion-button-4" aria-expanded="false"><span class="accordion-title">Care</span><span class="icon" aria-hidden="true"></span></button></th>
                <?php if(isset($_SESSION['loggedin'])): ?>
                <div class="accordion-content">
                    <table id="careTable">
                        <?php
                            $connnnnn = mysqli_connect("localhost", "root", "", "db_healthcare");
                            if ($connnnnn-> connect_error) {
                                die ("Connection failed:" . $connnnnn-> connect_error);
                            }
                                
                                $sql4 = "SELECT Care, Link from care";
                                $result4 = $connnnnn-> query($sql4);

                                if ($result4-> num_rows > 0) {
                                    while ($row4 = $result4-> fetch_assoc()) {
                                        echo "<tr><td style=" . "display:none;" . ">". $row4["Care"] . "</td><td>" . "<button type=" . "button" . " class=" . "btnSelect4" .  " onclick=" . "window.location.href='" . $row4["Link"] . "';" . " id=" . "accordion-button-4" . ">" . "<center>" . $row4["Care"] . "<center>" . "</button>" ."</td></tr>";
                                        }
                                    echo "</table>";
                                    }
                                    else{
                                echo "No result.";
                                }
                                $connnnnn-> close();
                        ?>
                        </div>
                <?php else: ?>
                    <div class="accordion-content"><a href="javascript:window.location.href=myFunction();">
                    <table id="careTable">
                        <?php
                            $connnnnn = mysqli_connect("localhost", "root", "", "db_healthcare");
                            if ($connnnnn-> connect_error) {
                                die ("Connection failed:" . $connnnnn-> connect_error);
                            }
                                
                                $sql4 = "SELECT Care, Link from care";
                                $result4 = $connnnnn-> query($sql4);

                                if ($result4-> num_rows > 0) {
                                    while ($row4 = $result4-> fetch_assoc()) {
                                        echo "<tr><td style=" . "display:none;" . ">". $row4["Care"] . "</td><td>" . "<button type=" . "button" . " class=" . "btnSelect4" .  " onclick=" . "window.location.href='" . $row4["Link"] . "';" . " id=" . "accordion-button-4" . ">" . "<center>" . $row4["Care"] . "<center>" . "</button>" ."</td></tr>";
                                        }
                                    echo "</table>";
                                    }
                                    else{
                                echo "No result.";
                                }
                                $connnnnn-> close();
                        ?></a>
                        </div>
                        <?php endif; ?>
                    </tr>
                </table>
            </div>

            <div class="accordion-item">
                <tr>
                <th><button id="accordion-button-5" aria-expanded="false"><span class="accordion-title">Breeds</span><span class="icon" aria-hidden="true"></span></button></th>
                <?php if(isset($_SESSION['loggedin'])): ?>
                <div class="accordion-content">
                    <table id="breedsTable">
                        <?php
                            $connnnnnn = mysqli_connect("localhost", "root", "", "db_healthcare");
                            if ($connnnnnn-> connect_error) {
                                die ("Connection failed:" . $connnnnnn-> connect_error);
                            }
                                
                                $sql5 = "SELECT Breeds, Link from breeds";
                                $result5 = $connnnnnn-> query($sql5);

                                if ($result5-> num_rows > 0) {
                                    while ( $row5 = $result5-> fetch_assoc()) {
                                        echo "<tr><td style=" . "display:none;" . ">". $row5["Breeds"] . "</td><td>" . "<button type=" . "button" . " class=" . "btnSelect5" .  " onclick=" . "window.location.href='" . $row5["Link"] . "';" . " id=" . "accordion-button-5" . ">" . "<center>" . $row5["Breeds"] . "<center>" . "</button>" ."</td></tr>";
                                        }
                                    echo "</table>";
                                    }
                                    else{
                                echo "No result.";
                                }
                                $connnnnnn-> close();
                        ?>
                        </div>
                <?php else: ?>
                    <div class="accordion-content"><a href="javascript:window.location.href=myFunction();">
                    <table id="breedsTable">
                        <?php
                            $connnnnnn = mysqli_connect("localhost", "root", "", "db_healthcare");
                            if ($connnnnnn-> connect_error) {
                                die ("Connection failed:" . $connnnnnn-> connect_error);
                            }
                                
                                $sql5 = "SELECT Breeds, Link from breeds";
                                $result5 = $connnnnnn-> query($sql5);

                                if ($result5-> num_rows > 0) {
                                    while ( $row5 = $result5-> fetch_assoc()) {
                                        echo "<tr><td style=" . "display:none;" . ">". $row5["Breeds"] . "</td><td>" . "<button type=" . "button" . " class=" . "btnSelect5" .  " onclick=" . "window.location.href='" . $row5["Link"] . "';" . " id=" . "accordion-button-5" . ">" . "<center>" . $row5["Breeds"] . "<center>" . "</button>" ."</td></tr>";
                                        }
                                    echo "</table>";
                                    }
                                    else{
                                echo "No result.";
                                }
                                $connnnnnn-> close();
                        ?></a>
                        </div>
                        <?php endif; ?>
                    </tr>
                </table>
            </div>


        </div>
                                
    </div>



        <!-- Our Services End -->
        <!--? About Area Start-->
        <div class="about-area fix">
            
<div class="center">    
    <div class="para" >
        <h1 style="color: #f8941c; font-weight: bold; font-size: 50px;">Welcome To CaringPaws</h1>
        <br>
        <p class="pa" style="font-size: 20px; font-weight: bold;">Your pet's health and well-being is our top priority.</p>
        <p class="pa" style="font-size: 20px; font-weight: bold;">Online consultation is best for :</p>
    </div>
    <table class="mesa">
     
        <div class="wrapper"><tr>
            <td class="firstaid">
                <div class="taas">

                        <h2 class="h2o" style='display:inline;'><li ><i class="fas fa-heart fa-xs" aria-hidden="true" style="
    width: 80px;
    height: 80px;
    padding-top: 20px;
    text-align: center;
    background: #f8941c;
    border-radius: 50%;
    font-size: 40px;
    color: #262626;

"></i> First Aid</li></h2>
                </div>  
                <br>
                    <div class="paa">
                        <p class="pa">
                        Can't go to the nearest vet clinic yet?<br>
                        Our vets can advise what to do and what not to do.
                        </p>
                    </div>
            </td>
          
            <td class="petadvice"> 
                <div class="taas">
                    <h2 class="h2o" style='display:inline;'><li ><i class="fas fa-paw fa-xs" aria-hidden="true" style="
    width: 80px;
    height: 80px;
    padding-top: 20px;
    text-align: center;
    background: #f8941c;
    border-radius: 50%;
    font-size: 40px;
    color: #262626;

"></i> Pet Advice</li></h2>
                    </div>
                <br>
                <div class="paa"> 
                    <p class="pa">
                        Find out if it's okay to spay, what breed to buy,<br>
                        how to have healthy pregnancy, anything!    
                    </p class="pa">
                </div>   
            </td>
        </tr>
        <tr>
            <td class="getideas">
                <div class="taas">
                <h2 class="h2o" style='display:inline;'><li ><i class="fas fa-lightbulb fa-xs" aria-hidden="true" style="
    width: 80px;
    height: 80px;
    padding-top: 20px;
    text-align: center;
    background: #f8941c;
    border-radius: 50%;
    font-size: 40px;
    color: #262626;

"></i> Getting Ideas</li></h2> 
                </div>  
                <br>
                    <div class="paa">
                            <p class="pa"> Not sure why your pet is acting strange?<br> 
                                Vets can tell you possible scenarios. </p>
                    </div>
            </td>

            <td class="secondop"> 
                <div class="taas">
                <h2 class="h2o" style='display:inline;'><li ><i class="fas fa-lightbulb fa-xs" aria-hidden="true" style="
    width: 80px;
    height: 80px;
    padding-top: 20px;
    text-align: center;
    background: #f8941c;
    border-radius: 50%;
    font-size: 40px;
    color: #262626;

"></i> Second Opinion</li></h2> 
                </div>
                <br>
                    <div class="paa">
                        <p class="pa"> Want to confirm opinons about<br>
                            your pet's condition? Vets can confirm the condition.</p>
                    </div>
            </td>  
        </tr></div>
    </table>
</div>
                            </div>
        <!-- About Area End-->
        <!--? Gallery Area Start -->
        <div class="gallery-area section-padding30">
            <div class="container fix">
                <div class="row justify-content-sm-center">
                    <div class="cl-xl-7 col-lg-8 col-md-10">
                        <!-- Section Tittle -->
                        <div class="section-tittle text-center mb-70">
                            <span>Patient's Recent Photos</span>
                            <h2>Healthy Pets</h2>
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-gallery mb-30">
                            <!-- <a href="assets/img/gallery/gallery1.png" class="img-pop-up">View Project</a> -->
                            <div class="gallery-img size-img" style="background-image: url(assets/img/gallery/gallery1.png);"></div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-6 col-sm-6">
                        <div class="single-gallery mb-30">
                            <div class="gallery-img size-img" style="background-image: url(assets/img/gallery/gallery2.png);"></div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-6 col-sm-6">
                        <div class="single-gallery mb-30">
                            <div class="gallery-img size-img" style="background-image: url(assets/img/gallery/gallery3.png);"></div>
                        </div>
                    </div>
                    <div class="col-lg-4  col-md-6 col-sm-6">
                        <div class="single-gallery mb-30">
                            <div class="gallery-img size-img" style="background-image: url(assets/img/gallery/gallery4.png);"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gallery Area End -->
        <!--? Contact form Start -->
        <div id="contact-form-top" class="contact-form-main pb-top">
            <div class="container">
                <div class="row justify-content-md-end">
                    <div class="col-xl-7 col-lg-7">
                        <div class="form-wrapper">
                            <!--Section Tittle  -->
                            <div class="form-tittle">
                                <div class="row ">
                                    <div class="col-xl-12">
                                        <div class="section-tittle section-tittle2 mb-70">
                                            <h3 style="font-weight: bold; color: white;">Ask a Vet Questions Online Now <hr> </h3>
                                            <p style="color: white;">Ascertained Pet Professionals supporting from 8 AM to 10 PM!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Section Tittle  -->
                            <form role="form" id="contact-form" action="mail.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-box user-icon mb-30">
                                            <input text-transform="none" type="text" name="fullname" id="fullname" value="<?php 
                                            
                                            if (isset($row['fname']) && isset($row['lname']))    
                                            {   
                                                $fullname = $row['fname'] . ' ' .$row['lname']; echo $fullname; 
                                            } else{
                                                
                                            }
                                            
                                            ?>" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-box email-icon mb-30">
                                            <input text-transform="none" class="emailword" type="email" name="email" id="email" value="<?php 
                                            if (isset($row6['username']))    
                                            {  
                                                $email = $row6['username']; 
                                                echo $email; 
                                            } else{
                                                
                                            }
                                            ?>" placeholder="Email"   > 
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 mb-30">
                                        <div class="select-itms">
                                            <select name="subject" id="subject">
                                                <option >Health</option>
                                                <option >Behavior & Training</option>
                                                <option >Nutrition</option>
                                                <option >Care</option>
                                                <option >Breeds</option>
                                                <option >Holistic Health Care</option>
                                                <option >Natural Pet Products</option>
                                                <option >Products Recommendations</option>
                                                <option >Other</option>
                                                <option >Not Sure</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <center><div class="form-box subject-icon mb-30">
                                           
                                                <label class="btn submit-btn2">Attach Photo
                                                    <input class="form-control" id="inputdefault" type="file" name="my_files[]" accept="image/*" size="12" style="display: none;">
                                                </label>
                                          
                                        </div><center>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-box message-icon mb-65">
                                            <textarea name="message" id="message" placeholder="Message"></textarea>
                                        </div>
                                        <div class="submit-info">
                                            <button class="btn submit-btn2" name="send_message" type="submit" id="submit">Submit Question</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- shape-dog -->
                                <div class="shape-dog">
                                    <img src="assets/img/gallery/shape1.png" alt="">
                                </div>
                                <br>
                                <?php 
                                if (isset($_SESSION['success']))    
                                {    
                                    echo $_SESSION['success'] ;
                                    unset($_SESSION['success']);
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- contact left Img-->
            <div class="from-left d-none d-lg-block">
                <img src="assets/img/gallery/contact_form.png" alt="">
            </div>
        </div>
        <!-- Contact form End -->
        <!--? Team Start -->
        <div class="team-area section-padding30">
            <div class="container">
                <div class="row justify-content-sm-center">
                    <div class="cl-xl-7 col-lg-8 col-md-10">
                        <!-- Section Tittle -->
                        <div class="section-tittle text-center mb-70">
                            <span>Our Professional Veterinarians from</span>
                            <h2>Caring Paws</h2>
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <!-- single Tem -->
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-">
                        <div class="single-team mb-30">
                            <div class="team-img">
                                <img src="team1.png" alt="">
                            </div>
                            <div class="team-caption">
                                <span>Jonathan Ugates</span>
                                <h3><a href="">Veterinarian (Laboratory animal medicine)</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-">
                        <div class="single-team mb-30">
                            <div class="team-img">
                                <img src="team2.png" alt="">
                            </div>
                            <div class="team-caption">
                                <span>Pancho Santelices</span>
                                <h3><a href="#">Veterinarian (Internal medicine)</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-">
                        <div class="single-team mb-30">
                            <div class="team-img">
                                <img src="team3.png" alt="">
                            </div>
                            <div class="team-caption">
                                <span>Lawrence Ruedas</span>
                                <h3><a href="#">Veterinarian (Emergency and critical care)</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team End -->
        <!--? Testimonial Start -->
        <div class="testimonial-area testimonial-padding section-bg" data-background="assets/img/gallery/section_bg03.png">
            <div class="container">
                <!-- Testimonial contents -->
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-8 col-lg-8 col-md-10">
                        <div class="h1-testimonial-active dot-style">
                            <!-- Single Testimonial -->
                            <div class="single-testimonial text-center">
                                <div class="testimonial-caption ">
                                    <!-- founder -->
                                    <div class="testimonial-founder">
                                        <div class="founder-img mb-40">
                                            <img src="jonathan.png" alt="">
                                            <span>Jonathan Ugates</span>
                                            <p>Veterinarian (Laboratory animal medicine)</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-top-cap">
                                        <p>“Until one has loved an animal, a part of one’s soul remains unawakened.”</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Testimonial -->
                            <div class="single-testimonial text-center">
                                <div class="testimonial-caption ">
                                    <!-- founder -->
                                    <div class="testimonial-founder">
                                        <div class="founder-img mb-40">
                                            <img src="pancho.png" alt="">
                                            <span>Pancho Santelices</span>
                                            <p>Veterinarian (Internal medicine)</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-top-cap">
                                        <p>“Animals are such agreeable friends—they ask no questions; they pass no criticisms.”</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Testimonial -->
                            <div class="single-testimonial text-center">
                                <div class="testimonial-caption ">
                                    <!-- founder -->
                                    <div class="testimonial-founder">
                                        <div class="founder-img mb-40">
                                            <img src="lawrence.png" alt="">
                                            <span>Lawrence Ruedas</span>
                                            <p>Veterinarian (Emergency and critical care)</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-top-cap">
                                        <p>“An animal’s eyes have the power to speak a great language.”</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->
        <!--? Blog start -->
        <!--<div class="home_blog-area section-padding30">
            <div class="container">
                <div class="row justify-content-sm-center">
                    <div class="cl-xl-7 col-lg-8 col-md-10">
                        Section Tittle 
                        <div class="section-tittle text-center mb-70">
                            <span>Educational Center</span>
                            <h2>Our Recent Blogs</h2>
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-blogs mb-30">
                            <div class="blog-img">
                                <img src="assets/img/gallery/blog1.png" alt="">
                            </div>
                            <div class="blogs-cap">
                                <div class="date-info">
                                    <span>Pet food</span>
                                    <p>Nov 30, 2020</p>
                                </div>
                                <h4>Dog Allergic Reactions</h4>
                                <a href="blog_details.html" class="read-more1">Read more</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-blogs mb-30">
                            <div class="blog-img">
                                <img src="assets/img/gallery/blog2.png" alt="">
                            </div>
                            <div class="blogs-cap">
                                <div class="date-info">
                                    <span>Pet food</span>
                                    <p>Nov 30, 2020</p>
                                </div>
                                <h4>How To Prevent Heat Stroke</h4>
                                <a href="blog_details.html" class="read-more1">Read more</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-blogs mb-30">
                            <div class="blog-img">
                                <img src="assets/img/gallery/blog3.png" alt="">
                            </div>
                            <div class="blogs-cap">
                                <div class="date-info">
                                    <span>Pet food</span>
                                    <p>Nov 30, 2020</p>
                                </div>
                                <h4>Cat Habbits: Explained</h4>
                                <a href="blog_details.html" class="read-more1">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
        <!-- Blog End -->
        <!--? contact-animal-owner Start -->
        <div class="contact-animal-owner section-bg" data-background="assets/img/gallery/section_bg04.png">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="contact_text text-center">
                            <div class="section_title text-center">
                                <h3>Reach us here!</h3>
                                <p>Because we know that even the best technology is only as good as the people behind it.<br>We respond to Messages and Calls from 8 AM to 10 PM. </p>
                            </div>
                            <div class="contact_btn d-flex align-items-center justify-content-center">
                                <a href="https://m.me/CaringPawsPH" class="btn white-btn">Messenger</a>
                                <p>Or<a href="#">+9954492591</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- contact-animal-owner End -->
    </main>
    <footer>
        <!-- Footer Start-->
        <div class="footer-area footer-padding">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                       <div class="single-footer-caption mb-50">
                         <div class="single-footer-caption mb-30">
                              <!-- logo -->
                             <div class="footer-logo mb-25">
                                 <a href="index.php"><img src="logo/logo2_footer.png" alt=""></a>
                             </div>
                             <div class="footer-tittle">
                                 <div class="footer-pera">
                                     <p>CaringPaws is your trusted source of pet care information. Talk to a vet today! Contact us now and make an appointment today.</p>
                                </div>
                             </div>
                             <!-- social -->
                             <div class="footer-social">
                                 <a href="https://m.me/CaringPawsPH"><i class="fab fa-facebook-square"></i></a>
                                 <a href="#"><i class="fab fa-twitter-square"></i></a>
                                 <a href="#"><i class="fab fa-linkedin"></i></a>
                                 <a href="#"><i class="fab fa-pinterest-square"></i></a>
                             </div>
                         </div>
                       </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-5">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Caring Paws</h4>
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="about.php">About Us</a></li>
                                    <li><a href="services.php">Services</a></li>
                                    <li><a href="contact.php">  Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-7">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Services</h4>
                                <ul>
                                    <li><a href="">Health Care</a></li>
                                    <li><a href="">Health Treatment</a></li>
                                    <li><a href="">Pet Care Services</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Get in Touch</h4>
                                <ul>
                                 <li><a href="#">+9954492591</a></li>
                                 <li><a href="caringpawsph@gmail.com">caringpawsph@gmail.com</a></li>
                                 <li><a href="#">Bacoor City, Cavite PH</a></li>
                             </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer-bottom area -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="footer-border">
                     <div class="row d-flex align-items-center">
                         <div class="col-xl-12 ">
                             <div class="footer-copy-right text-center">
                                 <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Caring Paws <i class="fa fa-heart" aria-hidden="true"></i><a href="#" target="_blank"></a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                             </div>
                         </div>
                     </div>
                </div>
            </div>
        </div>
        <!-- Footer End-->
    </footer>
    <!-- Scroll Up -->
    <div id="back-top" >
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>
    
    <!-- JS here -->
    
    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- Nice-select, sticky -->
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>
    
    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
    
    <!-- Jquery Plugins, main Jquery -->	
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>
<script>
        var form = document.getElementById("submit");
        document.getElementById("submit").addEventListener("click", function () {
        form.submit();});
</script>
<script>
    const items = document.querySelectorAll(".accordion button");

function toggleAccordion() {
  const itemToggle = this.getAttribute('aria-expanded');
  
  for (i = 0; i < items.length; i++) {
    items[i].setAttribute('aria-expanded', 'false');
  }
  
  if (itemToggle == 'false') {
    this.setAttribute('aria-expanded', 'true');
  }
}

items.forEach(item => item.addEventListener('click', toggleAccordion));
</script>
<!-- Messenger Chat Plugin Code -->
<div id="fb-root"></div>

<!-- Your Chat Plugin code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function(){var delay = 5000;
    // code to read selected table row cell data (values).
    $("#healthTable").on('click','.btnSelect',function(){
        // get the current row
        var currentRow1=$(this).closest("tr"); 
        var dataTitle1 = currentRow1.find("td:eq(0)").text(); // get current row title
        
        //alert(dataTitle);

        $.ajax({
            type: "POST",
            url: "http://localhost/caringpaws/healthblog.php",
            data: {dataTitle1 : dataTitle1 },
            cache: true,
            success: function(response) {
                setTimeout(continueExecution, 10000);
            }
        });
    });
});
</script>

<script>
$(document).ready(function(){
    // code to read selected table row cell data (values).
    $("#behaviorTable").on('click','.btnSelect2',function(){
        // get the current row
        var currentRow2=$(this).closest("tr"); 
        var dataTitle2 = currentRow2.find("td:eq(0)").text(); // get current row title
        
        //alert(dataTitle);
        $.ajax({
            type: "POST",
            url: "http://localhost/caringpaws/behaviorblog.php",
            data: { dataTitle2 : dataTitle2 },
            cache: true,
            success: function(data) {
            }
        });
    });
});
</script>

<script>
$(document).ready(function(){
    // code to read selected table row cell data (values).
    $("#nutritionTable").on('click','.btnSelect3',function(){
        // get the current row
        var currentRow3=$(this).closest("tr"); 
        var dataTitle3 = currentRow3.find("td:eq(0)").text(); // get current row title
        
        //alert(dataTitle);
        $.ajax({
            type: "POST",
            url: "http://localhost/caringpaws/nutritionblog.php",
            data: { dataTitle3 : dataTitle3 },
            cache: true,
            success: function(data) {
            }
        });
    });
});
</script>

<script>
$(document).ready(function(){
    // code to read selected table row cell data (values).
    $("#careTable").on('click','.btnSelect4',function(){
        // get the current row
        var currentRow4=$(this).closest("tr"); 
        var dataTitle4 = currentRow4.find("td:eq(0)").text(); // get current row title
        
        //alert(dataTitle);
        $.ajax({
            type: "POST",
            url: "http://localhost/caringpaws/careblog.php",
            data: { dataTitle4 : dataTitle4 },
            cache: true,
            success: function(data) {
            }
        });
    });
});
</script>

<script>
$(document).ready(function(){
    // code to read selected table row cell data (values).
    $("#breedsTable").on('click','.btnSelect5',function(){
        // get the current row
        var currentRow5=$(this).closest("tr"); 
        var dataTitle5 = currentRow5.find("td:eq(0)").text(); // get current row title
        
        //alert(dataTitle);
        $.ajax({
            type: "POST",
            url: "http://localhost/caringpaws/breedsblog.php",
            data: { dataTitle5 : dataTitle5 },
            cache: true,
            success: function(data) {
            }
        });
    });
});
</script>


    </body>
</html>