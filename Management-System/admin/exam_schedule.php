
<?php

//session_start();


include ("../includes/config.php");
include ("./header.php");
include ("./sidebar.php");
include ("./footer.php");
error_reporting(0);


?>




<h2 class="ad_exam">Exam_Schedule</h2>
<?php if (isset($_SESSION['message'])):?>
    <div class="message">
      <?php 
      echo $_SESSION['message']; 
      unset($_SESSION['message']); 
      ?>
   </div>
  <?php endif ?>
  
 

  <?php if(isset($_GET['action'])  && $_GET['action'] === 'new') { ?>
    <div class="ad_exambody">
   <form class="ad_examform" method="POST" enctype="multipart/form-data" action="../manage/manage-exam.php">
    <input type="text" name="class" placeholder="class" required><br><br>
   <textarea name="exam" required></textarea><br>
   <button class="exambtn" type="submit" name="submit" >Save</button>
   </form>
  </div>

   <?php } else if (isset($_GET['action']) && $_GET['action'] === 'update' && isset($_GET['edit'])) {
     $editId = $_GET['edit'];
     $editQuery = mysqli_query($conn, "SELECT * FROM exams_schedule WHERE ID='$editId'");
     $editexam = mysqli_fetch_assoc($editQuery);
     $Id= $editexam['ID'];
     $exam= $editexam['schedule'];
     $class= $editexam['class_id'];

     $record = mysqli_query($conn, "SELECT * FROM classes WHERE class_id =$class");
   
     $editexam = mysqli_fetch_array($record);
     $class_name = $editexam['class'];

    ?>
     <div class="ad_exambody">
     <form class="ad_examform" method="POST" enctype="multipart/form-data" action="../manage/manage-exam.php">
     <input type="hidden"  name="id"  value="<?php echo $Id; ?>" ><br><br>
     <input type="text" name="class" placeholder="class" value="<?php echo $editexam['class']; ?>" required><br><br>
     <textarea name="exam" required><?php if(isset($exam)) echo $exam;?></textarea>
     <br>
     <button class="exambtn" type="submit" name="update" >update</button>
     </form>
   </div>
   <?php } else { ?>
    <div class="ad_examcard">
  <a href="../admin/exam_schedule.php?action=new" class="add">Add New</a>
  <br><br>
  <table class="ad_examtable">
  <tr>
  <th>ID</th>
    <th>Course</th>
    <th>Date</th>
    <th>Action</th>
  </tr>
 
 
  <?php
  $result = mysqli_query($conn, "SELECT * FROM exams_schedule");

  while ($row = mysqli_fetch_assoc($result)) {
    $class = $row["class_id"];
    
    $record = "SELECT * FROM classes WHERE class_id='$class'";
    $classResult = mysqli_query($conn, $record); // Use a different variable
    
    if (!$classResult) {
        die("Query failed: " . mysqli_error($conn));
    }
  
    $classRow = mysqli_fetch_assoc($classResult); // Use a different variable
   
  ?>
 <br>
 <tr>
     <td><?php echo $row["ID"];?></td>
     <td><?php echo $classRow["class"];?></td>
     <td><?php echo $row["date"];?></td>
    
  <td><a href="../admin/exam_schedule.php?edit=<?php echo $row["ID"]; ?>&action=update" class="edit_btn"><i class='bx bxs-edit'></i></a>
  <a href="../manage/manage-exam.php?delete=<?php echo $row["ID"]; ?>" class="del_btn"><i class='bx bxs-trash'></i></a>
  </td>
  <?php

}
}
  ?>
</table>
</div>








<script src="./js/dashboard.js"></script>
<script>
 CKEDITOR.replace( 'exam' );
</script>