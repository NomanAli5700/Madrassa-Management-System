
<?php

//session_start();


include ("../includes/config.php");
include ("./header.php");
include ("./sidebar.php");
include ("./footer.php");
error_reporting(0);
?>

<br>

<h2 class="result">Result</h2>

<?php if (isset($_SESSION['message'])):?>
    <div class="message">
      <?php 
      echo $_SESSION['message']; 
      unset($_SESSION['message']); 
      ?>
   </div>
  <?php endif ?>

<?php if(isset($_GET['action'])) { ?>
    <div class="ad_resultbody">
<form class="ad_resultform" action="#" method="POST" enctype="multipart/form-data">
    <label>Class:</label>
    <input type="text" name="class" placeholder="class"><br><br>
    <label>File:</label>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="file"><br><br>
    <button type="submit" class="btn" name="submit">Submit</button>
</form>
</div>
<?php } else { ?>
    <div class="ad_resultcard">
    
    <a href="../admin/result.php?action=new" class="add">Add New</a><br><br>
<table class="ad_resulttable">

  <tr>
    <th>Sr No</th>
    <th>class</th>
    <th>result</th>
   
   
    <th>Action</th>
  </tr>
  <?php
   $query = "SELECT * FROM result";
   $result = $conn->query($query);
   if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $fileId = $row['result_id'];
      $class = $row['class'];
  ?>
  <tr>
  <td><?php echo $row["result_id"]; ?></td>
  <td><?php echo $row["class"]; ?></td>
  <td><a href='../admin/download.php?id=<?php echo $row["result_id"]; ?>'><?php echo $row["filename"]; ?></a></td>
  
 
  <td>
  <a href="../admin/result.php?delete=<?php echo $row["result_id"]; ?>" class="del_btn"><i class='bx bxs-trash'></i></a></td>
  </tr>
  <?php

    }
  ?>
</table>
</div>

    <?php } } ?>

        
<?php
   if (isset($_POST['submit'])) {
    $class = $_POST['class'];
    $filename = $_FILES['file']['name'];
    
    $filedata = addslashes(file_get_contents($_FILES['file']['tmp_name']));
    

    $query = "INSERT INTO result (class ,filename, filedata) VALUES ('$class','$filename', '$filedata')";

    if ($conn->query($query) === TRUE) {
        $_SESSION['message'] = "Data Deleted Successfully";
        header('location:../admin/result.php');
    } else {
        echo "Error uploading file: " . $conn->error;
    }

  

   
}

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM result WHERE result_id='$id' ");
  $_SESSION['message'] = "Data Deleted Successfully";
  header('location:../admin/class.php');
}

?>

        <!--===== MAIN JS =====-->
        <script src="./js/dashboard.js"></script>
       
  

