<link rel="icon" href="pagelogo.png" sizes="16x16" type="image/png">
<?php
include_once 'assets2/conn/dbconnect.php';

session_start();
if (isset($_SESSION['doctorSession']) != "") {
header("Location: ./doctor/doctordashboard.php");
}
if (isset($_POST['login']))
{
$doctorId = mysqli_real_escape_string($con,$_POST['doctorId']);
$password  = mysqli_real_escape_string($con,$_POST['password']);

$res = mysqli_query($con,"SELECT * FROM doctor WHERE doctorId = '$doctorId'");

$row=mysqli_fetch_array($res,MYSQLI_ASSOC);

// echo $row['password'];

if (isset($row['password']) == $password){
  $_SESSION['doctorSession'] = $row['doctorId'];
?>
  <script type="text/javascript">
    alert('Login Success');
  </script>
<?php
  header("Location: ./doctor/doctordashboard.php");
} else { 
?>
  <script type="text/javascript">
    alert("Wrong Credentials");
  </script>
<?php
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CaringPaws Doctor Admin Login</title>
    <style>
        * {
  box-sizing: border-box;
}
body {
  margin: 0;
  font-family: sans-serif;
}
a {
  color: #666;
  font-size: 14px;
  display: block;
}
.login-title {
  text-align: center;
}
#login-page {
  display: flex;
}
.notice {
  font-size: 13px;
  text-align: center;
  color: #666;
}
.login {
  width: 50%;
  height: 100vh;
  background: #FFF;
  padding: 70px;
}
.login a {
  margin-top: 25px;
  text-align: center;
}
.form-login {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  align-content: center;
}
.form-login label {
  text-align: left;
  font-size: 13px;
  margin-top: 10px;
  margin-left: 20px;
  display: block;
  color: #666;
}
.input-text,
.input-password {
  width: 100%;
  background: #ededed;
  border-radius: 25px;
  margin: 4px 0 10px 0;
  padding: 10px;
  display: flex;
}
.icon {
  padding: 4px;
  color: #666;
  min-width: 30px;
  text-align: center;
}
input[type="text"],
input[type="password"] {
  width: 100%;
  border: 0;
  background: none;
  font-size: 16px;
  padding: 4px 0;
  outline: none;
}
button[type="submit"] {
  width: 100%;
  border: 0;
  border-radius: 25px;
  padding: 14px;
  background: #008552;
  color: #FFF;
  display: inline-block;
  cursor: pointer;
  font-size: 16px;
  font-weight: bold;
  margin-top: 10px;
  transition: ease all 0.3s;
}
button[type="submit"]:hover {
  opacity: 0.9;
}
.background {
  width: 70%;
  padding: 40px;
  height: 100vh;
  background: linear-gradient(60deg, rgba(158, 189, 19, 0.5), rgba(0, 133, 82, 0.7)), url('') center no-repeat;
  background-size: cover;
  display: flex;
  flex-wrap: wrap;
  align-items: flex-end;
  justify-content: flex-end;
  align-content: center;
  flex-direction: row;
}
.background h1 {
  max-width: 420px;
  color: #FFF;
  text-align: right;
  padding: 0;
  margin: 0;
}
.background p {
  max-width: 650px;
  color: #1a1a1a;
  font-size: 15px;
  text-align: right;
  padding: 0;
  margin: 15px 0 0 0;
}
.created {
  margin-top: 40px;
  text-align: center;
}
.created p {
  font-size: 13px;
  font-weight: bold;
  color: #008552;
}
.created a {
  color: #666;
  font-weight: normal;
  text-decoration: none;
  margin-top: 0;
}
.checkbox label {
  display: inline;
  margin: 0;
}
</style>
</head>
<body>
<div id="login-page">
  <div class="login">
    <h2 class="login-title">CaringPaws<br>Doctor Admin Login</h2>
    <p class="notice">Please login to access the system</p>
    <form class="form" role="form" method="POST" accept-charset="UTF-8">
      <label for="email">Doctor ID No.</label>
      <div class="input-text">
        <i class="fas fa-envelope icon"></i>
        <input type="text" name="doctorId" placeholder="Enter your Doctor ID No." required>
      </div>
      <label for="password">Password</label>
      <div class="input-password">
        <i class="fas fa-lock icon"></i>
        <input type="password" name="password" placeholder="Enter your password" required>
      </div>
      <div class="checkbox">
        <!--<label for="remember">
          <input type="checkbox" name="remember">
          Remember me
        </label>-->
      </div>
      <button type="submit" name="login"><i class="fas fa-door-open"></i> Sign in</button>
    </form>

    <div class="created">
      <p>Created by <a href="./main.php">CaringPaws</a></p>
    </div>
  </div>
  <div class="background">
    <h1>We care about our Veterinarians</h1>
  </div>
</div>

<script src="assets2/js/jquery.js"></script>

</body>
</html>