
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

$sql = "SELECT image FROM students WHERE email = '$email'";
$result = $conn->query($sql);

// Check if the image was found in the database
if ($result->num_rows > 0) {
  // The image was found, so display it
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<img src='data:image/jpg;charset=utf8;base64," . base64_encode($row['image']) . "' />";
  }
} else {  ?>

<img src="vector1.png"/>

<?php } ?>



</div>
<div  class="stu-name">
<?php
$email= $_SESSION['email'] ;



$student_query = "SELECT * FROM students WHERE  email = '$email'";
$student_result = mysqli_query($conn, $student_query);
if (mysqli_num_rows($student_result) > 0) {
       $student = mysqli_fetch_object($student_result);
   
       
   } ?>
   
   
   <h2 ><?=$student->name?><br><?=$student->email?></h2>
</div>
</div>



        
        <!--===== MAIN JS =====-->
        <script src="./js/dashboard.js"></script>
       
    </body>
</html>

