<?php
include("../includes/config.php");
include("./header.php");
include("./sidebar.php");
include("./footer.php");
error_reporting(0);
?>

<?php
 $record = "SELECT * FROM students ";
 $result = mysqli_query($conn, $record);

 if (!$result) {
     die("Query failed: " . mysqli_error($conn));
 }

 $row = mysqli_fetch_assoc($result);
 $class_id = $row['class_id'];
 $ID = $row['student_id'];

?>


          
         
        
<?php if (isset($_GET['action']) && $_GET['action'] === 'new') { ?>
    <?php
         $record = "SELECT * FROM teachers WHERE email='$email' ";
         $result = mysqli_query($conn, $record);

         if (!$result) {
            die("Query failed: " . mysqli_error($conn));
         }

         $row = mysqli_fetch_assoc($result);
         $class_id = $row['class_id'];

         $record = "SELECT * FROM classes WHERE class_id='$class_id'";
         $result = mysqli_query($conn, $record);

         if (!$result) {
            die("Query failed: " . mysqli_error($conn));
         }

         $class = mysqli_fetch_assoc($result);
        ?>
  <h1 class="h1"> <?php echo $class['class']; ?></h1>
    <form method="POST" action="#" class="form">
        <div class="up">
            <label>Date:</label>
            <input type="date" name="date" id="date" required>
        </div>
        <div class="down">
            <?php
            $query = mysqli_query($conn, "SELECT * FROM students WHERE class_id= '$class_id'");
            while ($student = mysqli_fetch_array($query)) {
                ?>
                <input type="hidden" name="student_id[]" value="<?php echo $student['student_id']; ?>">
                <input type="hidden" name="class" value="<?php echo $class_id; ?>">
                <input type="hidden" name="name[]" value="<?php echo $student['name'] ; ?>">
                <div class="down1">
                    <h4 ><?php echo $student['name']; ?></h4>
                </div>
                <div class="down2">
                    <select  name="status[]">
                        <option value="">---choose---</option>
                        <option value="Present">Present</option>
                        <option value="Absent">Absent</option>
                        <option value="Late">Late</option>
                    </select>
                </div>
            <?php } ?>
        </div>
        <button type="submit" name="mark" class="mark">Mark</button>
    </form>

<?php } else if (isset($_GET['action']) && $_GET['action'] === 'update' && isset($_GET['edit'])) {
    $editId = $_GET['edit'];
    $editQuery = mysqli_query($conn, "SELECT * FROM student_attendance WHERE id='$editId'");
    $editAttendance = mysqli_fetch_assoc($editQuery);
    ?>
 <h1 class="h1"> Attendance<?php echo $_SESSION['class']; ?></h1>
    <form method="POST" action="#" class="form">
        <div class="up">
            <label>Date:</label>
            <input type="date" name="date" id="date" value="<?php echo $editAttendance['date']; ?>" required>
        </div>
        <div class="down">
        <div class="down-n">
            <input type="hidden" name="edit_id" value="<?php echo $editAttendance['id']; ?>">
            <input type="hidden" name="class" value="<?php echo $editAttendance['class']; ?>">
            <input type="hidden" name="name[]" value="<?php echo $editAttendance['name']; ?>">
            <?php
            $record = "SELECT * FROM teachers WHERE email='$email' ";
            $result = mysqli_query($conn, $record);

            if (!$result) {
               die("Query failed: " . mysqli_error($conn));
            }

            $row = mysqli_fetch_assoc($result);
            $class_id = $row['class_id'];
 
            $record = "SELECT * FROM students WHERE class_id='$class_id'";
            $result = mysqli_query($conn, $record);

            if (!$result) {
               die("Query failed: " . mysqli_error($conn));
            }

            $student = mysqli_fetch_assoc($result);
           ?>
           
            <h4><?php echo $editAttendance['name']; ?></h4>
</div><div class="down-s">
            <select name="status" id="status">
                <option value="">---choose---</option>
                <option value="Present" <?php echo ($editAttendance['status'] === 'Present') ? 'selected' : ''; ?>>Present
                </option>
                <option value="Absent" <?php echo ($editAttendance['status'] === 'Absent') ? 'selected' : ''; ?>>Absent
                </option>
                <option value="Late" <?php echo ($editAttendance['status'] === 'Late') ? 'selected' : ''; ?>>Late
                </option>
            </select><br><br>
        </div>
</div>
        <button type="submit" name="update" class="mark">Update</button>
    </form>

<?php } else { ?>

   
        <h1 class="teach_attend">Attendance</h1>
        <div class="teach_attendcard">
        <a href="../teacher/Attendance.php?action=new" class="new">Add New</a>
        <br><br>
        <table class="teacher_attendtable">
            <tr>
                <th>Name</th>
                <th>Date</th>
                <th>Attendance</th>
                
                <th>Action</th>
            </tr>
            <?php

            $record = "SELECT * FROM teachers WHERE email='$email' ";
            $result = mysqli_query($conn, $record);

            if (!$result) {
            die("Query failed: " . mysqli_error($conn));
            }

            $row = mysqli_fetch_assoc($result);
            $class_id = $row['class_id'];
            
              
            $record = "SELECT * FROM students WHERE class_id='$class_id' ";
            $result = mysqli_query($conn, $record);
          
            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }
          
            $row = mysqli_fetch_assoc($result);
            
            $class_ids = $row['class_id'];
            
            

            
           
            $result = mysqli_query($conn, "SELECT * FROM student_attendance Where class_id='$class_ids'  ");

            while ($row = mysqli_fetch_assoc($result)) {
                $class_id= $row["class_id"];
                ?>
                <tr >
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["date"]; ?></td>
                    <td><?php echo $row["status"]; ?></td>
                    
                    
                    <td class="td">
                        <a href="../teacher/Attendance.php?edit=<?php echo $row["id"]; ?>&action=update"
                           class="edit_btn"><i class='bx bxs-edit'></i></a>
                        <a href="../teacher/manage_all.php?delete_Attend=<?php echo $row["id"]; ?>" class="del_btn"><i class='bx bxs-trash'></i></a>
                    </td>
                </tr>
            <?php } ?>
        </table>
            </div>

<?php } ?>

<?php
if (isset($_POST['mark'])) {
    $date = $_POST['date'];
    $class = $_POST['class'];
    
   


    foreach ($_POST['student_id'] as $index => $studentId) {
        $status = $_POST['status'][$index];
        $name = $_POST['name'][$index];

        $query = "INSERT INTO student_attendance (Std_id, date, status, class_id, name) VALUES ('$studentId', '$date', '$status', '$class', '$name')";

        if (mysqli_query($conn, $query)) {
            echo "Attendance marked successfully.";
            header("Location: ../teacher/Attendance.php");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

if (isset($_POST['update'])) {
    $editId = $_POST['edit_id'];
    $date = $_POST['date'];
    $status = $_POST['status'];
    
    $name = $_POST['name'][0];

    $updateQuery = "UPDATE student_attendance SET status='$status' WHERE id='$editId'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "Attendance updated successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>



   

<script src="./js/dashboard.js"></script>