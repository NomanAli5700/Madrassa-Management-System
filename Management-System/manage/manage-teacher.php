<?php
//session_start();
include ("../includes/config.php");

$error='';

  
$edit_state = false;

if (isset($_POST['submit1'])) {
  // Your database connection setup here
  
  $class = $_POST['class'];
  $name = $_POST['name'];
  $age= $_POST['age'];
  $gender = $_POST['gender'];
  $year = $_POST['year'];
  $mobile = $_POST['mobile'];
  $email = $_POST['email'];
  $password = md5(1234567890);
  $address = $_POST['address'];
  $qualification = $_POST['qualification'];
  $experience = $_POST['experience'];
  $doa = $_POST['doa'];
  $type = $_POST['type'];
  
  // Fetch class_id from classes table

  $query = "SELECT * FROM teachers WHERE email= '$email' ";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
      $_SESSION['subjectError'] = "Already Exist. Please choose a different .";
      header("Location: ../admin/teacher.php?action=new");
      exit();
  }

  $record = "SELECT * FROM classes WHERE class='$class'";
  $result = mysqli_query($conn, $record);

  if (!$result) {
      die("Query failed: " . mysqli_error($conn));
  }

  $row = mysqli_fetch_assoc($result);
  $class_id = $row['class_id'];

  // Insert teacher record with class_id as foreign key
  $query = "INSERT INTO teachers (name, email, type, contect, password, address,gender, age, qualification, experience, doa, year, class_id) 
            VALUES ('$name', '$email', '$type', '$mobile', '$password', '$address','$gender', '$age','$qualification', '$experience', '$doa', '$year','$class_id')";

  if (mysqli_query($conn, $query)) {
      header("Location: ../admin/teacher.php?user=teacher");
      exit();
  } else {
      die('Insertion unsuccessful: ' . mysqli_error($conn));
  }
}

    
    if (isset($_POST['update'])) {
      $id = $_POST['id'];
      $year = $_POST['year'];
      $name = $_POST['name'];
      $age= $_POST['age'];
  $gender = $_POST['gender'];
      $mobile = $_POST['mobile'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $address = $_POST['address'];
      $contect = $_POST['mobile'];
      $qualification = $_POST['qualification'];
      $experience =$_POST['experience'];
      $class = $_POST['class'];
      $doa = $_POST['doa'];

      
      
       // Fetch class_id from classes table
  $record = "SELECT * FROM classes WHERE class='$class'";
  $result = mysqli_query($conn, $record);

  if (!$result) {
      die("Query failed: " . mysqli_error($conn));
  }

  $row = mysqli_fetch_assoc($result);
  $class_id = $row['class_id'];

    
      $query= mysqli_query($conn, "UPDATE teachers SET name='$name',year='$year',email='$email',contect='$mobile',gender='$gender',age ='$age',password='$password',address='$address',contect='$contect',qualification='$qualification',experience='$experience',class_id='$class_id',doa='$doa' WHERE  teacher_id= '$id'  ");
      if($query)
   {
      $_SESSION['message'] = "Data Updated Successfully";
      header('location: ../admin/teacher.php?user=teacher');
    }else{
      die('unsucessful');

    }
  }
    // For




    if (isset($_GET['delete'])) {
      $id = $_GET['delete'];
      mysqli_query($conn, "DELETE FROM teachers WHERE teacher_id=$id");
      $_SESSION['message'] = "Data Deleted Successfully";
      header('location:../admin/teacher.php?user=teacher');
    }































?>

