<?php
session_start();

  $msg = "";
  $msg_class = "";
  
  include_once '../assets2/conn/dbconnect.php';
  
  if (isset($_POST['save_profile2'])) {
    // for the database
    $profileImageName2 = time() . '-' . $_FILES["petImage"]["name"];
    // For image upload
    $target_dir = "images2/";
    $target_file = $target_dir . basename($profileImageName2);
    // VALIDATION
    // validate image size. Size is calculated in Bytes
    if($_FILES['petImage']['size'] > 200000) {
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
      if(move_uploaded_file($_FILES["petImage"]["tmp_name"], $target_file)) {
        $sql = "UPDATE petprofile SET profile_image='$profileImageName2' WHERE icPet='{$_SESSION['icPatient']}' ";
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