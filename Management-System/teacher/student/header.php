<?php 
//session_start();
$site_url='http://localhost/MMS/';
if(isset($_SESSION['login']))
  {
    $email= $_SESSION['email'] ;
    $name= $_SESSION['name'] ;
    
    if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'student')
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
        
        
        
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
        
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>

      
  <!-- overlayScrollbars -->
       
       

        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="../assats/student_style.css">
       
        

        <title>Madrassa Student Panel</title>
    </head>
    <style>
    .header__profile{
  background-color: #fff;
  border-radius: 5px;
  width:120px;
  height:50px;
 display: flex;
 cursor: pointer;
}</style>
    <body id="body-pd"> 
        <header class="header" id="header">
            <div class="header__toggle">
               
            </div>
            <div>
                <h1>Student Panel</h1>
            </div>
            <div class="header__profile" id="headers">

            
              <?php 

 
// Get image data from database 

$result = mysqli_query($conn, "SELECT image FROM students WHERE email = '$email'" ); 
?>

<?php if($result->num_rows > 0){ ?> 
    
        <?php  while($row = $result->fetch_assoc()){ ?> 
          
           <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" />
            
          
           
        <?php } ?> 
   
<?php }else{ ?> 
    <img  src="users.png">
<?php } ?>

                
            
            <?php
$email= $_SESSION['email'] ;

$student_query = "SELECT * FROM students WHERE  email = '$email'";
$student_result = mysqli_query($conn, $student_query);
if (mysqli_num_rows($student_result) > 0) {
       $student = mysqli_fetch_object($student_result);
   
       // Display student details on the student panel page
       
        // Display student's name
       // Display student's email
       // Display other student details as needed
   } ?>
   
   <p class="p"><?=$student->name?></p>
   
   
   

            </div>
      
        </header> 
       

       



<script>
   const headers= document.getElementById('headers')

   header.addEventListener('click',function(){
  
    document.location.href ="profile.php?edit=<?=$student->student_id?>&action=update";
   });
</script>
        
