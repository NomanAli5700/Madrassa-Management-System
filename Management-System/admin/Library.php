
<?php

//session_start();


include ("../includes/config.php");
include ("./header.php");
include ("./sidebar.php");
include ("./footer.php");
error_reporting(0);


?>

<h2 class="ad_libr">LIBRARY</h2>

<?php if (isset($_SESSION['message'])):?>
    <div class="message">
      <?php 
      echo $_SESSION['message']; 
      unset($_SESSION['message']); 
      ?>
   </div>
  <?php endif ?>
  
 

  <?php if(isset($_GET['action'])) { ?>
    <div class="ad_libbody">
   <form class="ad_libform" method="POST" enctype="multipart/form-data" action="../manage/manage-library.php">
  
<h3 style="
    color: #B22B4F;
   margin-left:38%;
   font-size:25px;">Add Book</h3>
  
     <input type="hidden" name="id" placeholder="id" value="<?php echo $id; ?>">
    
     <label>Category:</label><input type="text" name="category" placeholder="Category" ><br>
     <label>Image:</label>&nbsp;&nbsp;<input type="file" name="picture"  ><br>
     <label>Book:</label>&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="file"  ><br>
    
    
 
  <button class="btn" type="submit" name="submit" >Save</button>
  
  
   </form>
   </div>

<?php } else { ?>
  <div class="library">
  <a href="../admin/Library.php?action=new" class="add">Add New</a>
  <br><br>
<table class="ad_libtable">
  <tr>
    <th>ID</th>
    <th>Category</th>
    <th>Image</th>
    <th>Book</th>
   
    <th>Action</th>
  </tr>
  <?php
   $query = "SELECT * FROM library";
   $result = $conn->query($query);
   if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $fileId = $row['id'];
      $filename = $row['filename'];
  ?>
  <tr>
  <td><?php echo $row["id"]; ?></td>
  <td><?php echo $row["category"]; ?></td>
  <td><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" class="image"/> </td>
  <td><a href='../admin/download.php?id=<?php echo $row["id"]; ?>'><?php echo $row["filename"]; ?></a></td>
    
  <td>
  <a href="../manage/manage-library.php?delete=<?php echo $row["id"]; ?>" class="del_btn"><i class='bx bxs-trash'></i></a></td>
  </tr>
  <?php
    }

}
}


  ?>
</table>

</div>





<script src="./js/dashboard.js"></script>










