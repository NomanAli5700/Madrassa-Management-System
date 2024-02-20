<?php
//session_start();
include ("../includes/config.php");

$error='';

$edit_state = false;

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
     $age= $_POST['age'];
  $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $year = $_POST['year'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $password = md5(1234567890);
    $address = $_POST['address'];
    $father_name = $_POST['father_name'];
    $father_mobile = $_POST['father_mobile'];
    $previous_class =$_POST['previous_class'];
    $previous_percentage = $_POST['previous_percentage'];
    $class = $_POST['class'];
    $doa = $_POST['doa'];
    $type = $_POST['type'];

    $query = "SELECT * FROM students WHERE email= '$email' ";
    $result = mysqli_query($conn, $query);
  
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['subjectError'] = "Already Exist. Please choose a different .";
        header("Location: ../admin/student.php?action=new");
        exit();
    }


    $record = "SELECT * FROM classes WHERE class='$class'";
  $result = mysqli_query($conn, $record);

  if (!$result) {
      die("Query failed: " . mysqli_error($conn));
  }

  $row = mysqli_fetch_assoc($result);
  $class_id = $row['class_id'];
   
   

    $query= mysqli_query($conn, "INSERT INTO students (name,dob,email,year,type,mobile,password,address,gender, age, father_name,father_mobile,previous_class,previous_percentage,class_id,doa) 
    VALUES ('$name','$dob','$email', '$year','$type','$mobile','$password','$address','$gender', '$age','$father_name','$father_mobile','$previous_class ','$previous_percentage','$class_id','$doa')") or die('unsucessful');
 
  

  if($query)
  {
   header("Location: ../admin/student.php?user=student");
  }
  else{
   die('unsucessful');
  }


   

    }
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $age= $_POST['age'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $year = $_POST['year'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $father_name = $_POST['father_name'];
        $father_mobile = $_POST['father_mobile'];
        $previous_class =$_POST['previous_class'];
        $previous_percentage = $_POST['previous_percentage'];
        $class = $_POST['class'];
        $doa = $_POST['doa'];
      
        $record = "SELECT * FROM classes WHERE class='$class'";
        $result = mysqli_query($conn, $record);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        $row = mysqli_fetch_assoc($result);
        $class_id = $row['class_id'];
   
    
      $query= mysqli_query($conn, "UPDATE students SET name='$name' ,dob='$dob',year='$year',email='$email',mobile='$mobile',password='$password',address='$address',gender='$gender',age ='$age', father_name='$father_name',father_mobile='$father_mobile',previous_class='$previous_class',previous_percentage='$previous_percentage',class_id='$class_id',doa='$doa' WHERE  student_id='$id'  ");
      if($query)
   {
      $_SESSION['message'] = "Data Updated Successfully";
      header('location: ../admin/student.php?user=student');
   }
   else{
    die('unsucessful');
   }
   
    }
    // For




    if (isset($_GET['delete'])) {
      $id = $_GET['delete'];
      mysqli_query($conn, "DELETE FROM students WHERE student_id=$id");
      $_SESSION['message'] = "Data Deleted Successfully";
      header('location:../admin/student.php?user=student');
    }































?>

