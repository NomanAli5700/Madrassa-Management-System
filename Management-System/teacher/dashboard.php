
<?php

//session_start();


include ("../includes/config.php");
include ("./header.php");
include ("./sidebar.php");
include ("./footer.php");
error_reporting(0);
?>

   

      <body>  
   
<div class="dash-stu">
    <div  class="stu-image">
<?php 

 
// Get image data from database 

$result = mysqli_query($conn, "SELECT image FROM teachers WHERE email = '$email'" ); 
?>

<?php if($result->num_rows > 0){ ?> 
    
        <?php while($row = $result->fetch_assoc()){ ?> 
            <img  src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" /> 
        <?php } ?> 
   
<?php }else{ ?> 
    <img  src="vector1.png">
<?php } ?>

</div>
<div  class="stu-name">
<?php
$email= $_SESSION['email'] ;

$teacher_query = "SELECT * FROM teachers WHERE  email = '$email'";
$teacher_result = mysqli_query($conn, $teacher_query);
if (mysqli_num_rows($teacher_result) > 0) {
       $teacher = mysqli_fetch_object($teacher_result);
   
       // Display student details on the student panel page
       
        // Display student's name
       // Display student's email
       // Display other student details as needed
   } ?>
   
   
   <h2 ><?=$teacher->name?><br><br><?=$teacher->email?></h2>
 
</div>
</div>

        
        <!--===== MAIN JS =====-->
        <script src="./js/dashboard.js"></script>
       
    </body>
</html>

