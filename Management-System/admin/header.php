<?php 
//session_start();
$site_url='http://localhost/MMS/';
if(isset($_SESSION['login']))
  {
    $email= $_SESSION['email'] ;
   
    $user_type = $_SESSION['user_type'];
   
  
    if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'admin')
    {
      
      $user_type = $_SESSION['user_type'];
     
      header('Location: /MMS/'.$user_type.'/dashboard.php');
    }
   
  }
else{
    header('Location: ../login.php');
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
     
		

       
  <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
      
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
      
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.ckeditor.com/4.19.1/full/ckeditor.js"></script>
        
      
  <!-- overlayScrollbars -->
 
       

        <!-- ===== CSS ===== -->
      
        <link rel="stylesheet" href=" ../assats/admin_style.css">
       
        

        <title>Madrassa Admin Panel</title>
    </head>
 


   
    <body id="body-pd"> 
        <header class="header" id="header">
            <div class="header__toggle">
               
            </div>
            <div>
                <h1>Admin Panel</h1>
            </div>
            <div class="header__profile" id="headers">
            
            
           
            </div>
        </header> 

        