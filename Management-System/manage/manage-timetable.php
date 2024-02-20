<?php
//session_start();

include ("../includes/config.php");




$edit_state = false;
if (isset($_POST['submit'])) {
 
  $timetable = $_POST['timetable'];
  $class = $_POST['class'];

   // Fetch class_id from classes table
   $record = "SELECT * FROM classes WHERE class='$class'";
   $result = mysqli_query($conn, $record);
 
   if (!$result) {
       die("Query failed: " . mysqli_error($conn));
   }
 
   $row = mysqli_fetch_assoc($result);
   $class_id = $row['class_id'];
 
 $sql = "INSERT INTO time_table (timetable,class_id) VALUES ('$timetable','$class_id')";
 if (mysqli_query($conn, $sql)) { 
   $_SESSION['message'] = "Data Saved Successfully";
    header("Location: ../admin/timetable.php");
   } else {
    mysqli_close($conn);
   }
   
}
// For updating records
if (isset($_POST['update'])) {
  $editId = $_POST['id'];
  $timetable = $_POST['timetable'];
  $class = $_POST['class'];

   // Fetch class_id from classes table
   $record = "SELECT * FROM classes WHERE class='$class'";
   $result = mysqli_query($conn, $record);
 
   if (!$result) {
       die("Query failed: " . mysqli_error($conn));
   }
 
   $row = mysqli_fetch_assoc($result);
   $class_id = $row['class_id'];

 
  $sql =  "UPDATE time_table SET  timetable='$timetable' , class_id='$class_id' WHERE  id=$editId"  ;
  if (mysqli_query($conn, $sql)) { 
    $_SESSION['message'] = "Data Saved Successfully";
     header("Location: ../admin/timetable.php");
    } else {
     mysqli_close($conn);
    }
}


if (isset($_GET['delete_timetable'])) {
  $id = $_GET['delete_timetable'];
  mysqli_query($conn, "DELETE FROM time_table WHERE id=$id");
  $_SESSION['message'] = "Data Deleted Successfully";
  header('location:../admin/timetable.php');
}
?>