<?php
session_start();

if(!isset($_SESSION['bloggerSession']))
{
 header("Location: ./blogger/bloggerdashboard.php");
}
else if(isset($_SESSION['bloggerSession'])!="")
{
 header("Location: ../main.php");
}
if(isset($_GET['logout']))
{
 session_destroy();
 unset($_SESSION['bloggerSession']);
 header("Location: ../main.php");
}
?>