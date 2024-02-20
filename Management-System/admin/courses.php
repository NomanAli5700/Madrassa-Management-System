
<?php

//session_start();


include ("../includes/config.php");
include ("./header.php");
include ("./sidebar.php");
include ("./footer.php");
error_reporting(0);

$Error = "";

?>



<?php
if (isset($_GET['edit'])) {
    $code = $_GET['edit'];
    $edit_state = true;
    $record = mysqli_query($conn, "SELECT * FROM courses WHERE Subject_code ='$code'");
    $data = mysqli_fetch_array($record);
    $id = $data['id'];
    $subject = $data['Subject_code'];
    $descrip = $data['Description'];
      
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
  
 
  <h1 class="ad_subject">SUBJECTS</h1>
  <?php if(isset($_GET['action'])) { ?>

    <div class="ad_subjectbody">
   <form class="ad_subjectform" method="POST" action="../manage/manage-courses.php">
   
 <h2 class="ad_addsubject">Update Subject</h2>
  
     <input type="hidden" name="id" placeholder="id" value="<?php echo $id; ?>">
     <input type="text" name="Subject_code" placeholder="Subject_code" value="<?php echo $subject; ?>">
    <?php if (isset($_SESSION['subjectError'])) : ?>
        <br><br><span style="font-size:15px ;color:red; margin-left:25%;margin-top:200%;" class="message"><?php echo $_SESSION['subjectError']; ?></span>
        <?php unset($_SESSION['subjectError']); ?>
    <?php endif; ?><br>

     <input type="text" name="Description" placeholder="Name" value="<?php echo $descrip; ?>" required> <small><?php echo $Error ?></small><br>
    
  <?php if ($edit_state == false) { ?>
  <button class="btn" type="submit" name="save" >Save</button>
  <?php } else { ?>
  <button class="btn" type="submit" name="update" >Update</button>
  <?php } ?>
  
   </form>
   </div>

<?php } else { ?>
  <div class="ad_subjectcard">
 
  <a href="../admin/courses.php?action=new" class="add">Add New</a>
<br><br>
  <table class="ad_subjecttable">
  <tr>
    <th>Sr No</th>
    <th>Subject_code</th>
    <th>Name</th>
   
    <th>Action</th>
  </tr>
  <?php
  $result = mysqli_query($conn, "SELECT * FROM courses");

while ($row = mysqli_fetch_assoc($result)) {
  ?>
  <tr>
  <td><?php echo $row["id"]; ?></td>
  <td><?php echo $row["Subject_code"]; ?></td>
  <td><?php echo $row["Description"]; ?></td>
 
  <td><a href="../admin/courses.php?edit=<?php echo $row["Subject_code"]; ?>&action" class="edit_btn"><i class='bx bxs-edit'></i></a>
  <a href="../manage/manage-courses.php?delete=<?php echo $row["Subject_code"]; ?>" class="del_btn"><i class='bx bxs-trash'></i></a></td>
  </tr>
  <?php
 
}
}
  ?>
</table>
</div>





  
  
  



<script src="./js/dashboard.js"></script>


   




