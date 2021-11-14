<link rel="icon" href="pagelogo.png" sizes="16x16" type="image/png">
<?php
if (!isset($_SESSION)) {
  session_start();
   //$title = filter_input(INPUT_GET, 'data', FILTER_VALIDATE_INT);
   //echo $title;

  }
  // Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: index.php");
  exit;
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
  
  require_once "config.php";


  //GET THE TITLE BRO
  $_GET['p2'] = 100;
  $dataTitle4 = isset($_POST['dataTitle4']) ? $_POST['dataTitle4'] : header("Location: https://caringpaws-ph.herokuapp.com/index.php" . $_SERVER['REDIRECT_URI'] . '?' . http_build_query($_GET)); 
  $_SESSION['theTitle4'] = $dataTitle4; 
  
  $sql5 = "SELECT idBlogger, Care, Message FROM care WHERE Care='" . $_SESSION['theTitle4'] . "'";
  $results5 = mysqli_query($mysqli, $sql5);
  $ST = mysqli_fetch_assoc($results5);
  //echo $dataTitle;

  ///////////////////

  $sql = "SELECT * FROM patient WHERE icPatient='". $_SESSION['icPatient']."'"; //sql code 
  $results = mysqli_query($mysqli, $sql); //sends sql code

  //COMPARE CARE ID BLOGGER AND BLOGGER BLOGGERID
  $sql4 = "SELECT blogger.bloggerId, care.idBlogger FROM blogger, care WHERE blogger.bloggerId = care.idBlogger"; //sql code 
  $results4 = mysqli_query($mysqli, $sql4); //sends sql code
  
  //PRINT NAME ONLY WITH ASSIGNED ID MATCHING SELECTED TITLE
  if(mysqli_num_rows($results4) > 0){
      while($bloggerblogfile = mysqli_fetch_array($results4)){     
         $assignedno = $bloggerblogfile["idBlogger"];
         if($assignedno = $ST["idBlogger"]);
            $specificno = $ST["idBlogger"];
      }
  }

  $que=mysqli_query($mysqli,"SELECT * FROM blogger WHERE bloggerId=".$specificno);
  $bloggerRow=mysqli_fetch_array($que,MYSQLI_ASSOC);

  ///////////////////////////////////////
  if(mysqli_num_rows($results) > 0){
    $row = mysqli_fetch_assoc($results);
  }
  ///////////////////////////////////////

  $sql2 = "SELECT username FROM patient WHERE icPatient='". $_SESSION['icPatient']."'"; //sql code 
  $results2 = mysqli_query($mysqli, $sql2); //sends sql code

  if(mysqli_num_rows($results2) > 0){
    $row2 = mysqli_fetch_assoc($results2);
  }

