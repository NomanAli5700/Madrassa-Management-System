<?php

//session_start();

include ("../includes/config.php");



?>
<?php
if (isset($_GET['delete_course'])) {
      $id = $_GET['delete_course'];
      mysqli_query($conn, "DELETE FROM course_content WHERE id=$id");
      $_SESSION['message'] = "Data Deleted Successfully";
      header('location:../teacher/courses.php');
    }



?>

<?php
if (isset($_GET['delete_Attend'])) {
      $id = $_GET['delete_Attend'];
      mysqli_query($conn, "DELETE FROM Attendance WHERE id=$id");
      $_SESSION['message'] = "Data Deleted Successfully";
      header('location:../teacher/Attendance.php');
    }



?>