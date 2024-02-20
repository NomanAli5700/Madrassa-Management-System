
<?php

//session_start();


include ("../includes/config.php");
include ("./header.php");
include ("./sidebar.php");
include ("../footer.php");
error_reporting(0);
?>



      
<?php



// Get the number of admissions per day
$sql = "SELECT date, COUNT(*) AS num_admissions FROM admission GROUP BY date";
$result = $conn->query($sql);

// Create an array to store the results
$admissions_per_day = array();
while ($row = $result->fetch_assoc()) {
  $admissions_per_day[$row["date"]] = $row["num_admissions"];
}

// Close the connection to the database




// Get the number of teachers per day
$sql = "SELECT doa, COUNT(*) AS num_teachers FROM teachers GROUP BY doa";
$result = $conn->query($sql);

// Create an array to store the results
$teachers_per_day = array();
while ($row = $result->fetch_assoc()) {
  $teachers_per_day[$row["doa"]] = $row["num_teachers"];
}

// Close the connection to the database


// Get the number of teachers per day
$sql = "SELECT doa, COUNT(*) AS num_students FROM students GROUP BY doa";
$result = $conn->query($sql);

// Create an array to store the results
$students_per_day = array();
while ($row = $result->fetch_assoc()) {
  $students_per_day[$row["doa"]] = $row["num_students"];
}

// Close the connection to the database
$sql = "SELECT date, COUNT(*) AS num_staff FROM staff GROUP BY date";
$result = $conn->query($sql);

// Create an array to store the results
$staff_per_day = array();
while ($row = $result->fetch_assoc()) {
  $staff_per_day[$row["date"]] = $row["num_staff"];
}

?>



    
        
<div class="card_head">
    <div class="card_body1" onclick="redirectToPage('../admin/admissions.php')">
    <i class='bx bxs-school '></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h4>Admissions</h4>
    <h4><?php echo array_sum($admissions_per_day) ?></h4>
    </div>
    <div class="card_body2" onclick="redirectToPage('../admin/staff.php')">
    <i class='bx bx-user-plus '></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h4>Staff_Registration_Data</h4>
    <h4 ><?php echo array_sum($staff_per_day) ?></h4>
    </div>
    <div class="card_body3" onclick="redirectToPage('../admin/student.php')">
    <i class='bx bxs-user-check '></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h4>Students</h4>
    <h4 ><?php echo array_sum($students_per_day) ?></h4>
    </div>


    <div class="card_body4" onclick="redirectToPage('<?=$site_url?>admin/moc_exam.php')">
    <i class="far fa-edit"></i>
        <h4>MOC_Exam</h4>
    </div>
    <div class="card_body5" onclick="redirectToPage('<?=$site_url?>admin/exam_schedule.php')">
    <i class="fas fa-calendar-check fa-sm"></i>
        <h4>Exam_Schedule</h4>
    </div>
    <div class="card_body6" onclick="redirectToPage('<?=$site_url?>admin/result.php')">
    <i class="fas fa-graduation-cap"></i>
        <h4>Result</h4>
    </div>
</div>


<script>
function redirectToPage(pageUrl) {
    window.location.href = pageUrl;
}
</script>


        
        <!--===== MAIN JS =====-->
        <script src="./js/dashboard.js"></script>
       
    </body>
</html>

