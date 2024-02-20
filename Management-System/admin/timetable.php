
<?php

//session_start();


include ("../includes/config.php");
include ("./header.php");
include ("./sidebar.php");
include ("./footer.php");
error_reporting(0);


?>




<h2 class="ad_timetab">TimeTable</h2>
<?php if (isset($_SESSION['message'])):?>
    <div class="message">
      <?php 
      echo $_SESSION['message']; 
      unset($_SESSION['message']); 
      ?>
   </div>
  <?php endif ?>
  
 

  <?php if(isset($_GET['action'])  && $_GET['action'] === 'new') { ?>
<div class="ad_timebody">
   <form class="ad_timeform" method="POST" enctype="multipart/form-data" action="../manage/manage-timetable.php">
   <h3 style="
    color: #B22B4F;
   margin-left:38%;
   font-size:25px;">Add TimeTable</h3>
    <input  name="class" placeholder="class" required><br><br>
   <textarea name="timetable" class="timetable" required></textarea ><br>
   <button class="timebtn" type="submit" name="submit" >Save</button>
   </form>
  </div>

   <?php } else if (isset($_GET['action']) && $_GET['action'] === 'update' && isset($_GET['edit'])) {
     $editId = $_GET['edit'];
     $editQuery = mysqli_query($conn, "SELECT * FROM time_table WHERE id='$editId'");
     $edittime = mysqli_fetch_assoc($editQuery);
     $id= $edittime['id'];
     $timetable= $edittime['timetable'];
     $class= $edittime['class_id'];
     $record = mysqli_query($conn, "SELECT * FROM classes WHERE class_id =$class");
   
     $edittime = mysqli_fetch_array($record);
     $class_name = $edittime['class'];
    
    ?>
     <div class="ad_timebody">
     <form class="ad_timeform" method="POST" enctype="multipart/form-data" action="../manage/manage-timetable.php">
     <h3 style="
    color: #B22B4F;
   margin-left:38%;
   font-size:25px;">Update TimeTable</h3>
     <input type="hidden"  name="id"  value="<?php echo $id; ?>" ><br><br>
     <input  name="class" placeholder="class" value="<?php echo $edittime['class']; ?>" required><br><br>
     <textarea name="timetable" required ><?php if(isset($timetable)) echo $timetable;?></textarea>
     <br>
     <button class="timebtn" type="submit" name="update" >update</button>
     </form>
   </div>

   <?php } else { ?>
 <div class="ad_timecard">
  <a href="../admin/timetable.php?action=new" class="add">Add New</a>
  <br><br>
  <table class="ad_timetable">
  <tr>
    <th>Course</th>
    <th>Date</th>
   
   
    <th>Action</th>
  </tr>
 
  <?php
  $result = mysqli_query($conn, "SELECT * FROM time_table");

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
   
  <td><?php  echo $classRow["class"]; ?></td>
  <td><?php echo $row["date"];?></td>
    
  <td><a href="../admin/timetable.php?edit=<?php echo $row["id"]; ?>&action=update" class="edit_btn"><i class='bx bxs-edit'></i></a>
  <a href="../manage/manage-timetable.php?delete_timetable=<?php echo $row["id"]; ?>" class="del_btn"><i class='bx bxs-trash'></i></a>
  </td>  
</tr>
 
  <?php

}
}
  ?>



</table>
</div>




<script src="./js/dashboard.js"></script>
<script>
 CKEDITOR.replace( 'timetable' );
</script>