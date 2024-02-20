
<?php

//session_start();


include ("../includes/config.php");
include ("./header.php");
include ("./sidebar.php");
include ("./footer.php");
error_reporting(0);


?>





<h1 style="color: #B22B4F;margin-left:33%;font-size:40px;">Exam_Schedule</h1>
<br>
<?php

$email = $_SESSION['email'];
$record = "SELECT * FROM students WHERE email='$email'";
$result = mysqli_query($conn, $record);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
$class_id = $row['class_id'];


$result = mysqli_query($conn, "SELECT * FROM exams_schedule WHERE class_id='$class_id'");
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
    <br>
    <div class="timet">
        <div class="time-content"><?php echo $row["schedule"]; ?></div>
    </div>
<?php
    }
  
} else {
  
  echo "Result not found.";
}



?>




<script src="./js/dashboard.js"></script>