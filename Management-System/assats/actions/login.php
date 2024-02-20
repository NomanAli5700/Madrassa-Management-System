<?php

  include('../includes/config.php');


  if (isset($_POST['login'])) {
  
   $email = $_POST['email'];
  
   $pass = md5(1234567890);
   $password = $_POST['password'];
  $query = mysqli_query($conn,"SELECT * FROM `teachers` WHERE `email` = '$email' AND (`password` = '$pass'  OR `password` = '$password')");

   if(mysqli_num_rows($query) > 0)
   {
     $user = mysqli_fetch_object($query);
     $_SESSION['login'] = true;
     $_SESSION['session_id'] = uniqid();
   
     $user_type = $user->type;
     $email= $user->email;
     $id= $user->id;
     $class= $user->class;
     $_SESSION['user_type'] = $user_type;
     $_SESSION['email'] = $email;
     $_SESSION['id'] = $id;
     $_SESSION['class_id'] = $class;
     header('Location: ../'.$user_type.'/dashboard.php');
     exit();
   }
   else {
     echo 'Invailid Credentials';
   }
  }


  if (isset($_POST['login'])) {
    $email = $_POST['email'];
   
    
    $pass = md5(1234567890);
    $password = $_POST['password'];
     $query = mysqli_query($conn,"SELECT * FROM `students` WHERE `email` = '$email' AND (`password` = '$pass'  OR `password` = '$password')");
 
    if(mysqli_num_rows($query) > 0)
    {
      $user = mysqli_fetch_object($query);
      $_SESSION['login'] = true;
      $_SESSION['session_id'] = uniqid();
      
      $user_type = $user->type;
      $name = $user->name;
      $email= $user->email;
      $id= $user->id;
      $class= $user->class;
      $_SESSION['user_type'] = $user_type;
      $_SESSION['email'] = $email;
      $_SESSION['id'] = $id;
      $_SESSION['class'] = $class;
      $_SESSION['name'] = $name;
      header('Location: ../'.$user_type.'/dashboard.php');
      exit();
    }
    else {
      echo 'Invailid Credentials';
    }
  }

    
  
   
 

   
 
 
if (isset($_POST['login'])) 
{
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $type = $_POST['type'];
      
     $query = mysqli_query($conn,"SELECT * FROM `admin` WHERE `email` = '$email' AND `password` = '$pass'  ") ;
 
    if(mysqli_num_rows($query) > 0)
    
     {
      
      $user = mysqli_fetch_object($query);
      $_SESSION['login'] = true;
      $_SESSION['session_id'] = uniqid();
     
     
      $user_type = $user->type;
      
      $email= $user->email;
      
     
     
    
      $_SESSION['email'] = $email;
    
      $_SESSION['user_type'] = $user_type;
      header('Location: ../admin/dashboard.php');
    }
   
  }
  else {
    echo 'Invailid Credentials';
  }


?>