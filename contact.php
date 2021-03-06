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

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['postdata'] = $_POST;
        unset($_POST);
        header("Location: ".$_SERVER['REQUEST_URI']);
        exit;
        }
        
    if (@$_SESSION['postdata']){
        $_POST=$_SESSION['postdata'];
        unset($_SESSION['postdata']);
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
    <title>Caring Paws | Contact </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <l<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

   <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">

<script>
    function myFunction() {

        var x;
        var r = confirm("Login first!");

        if (r == true) {
            x = "You pressed OK!";
        }
        else {
            x = "You pressed Cancel!";
        }
        document.getElementById("demo").innerHTML = x;
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
                                <a href="index.php"><img src="logo/logo.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10 col-md-10">
                            <div class="menu-main d-flex align-items-center justify-content-end">
                                <!-- Main-menu -->
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav> 
                                        <ul id="navigation">
                                            <!--<li><a href="index.php">Home</a></li>-->
                                            <li><a href="index.php" style="font-weight: bold;">Home</a></li>
                                            <li><a href="about.php" style="font-weight: bold;">About</a></li>
                                            <!--<li><a href="blog1.php">Educational Center</a>-->
                                                <!--<ul class="submenu">-->
                                                    <!--<li><a href="blog1.php">Blog</a></li>-->
                                                    <!--blog_details.html-->
                                                    <!--<li><a href="blog1.php">Blog Details</a></li>-->
                                                    <!--<li><a href="elements.html">Element</a></li>-->
                                                <!--</ul>-->
                                            <!--</li>-->
                                            <li><a href="services.php" style="font-weight: bold;">Services</a></li>

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
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
    <main>
         <!-- Hero Area Start -->
         <div class="slider-area2 slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center pt-50">
                            <h2>Contact Us</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Hero Area End -->
        <!-- ================ contact section start ================= -->
        <section class="contact-section">
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
                <div class="container">

                    <div class="d-none d-sm-block mb-5 pb-4">
                 
                    <div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=1200&amp;height=400&amp;hl=en&amp;q=Queen's row central&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://www.fnfgo.com/">FNF Online</a></div><style>.mapouter{position:relative;text-align:right;width:1200px;height:400px;}.gmap_canvas {overflow:hidden;background:none!important;width:1200px;height:400px;}.gmap_iframe {width:1200px!important;height:400px!important;}</style></div>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h2 class="contact-title">Get in Touch</h2>
                        </div>
                        <div class="col-lg-8">
                            <form class="form-contact comment_form" action="contactmail.php" method="post" id="commentForm">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <textarea class="form-control w-100" name="message3" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" placeholder=" Enter Message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input class="form-control valid" name="name3"  type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" placeholder="Enter your name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input class="form-control valid" name="email3"  type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input class="form-control" name="subject3"  type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'" placeholder="Enter Subject">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" name="submit" class="button button-contactForm btn_1 boxed-btn">Send Message</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-3 offset-lg-1">
                            <div class="media contact-info">
                                <span class="contact-info__icon"><i class="ti-home"></i></span>
                                <div class="media-body">
                                    <h3>Bacoor City, Cavite.</h3>
                                    <p>Molino, PH 4102</p>
                                </div>
                            </div>
                            <div class="media contact-info">
                                <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                                <div class="media-body">
                                    <h3>(+63)9954492591</h3>
                                    <p>Mon to Fri 8 AM to 5 PM</p>
                                </div>
                            </div>
                            <div class="media contact-info">
                                <span class="contact-info__icon"><i class="ti-email"></i></span>
                                <div class="media-body">
                                    <h3>caringpawsph@gmail.com</h3>
                                    <p>Send us your query anytime!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <!-- ================ contact section end ================= -->
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
                                 <a href="https://www.facebook.com/CaringPaws15"><i class="fab fa-facebook-square"></i></a>
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
    
    <!-- Nice-select, sticky -->
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

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

    </body>
</html>