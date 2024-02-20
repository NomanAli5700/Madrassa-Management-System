<?php
include ("../includes/config.php");
include ("./header.php");
include ("./sidebar.php");
include ("./footer.php");
error_reporting(0);


?>



<section >
<h1 class="stu_attend">Attendance</h1>
<div class="stu_attendcard">
<table class="stu_attendtable">
    <tr>
    
    <th class="th">Date</th>
    <th>Attendance</th>
   
    
    </tr>
    <?php
  $result = mysqli_query($conn, "SELECT * FROM student_attendance WHERE name='$name'");

while ($row = mysqli_fetch_assoc($result)) {
  ?>
  <tr>
 

  <td class="td"><?php echo $row["date"]; ?></td>
  <td><?php echo $row["status"]; ?></td>
  
  
  </tr>
  <?php
 
}

  ?>

</table>
</div>
</section>
<script src="./js/dashboard.js"></script>