<?php
//session_start();

include ("../includes/config.php");




$edit_state = false;
if (isset($_POST['submit'])) {
 
  $exam = $_POST['exam'];
  $class = $_POST['class'];

   // Fetch class_id from classes table
   $record = "SELECT * FROM classes WHERE class='$class'";
   $result = mysqli_query($conn, $record);
 
   if (!$result) {
       die("Query failed: " . mysqli_error($conn));
   }
 
   $row = mysqli_fetch_assoc($result);
   $class_id = $row['class_id'];
 
 $sql = "INSERT INTO exams_schedule (schedule,class_id) VALUES ('$exam','$class_id')";
 if (mysqli_query($conn, $sql)) { 
   $_SESSION['message'] = "Data Saved Successfully";
    header("Location: ../admin/exam_schedule.php");
   } else {
    mysqli_close($conn);
   }
   
}
// For updating records
if (isset($_POST['update'])) {
  $editId = $_POST['id'];
  $exam = $_POST['exam'];
  $class = $_POST['class'];

   // Fetch class_id from classes table
   $record = "SELECT * FROM classes WHERE class='$class'";
   $result = mysqli_query($conn, $record);
 
   if (!$result) {
       die("Query failed: " . mysqli_error($conn));
   }
 
   $row = mysqli_fetch_assoc($result);
   $class_id = $row['class_id'];
   
  $sql =  "UPDATE exams_schedule SET schedule='$exam' , class_id='$class_id' WHERE  ID=$editId";
  if (mysqli_query($conn, $sql)) { 
    $_SESSION['message'] = "Data Saved Successfully";
     header("Location: ../admin/exam_schedule.php");
    } else {
     mysqli_close($conn);
    }
}


if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM exams_schedule WHERE es_id=$id");
  $_SESSION['message'] = "Data Deleted Successfully";
  header('location:../admin/exam_schedule.php');
}
?>