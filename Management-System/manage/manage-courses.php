<?php
//session_start();

include ("../includes/config.php");



$Error = "";

$edit_state = false;
if (isset($_POST['save'])) {
  $subject = $_POST['Subject_code'];
  $descrip = $_POST['Description'];

 
  $query = "SELECT * FROM courses WHERE Subject_code= '$subject' ";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
      $_SESSION['subjectError'] = "Already Exist. Please choose a different .";
      header("Location: ../admin/courses.php?action=new");
      exit();
  } else {
      $sql = "INSERT INTO courses(Subject_code, Description) VALUES ('$subject','$descrip')";
      
      if (mysqli_query($conn, $sql)) {
          $_SESSION['errormessage'] = "Data Saved Successfully";
          header("Location: ../admin/courses.php");
          exit();
      } else {
          mysqli_close($conn);
      }
  }
}

// For updating records
if (isset($_POST['update'])) {
  $id= $_POST['id'];
  $subject = $_POST['Subject_code'];
  $desrip = $_POST['Description'];
 
  mysqli_query($conn, "UPDATE courses SET  Subject_code='$subject', Description='$desrip' WHERE id='$id' ");
  $_SESSION['message'] = "Data Updated Successfully";
  header('location:../admin/courses.php');
}
// For deleteing records
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM courses WHERE Subject_code='$id' ");
  $_SESSION['message'] = "Data Deleted Successfully";
  header('location:../admin/courses.php');
}
?>