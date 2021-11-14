<?php
session_start();
include_once '../assets2/conn/dbconnect2.php';
// include_once 'connection/server.php';
if(!isset($_SESSION['bloggerSession']))
{
header("Location: ./bloggerdashboard.php");
}

$usersession = $_SESSION['bloggerSession'];
$res=mysqli_query($conn,"SELECT * FROM blogger WHERE bloggerId=".$usersession);
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);

// INSERT TITLE AND LINK

if (isset($_POST['submit'])) {
    $blogTitle = mysqli_real_escape_string($conn,$_POST['blogTitle']);
    $blogLink = mysqli_real_escape_string($conn,$_POST['bloglink']);
    $message = mysqli_real_escape_string($conn,$_POST['message']);
    //INSERT
    switch($_POST['blogCategory']){
        case 'Health' :
            
            $query = " INSERT INTO health (idBlogger, Health, Link, Message) VALUES ('$usersession', '$blogTitle', '$blogLink', '$message')";
            $result = mysqli_query($conn, $query);

                    //ECHO RESULT
                    if( $result )
                    {
                        ?>
                            <script type="text/javascript">
                                alert('Your blog is ready to go!');  
                            </script>
                        <?php
                    }
                    else
                    {
                        ?>
                            <script type="text/javascript">
                                alert('Tite. Please try again.');
                            </script>
                        <?php
                    }
        
        break;
        case 'Behavior' :
    
            $query = " INSERT INTO behavior (idBlogger, Behavior, Link, Message) VALUES ('$usersession', '$blogTitle', '$blogLink', '$message')";
            $result = mysqli_query($conn, $query);

                    //ECHO RESULT
                    if( $result )
                    {
                        ?>
                            <script type="text/javascript">
                                alert('Your blog is ready to go!');
                            </script>
                        <?php
                    }
                    else
                    {
                        ?>
                            <script type="text/javascript">
                                alert('Tite. Please try again.');
                            </script>
                        <?php
                    }
    
        break;
        case 'Nutrition' :
    
            $query = " INSERT INTO nutrition (idBlogger, Nutrition, Link, Message) VALUES ('$usersession', '$blogTitle', '$blogLink', '$message')";
            $result = mysqli_query($conn, $query);

                    //ECHO RESULT
                    if( $result )
                    {
                        ?>
                            <script type="text/javascript">
                                alert('Your blog is ready to go!');
                            </script>
                        <?php
                    }
                    else
                    {
                        ?>
                            <script type="text/javascript">
                                alert('Tite. Please try again.');
                            </script>
                        <?php
                    }
    
        break;
        case 'Care' :
    
            $query = " INSERT INTO care (idBlogger, Care, Link, Message) VALUES ('$usersession', '$blogTitle', '$blogLink', '$message')";
            $result = mysqli_query($conn, $query);

                    //ECHO RESULT
                    if( $result )
                    {
                        ?>
                            <script type="text/javascript">
                                alert('Your blog is ready to go!');
                            </script>
                        <?php
                    }
                    else
                    {
                        ?>
                            <script type="text/javascript">
                                alert('Tite. Please try again.');
                            </script>
                        <?php
                    }
    
        break;
        case 'Breeds' :

            $query = " INSERT INTO breeds (idBlogger, Breeds, Link, Message) VALUES ('$usersession', '$blogTitle', '$blogLink', '$message')";
            $result = mysqli_query($conn, $query);

                    //ECHO RESULT
                    if( $result )
                    {
                        ?>
                            <script type="text/javascript">
                                alert('Your blog is ready to go!');
                            </script>
                        <?php
                    }
                    else
                    {
                        ?>
                            <script type="text/javascript">
                                alert('Tite. Please try again.');
                            </script>
                        <?php
                    }
    
        break;
        default:
            alert('Query Unsuccessful. Try again.');
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogger Dashboard</title>
        <link href="../assets2/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/dashboard.css" rel="stylesheet">
    <style>
        /* The container must be positioned relative: */
.custom-select {
  position: relative;

}

.custom-select select {
  display: none; /*hide original SELECT element: */
}

.select-selected {
  background-color: #F4B937;
}

/* Style the arrow inside the select element: */
.select-selected:after {
  position: absolute;
  content: "";
  top: 14px;
  right: 10px;
  width: 0;
  height: 0;
  border: 6px solid transparent;
  border-color: #fff transparent transparent transparent;
}

/* Point the arrow upwards when the select box is open (active): */
.select-selected.select-arrow-active:after {
  border-color: transparent transparent #fff transparent;
  top: 7px;
}

/* style the items (options), including the selected item: */
.select-items div,.select-selected {
  color: #ffffff;
  padding: 8px 16px;
  border: 1px solid transparent;
  border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
  cursor: pointer;
}

/* Style items (options): */
.select-items {
  position: absolute;
  background-color: #F4B937;
  top: 100%;
  left: 0;
  right: 0;
  z-index: 99;
}

/* Hide the items when the select box is closed: */
.select-hide {
  display: none;
}

.select-items div:hover, .same-as-selected {
  background-color: rgba(0, 0, 0, 0.5);
}
</style>
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
   
<header>
		<div class="logo">Xero<span>Source</span></div>
	</header>
	<div class="nav-btn">Menu</div>
	<div class="container">
		
		<div class="sidebar">
			<nav>
				<a href="#"><img  src="assets/logo.png" height="50px"></a>
				<ul>
					<li class="active"><a href="#">Dashboard</a></li>
                    <li><a href="uploadbloggerpicture.php">Upload Picture</a></li>
					<li><a href="logout.php?logout">Logout</a></li>
				</ul>
			</nav>
		</div>

		<div class="main-content">
			<h1 style="font-weight:bold;"> Share your Insight!</h1>
			<p style="font-weight:bold;">Fill in the necessary details</p>
            <form method="post">
                <div class="panel-wrapper">
                    <div class="panel-head" style="font-weight:bold;">
                        Blog Category
                    </div>
                    <div class="panel-body">
                        
                        <label for="blogcategory">Choose a category</label>
                            
                            <div class="custom-select" style="width:30%;">
                                <select name="blogCategory" id="blogcategory">
                                    <option value="Health">Health</option>
                                    <option value="Behavior">Behavior</option>
                                    <option value="Nutrition">Nutrition</option>
                                    <option value="Care">Care</option>
                                    <option value="Breeds">Breeds</option>
                                </select>
                            </div>
                    </div>
                </div>

                <div class="panel-wrapper">
                    <div class="panel-head" style="font-weight:bold;">
                        Blog Title
                    </div>
                    <div class="panel-body">
                        <input type="text" name="blogTitle" style="width:100%;" placeholder=" Why Do Birds Suddenly Appear? ">
                    </div>
                </div>

                <div class="panel-wrapper">
                    <div class="panel-head" style="font-weight:bold;">
                        Category Link
                    </div>
                    <div class="panel-body">
                        
                        <label for="blogcategory">Choose your Category Link</label>
                            
                            <div class="custom-select" style="width:30%;">
                                <select name="bloglink" id="bloglink">
                                    <option value="./healthblog.php">Health</option>
                                    <option value="./behaviorblog.php">Behavior</option>
                                    <option value="./nutritionblog.php">Nutrition</option>
                                    <option value="./careblog.php">Care</option>
                                    <option value="./breedsblog.php">Breeds</option>
                                </select>
                            </div>
                    </div>
                </div>

                <div class="panel-wrapper">
                    <div class="panel-head" style="font-weight:bold;">
                        Message Body                      
                    </div>
                    <div class="panel-body">
                        <textarea id="comment" maxlength="3500" onkeyup="countTextAreaChar(this, 3500)" class="form-control w-100" name="message" cols="30" rows="9" placeholder="Type your idea here...(maximum characters 3500)"></textarea>
                    <p id="charNum" style="padding-left:5px; padding-top: 10px;"></p></div>
                </div>
                <button type="submit" style="
                        background-color: #4CAF50; /* Green */
                        border: none;
                        color: white;
                        padding: 15px 32px;
                        text-align: center;
                        text-decoration: none;
                        display: inline-block;
                        font-size: 16px;  
                        background-color: #008CBA; /* Blue */       
                        font-weight: bold;       
                " name="submit">Post</button>
            </form>
		</div>
	</div>
<script src="../patient/assets/js/bootstrap.min.js"></script>
<script src="js/dashboard.js"></script>
<script>
    var x, i, j, l, ll, selElmnt, a, b, c;
/* Look for any elements with the class "custom-select": */
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /* For each element, create a new DIV that will act as the selected item: */
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /* For each element, create a new DIV that will contain the option list: */
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /* For each option in the original select element,
    create a new DIV that will act as an option item: */
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /* When an item is clicked, update the original select box,
        and the selected item: */
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
    /* When the select box is clicked, close any other select boxes,
    and open/close the current select box: */
    e.stopPropagation();
    closeAllSelect(this);
    this.nextSibling.classList.toggle("select-hide");
    this.classList.toggle("select-arrow-active");
  });
}

function closeAllSelect(elmnt) {
  /* A function that will close all select boxes in the document,
  except the current select box: */
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}

/* If the user clicks anywhere outside the select box,
then close all select boxes: */
document.addEventListener("click", closeAllSelect);
</script>
</body>
</html>