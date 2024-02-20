<?php 
//session_start();
$site_url='http://localhost/MMS/';

if(isset($_SESSION['login']))

  {
   
    $email= $_SESSION['email'] ;
   
    if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'teacher')
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

        <!-- ===== BOX ICONS ===== -->
      

	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
        
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://cdn.ckeditor.com/4.19.1/full/ckeditor.js"></script>
      
  <!-- overlayScrollbars -->
 
       

        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="../assats/teacher_style.css">
       

        <title>Madrassa Teacher Panel</title>
    </head>
    <body id="body-pd"> 
        <header class="header" id="header">
            <div class="header__toggle">
               
            </div>
            <div>
                <h1>Teacher Panel</h1>
            </div>
            <div class="header__profile" id="headers">

            <?php
            $result = mysqli_query($conn, "SELECT image FROM teachers WHERE email = '$email'" ); 
             ?>

            <?php if($result->num_rows > 0){ ?> 
    
            <?php while($row = $result->fetch_assoc()){ ?> 
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" /> 
            <?php } ?> 
   
            <?php }else{ ?> 
            <img  src="vector1.png" alt="Italian Trulli">
            <?php } ?>

<?php
$email= $_SESSION['email'] ;
$teacher_query = "SELECT * FROM teachers WHERE email = '$email'";
$teacher_result = mysqli_query($conn, $teacher_query);
if (mysqli_num_rows($teacher_result) > 0) {
       $teacher = mysqli_fetch_object($teacher_result);
   
       // Display student details on the student panel page
           // Display other student details as needed
   } ?>
   
   <p><?=$teacher->name?></p>
   
            </div>
        </header> 

        



        <script>
   const headers= document.getElementById('headers')

   header.addEventListener('click',function(){
    document.location.href ="profile.php?edit=<?=$teacher->teacher_id?>&action=update";
   });
</script>