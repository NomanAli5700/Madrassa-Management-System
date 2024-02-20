
<?php

//session_start();


include ("../includes/config.php");
include ("./header.php");
include ("./sidebar.php");
include ("./footer.php");
error_reporting(0);


?>





<h1 class="stu_time">Time Table</h1>


<?php

$email = $_SESSION['email'];
$record = "SELECT * FROM students WHERE email='$email'";
$result = mysqli_query($conn, $record);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
$class_id = $row['class_id'];
  $result = mysqli_query($conn, "SELECT * FROM time_table Where class_id='$class_id' ");
  if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
  ?>
 <br>
 <div class="timet">
 
    <div class="time-content"><?php  echo $row["timetable"];?></div>
    
  </div>
  <?php

}
} else {
  
    echo "Result not found.";
  }


  ?>



<script src="./js/dashboard.js"></script>