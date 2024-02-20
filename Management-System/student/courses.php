<?php

//session_start();

include ("../includes/config.php");
include ("./header.php");
include ("./sidebar.php");
include ("./footer.php");
error_reporting(0);


?>







<?php if (isset($_GET['action']) && $_GET['action'] === 'view' && isset($_GET['id'])) { ?>

   <?php
         $Id = $_GET['id'];
         $query= "SELECT * FROM course_contents WHERE  id='$Id' ";
         $run = mysqli_query($conn,$query);
             

         while($rows = mysqli_fetch_array($run)){
         
          ?>

<div class="stu_viewcourse">
<h2>Content-Details</h2>
  
<label>Title:<label>
   <hr>

   
     <p class="view"><?php echo $rows["title"];?></p>
   
   <label>Subject:<label>
   <hr>
     
      <p class="view"><?php echo $rows["subject"];?></p>
  
   <label>Description:<label>
   <hr>
     
      <div class="description"><?php  echo $rows["description"];?></div>

   <label>Document:<label>
   <hr>
     
      <p class="view"><a href="../files/<?php echo $rows['file'] ; ?>"><?php echo $rows['file'] ; ?></a></p>
 
</div>
<?php }?>

<?php } else {?>
   <br><br>
   <?php
   $email= $_SESSION['email'] ;
              $record = "SELECT * FROM students WHERE email='$email' ";
            $result = mysqli_query($conn, $record);

            if (!$result) {
               die("Query failed: " . mysqli_error($conn));
            }

            $row = mysqli_fetch_assoc($result);
            $class_id = $row['class_id'];

    $record = "SELECT * FROM classes WHERE class_id='$class_id'";
            $result = mysqli_query($conn, $record);

            if (!$result) {
               die("Query failed: " . mysqli_error($conn));
            }

            $row = mysqli_fetch_assoc($result);
            $class = $row['class'];?>
   <h2 class="stu_course"><?php echo $class ;?></h2>
   <div class="stu_coursecard">
   <table class="stu_content">
     
      <tr>
      <th>Title</th>
      <th>Subject</th>
      <th>Document</th>
      <th>Action</th>
      </tr>
      <?php
              

            $record = "SELECT * FROM classes WHERE class_id='$class_id'";
            $result = mysqli_query($conn, $record);

            if (!$result) {
               die("Query failed: " . mysqli_error($conn));
            }

            $row = mysqli_fetch_assoc($result);
            $class_id = $row['class_id'];
         
           $query= "SELECT * FROM course_contents WHERE class_id='$class_id' ";
           $run = mysqli_query($conn,$query);
               

           while($rows = mysqli_fetch_array($run)){
           
            ?>
      <tr>
        
         <td><?php echo $rows["title"]; ?></td>
         <td ><?php echo $rows["subject"]; ?></td>
         <td>
            <a href="../files/<?php echo $rows['file'] ; ?>">Download</a></td>
         <td><a href="courses.php?id=<?php echo $rows["id"]; ?>&action=view">View Details</a></td>
</tr>
<?php } ?>
</table>


</div>
<?php } ?>




<script src="./js/dashboard.js"></script>


   
