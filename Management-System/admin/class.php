
<?php

//session_start();


include ("../includes/config.php");
include ("./header.php");
include ("./sidebar.php");
include ("./footer.php");
error_reporting(0);


?>
<?php
include '../manage/manage-class.php';
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit_state = true;
    
    $record = mysqli_query($conn, "SELECT * FROM classes WHERE class_id=$id");
$data = mysqli_fetch_array($record);
      $id = $data['class_id'];
      $class = $data['class'];
     
      $subject = $data['subject'];
      
  }
?>

  <?php if (isset($_SESSION['message'])):?>
    <div class="message">
      <?php 
      echo $_SESSION['message']; 
      unset($_SESSION['message']); 
      ?>
   </div>
  <?php endif ?>
  
  <h1 class="ad_course">COURSE</h1>
  <?php if(isset($_GET['action'])) { ?>

    <div class="ad_coursebody">
   <form class="ad_courseform" method="POST" action="../manage/manage-class.php">
  
 <h2 class="ad_addcourse">Add course</h2>
    <input type="hidden" name="id" placeholder="id" value="<?php echo $id; ?>">
    
    <label>Course</label>
     <input type="text" name="class" placeholder="class" value="<?php echo $class; ?>" required><br><br>
   
     
   
    <label>Subject</label> 
     <select name="subject[]" placeholder="courses" id="countries" multiple  required> 
    
 
                  <?php
                $query = mysqli_query($conn, "SELECT * from courses");

                while ($course = mysqli_fetch_object($query)) {
                    echo '<option value="' . $course->Description . '">' . $course->Description . '</option>';
                }
                ?>

 
 
</select>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if (isset($_SESSION['subjectError'])) : ?>
        <span class="message"><?php echo $_SESSION['subjectError']; ?></span>
        <?php unset($_SESSION['subjectError']); ?>
    <?php endif; ?>
    <br>
  <?php if ($edit_state == false) { ?>
  <button class="btn" type="submit" name="save" >Save</button>
  <?php } else { ?>
  <button class="btn" type="submit" name="update" >Update</button>
  <?php } ?>
     
   </form>
  </div>
  
  
  
   <?php } else { ?>
    
    <div class="ad_coursecard">
    
    <a href="../admin/class.php?action=new" class="add">Add New</a><br><br>
<table class="ad_coursetable">
  <tr>
    <th>Sr_no</th>
    <th>Course</th>
   
    <th>Subject</th>
   
    <th>Action</th>
  </tr>
  <?php
  $i=1;
  $result = mysqli_query($conn, "SELECT * FROM classes");

while ($row = mysqli_fetch_assoc($result)) {
  ?>
  <tr>
  <td><?php echo $i++; ?></td>
  <td><?php echo $row["class"]; ?></td>
  
  <td><?php echo $row["subject"]; ?></td>
 
  <td><a href="../admin/class.php?edit=<?php echo $row["class_id"]; ?>&action" class="edit_btn"><i class='bx bxs-edit'></i></a>
  <a href="../manage/manage-class.php?delete=<?php echo $row["class_id"]; ?>" class="del_btn"><i class='bx bxs-trash'></i></a></td>
  </tr>
  <?php
}
}
  ?>
</table>
</div>




<script>
 new MultiSelectTag('countries', {
  
})
</script>
  
  
  


<script src="./js/dashboard.js"></script>


   
