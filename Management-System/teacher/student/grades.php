
<?php

//session_start();


include ("../includes/config.php");
include ("./header.php");
include ("./sidebar.php");
include ("./footer.php");
error_reporting(0);


?>





<h1 class="stu_grades">Grades</h1>
<br>
<?php

$email = $_SESSION['email'];
$record = "SELECT * FROM students WHERE email='$email'";
$result = mysqli_query($conn, $record);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
$class_id= $row['class_id'];

$record = "SELECT * FROM classes WHERE class_id='$class_id'";
$result = mysqli_query($conn, $record);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
$class= $row['class'];

$result = mysqli_query($conn, "SELECT * FROM result WHERE class='$class'");
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
    <br>
    <div class="grade">
    <table class="stu_resulttable">
    <tr>
    
    <th>Title</th>
    <th>Grades List</th>
   
    
    </tr>
        
   
    <tr>
    <td><label>Anuual Grades:  </label></td>
    <td><a href='../admin/download.php?id=<?php echo $row["result_id"]; ?>'><?php echo $row["filename"]; ?></a></td>
 </tr>
 

</table>    
</div>
<?php
    }
  }else{
   echo 'No Result Found ';
  }


?>




<script src="./js/dashboard.js"></script>