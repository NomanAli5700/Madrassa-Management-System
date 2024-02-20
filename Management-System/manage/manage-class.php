<?php
//session_start();

include ("../includes/config.php");




$edit_state = false;
if (isset($_POST['save'])) {
   
  $class = $_POST['class'];
  
  $subject = $_POST['subject'];

  $alldata=implode(",",$subject);

  $query = "SELECT * FROM classes WHERE class= '$class' ";
  $result = mysqli_query($conn, $query);
 
  if (mysqli_num_rows($result) > 0) {
    $_SESSION['subjectError']= "Already Exist.Please choose different.";
  header("Location: ../admin/class.php?action=new");
  exit();
  }  
    else{

$sql = "INSERT INTO classes (class ,subject) VALUES ('$class','$alldata')";
if(mysqli_query($conn, $sql)) { 
  $ID = mysqli_insert_id($conn);}
  $sql = "INSERT INTO teachers (class_id) VALUES ('$ID')";
  if(mysqli_query($conn, $sql)) { 
  $_SESSION['message'] = "Data Saved Successfully";
  header("Location: ../admin/class.php");
  exit();
 } else {
  mysqli_close($conn);
 }
 
}
}
// For updating records
if (isset($_POST['update'])) {
  $id = $_POST['id'];
    $class = $_POST['class'];
   
    $subject = $_POST['subject'];
    
    $alldata=implode(",",$subject);
 
    mysqli_query($conn, "UPDATE classes SET class='$class',  subject='$alldata' WHERE  class_id='$id'  ");
    $_SESSION['message'] = "Data Updated Successfully";
    header('location: ../admin/class.php');
  }
  // For deleteing records
  if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM classes WHERE class_id=$id");
    $_SESSION['message'] = "Data Deleted Successfully";
    header('location:../admin/class.php');
  }
  ?>