?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>Caring Pawws | FAQs </title>
   <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

  <!-- CSS here -->
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
   <link rel="stylesheet" href="./assets/css/owl.carousel.min.css">
   <link rel="stylesheet" href="./assets/css/slicknav.css">
   <link rel="stylesheet" href="./assets/css/animate.min.css">
   <link rel="stylesheet" href="./assets/css/magnific-popup.css">
   <link rel="stylesheet" href="./assets/css/fontawesome-all.min.css">
   <link rel="stylesheet" href="./assets/css/themify-icons.css">
   <link rel="stylesheet" href="./assets/css/slick.css">
   <link rel="stylesheet" href="./assets/css/nice-select.css">
   <link rel="stylesheet" href="./assets/css/style.css">

   <script src="http://code.jquery.com/jquery-1.5.js"></script>
    <script>
    function countTextAreaChar(txtarea, l){
    var len = $(txtarea).val().length;
      if (len > l) $(txtarea).val($(txtarea).val().slice(0, l));
      else $('#charNum').text(l - len);
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
                              <a href="index.php"><img src="./logo/logo.png" alt=""></a>
                          </div>
                      </div>
                      <div class="col-xl-10 col-lg-10 col-md-10">
                          <div class="menu-main d-flex align-items-center justify-content-end">
                              <!-- Main-menu -->
                              <div class="main-menu f-right d-none d-lg-block">
                              <nav> 
                                        <ul id="navigation">
                                        <li><a href="about.php">About</a></li>
                                            <li><a href="services.php">Services</a></li>
                                            <!--<li><a href="blog1.php">Educational Center</a>
                                                <ul class="submenu">
                                                    <li><a href="blog1.php">Blog</a></li>
                                                    blog_details.html<li><a href="blog1.php">Blog Details</a></li>
                                                    <li><a href="elements.html">Element</a></li>
                                                </ul>
                                            </li>-->
                                            <li><a href="contact.php">Contact</a></li>
                                            <li>
                                            <?php if(isset($_SESSION['loggedin'])): ?>
                                                <!-- show HTML logout button -->
                                                <a href="./patient/patient.php" style="font-weight: bold;">Appointment</a>
                                            <?php else: ?>
                                                <!-- show HTML login button -->
                                                <a href="javascript:window.location.href=myFunction();" style="font-weight: bold;">Appointment</a>
                                            <?php endif; ?>
                                            </li>
                                            <li>
                                            
                                <?php if(isset($_SESSION['loggedin'])): ?>
                                            <!-- show HTML logout button -->
                                                <a href="logout.php" style="font-weight: bold; padding-right: 150px;">Sign Out</a>
                                                <ul class="submenu" style="width: 100%;">
            
        
            <center><span class="ml-auto" ><a href="resetpass.php" class="forgot-pass" value="" style="font-weight: bold;">Forgot Password</a></span><center>
            

</ul>
                                <?php else: ?>
                                            <!-- show HTML login button -->
                                                <a href="#" style="font-weight: bold; padding-right: 150px;">Sign in</a>
                                                    <ul class="submenu" style="padding-left: 20px; padding-right: 20px; width: 20pc; align-items: center;">


                                            <h3>Sign In to <strong>CaringPaws</strong></h3>
                                                <p class="mb-4">Welcome to CaringPaws. We take care of your love ones.</p>
                                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                                        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?> first">
                                                            <label for="username">Email</label>
                                                            <input name="icPatient" type="text" class="form-control" placeholder="ID Number" id="icPatient" value="<?php echo $username; ?>">
                                                            <span class="help-block"><?php echo $username_err; ?></span>
                                                        </div>
                                                        <div class="form-group form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?> last mb-3">
                                                            <label for="password">Password</label>
                                                            <input name="password" type="password" class="form-control" placeholder="Password" id="password" value="<?php echo $password; ?>">
                                                            <span class="help-block"><?php echo $password_err; ?></span>
                                                        </div>
                                    
                                                        <div class="d-flex mb-5 align-items-center">
                                                            <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                                                                <input type="checkbox" checked="checked"/>
                                                                    <div class="control__indicator"></div>
                                                            </label>

                                                        </div>

                                                        <input type="submit" value="Log In" class="btn btn-block btn-primary"/>
<br>
<br>
                                                        <span class="mb-4">No account? <a href="register.php">Sign up now</a>.</span>
                                                    </form>

                                                        </ul>

                                <?php endif; ?>
                                
                                            </li>
                                            
                                        </ul>

                                    </nav>
                              </div>
                              <!--<div class="header-right-btn f-right d-none d-lg-block ml-30">
                                  <a href="logout.php" class="header-btn">Sign Out</a>
                              </div>-->
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
      <!-- <div class="slider-area2 slider-height2 d-flex align-items-center">
         <div class="container">
            <div class="row">
               <div class="col-xl-12">
                     <div class="hero-cap text-center pt-50">
                        <h2>My pet has diarrhea. What are the possible causes & treatments?s</h2>
                     </div>
               </div>
            </div>
         </div>
      </div> -->
      <!-- Hero Area End -->
      <!--================Blog Area =================-->
      <section class="blog_area single-post-area section-padding">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 posts-list">
                  <div class="single-post">
                     <!--<div class="feature-img">
                        <img class="img-fluid" src="assets/img/blog/single_blog_1.png" alt="">
                     </div>-->
                     <div class="blog_details">
                     
                        <!-- TITLE OF BLOG -->
                              
                        <h1 style="font-weight: bold;">
                           <?php echo $ST['Care']; ?>  
                        </h1>

                           <!-- BLOG BODY CONTENT -->
                        <div class="quote-wrapper">
                           <div class="quotes">
                              <?php echo $ST['Message']; ?>  
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="navigation-top">
                     <div class="d-sm-flex justify-content-between text-center">
                        <!--<ul class="social-icons">
                           <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                           <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                           <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                           <li><a href="#"><i class="fab fa-behance"></i></a></li>
                        </ul>-->
                     </div>

                  </div>
                  <div class="blog-author">
                     <div class="media align-items-center">
                     <img src="<?php echo './blogger/images/' . $bloggerRow['profile_image'] ?>"  width="200" height="200" alt="">
                        <div class="media-body">
                        <p style="color:#f4e700;">Posted by</p>
                           <a>
                              <h4><?php echo $bloggerRow['bloggerFirstName'];?> <?php echo $bloggerRow['bloggerLastName'];?></h4>
                           </a>
                           <p>Veterinarian</p>
                           <hr>
                           <p>Courtesy: PetCoach.co</p>
                        </div>
                     </div>
                  </div>

                  <div class="comment-form">
                     <h4>Ask a Vet for Online now!</h4>
                     <p>Ascertained Pet Professionals supporting from 8 AM to 10 PM!<p id="charNum"></p></p>
                     <form action="blogmail.php"  class="form-contact comment_form" method="post" id="commentForm">
                        <div class="row">
                           <div class="col-12">
                              <div class="form-group">
                                 <textarea maxlength="500" onkeyup="countTextAreaChar(this, 500)" class="form-control w-100" name="message2" id="comment" cols="30" rows="9" placeholder="Type your question here...(maximum characters 500)"></textarea>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <input type="hidden" class="form-control" name="name2" id="name" type="text" placeholder="Name" value="<?php $fullname = $row['fname'] . ' ' .$row['lname']; echo $fullname; ?>">
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <input type="hidden" class="form-control" name="email2" id="email" type="email" placeholder="Email" value="<?php $email = $row2['username']; echo $email; ?>"">
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <button type="submit" name="submit" class="button button-contactForm btn_1 boxed-btn">Send Message</button>
                        </div>
                     </form>
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="blog_right_sidebar">
                     
                     <aside class="single_sidebar_widget newsletter_widget">
                        <h4 class="widget_title">Sign Up for Newsletter</h4>
                        <form action="newsletter.php" method="post">
                           <div class="form-group">
                              <input name="email3" type="email" class="form-control" onfocus="this.placeholder = ''"
                                 onblur="this.placeholder = 'Enter email'" placeholder='Enter email' required>
                           </div>
                           <button name="subscribe" class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" type="submit">Subscribe</button>
                        </form>
                        <br>
                     </aside>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!--================ Blog Area end =================-->
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
                               <a href="index.html"><img src="logo/logo2_footer.png" alt=""></a>
                           </div>
                           <div class="footer-tittle">
                               <div class="footer-pera">
                                   <p>CaringPaws is your trusted source of pet care information. Talk to a vet today! Contact us now and make an appointment today.</p>
                              </div>
                           </div>
                           <!-- social -->
                           <div class="footer-social">
                               <a href="https://www.facebook.com/sai4ull"><i class="fab fa-facebook-square"></i></a>
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
                              <h4>Company</h4>
                              <ul>
                                  <li><a href="index.html">Home</a></li>
                                  <li><a href="about.html">About Us</a></li>
                                  <li><a href="single-blog.html">Services</a></li>
                                  <li><a href="contact.html">  Contact Us</a></li>
                              </ul>
                          </div>
                      </div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-4 col-sm-7">
                      <div class="single-footer-caption mb-50">
                          <div class="footer-tittle">
                              <h4>Services</h4>
                              <ul>
                                  <li><a href="#">Styling Hair</a></li>
                                  <li><a href="#">Shaving</a></li>
                                  <li><a href="#">Trimming</a></li>
                                  <li><a href="#">Dental Care</a></li>
                                  <li><a href="#">Genital Care</a></li>
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
                               <li><a href="#">caringpawsph@gmail.com</a></li>
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
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Caring Paws <i class="fa fa-heart" aria-hidden="true"></i>  <a href="#" target="_blank"></a>
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
		<!-- All JS Custom Plugins Link Here here -->
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
</body>

</html>