<?php

//session_start();

include ("../includes/config.php");
include ("./header.php");
include ("./sidebar.php");
include ("./footer.php");
error_reporting(0);


?>





<div class="subjects">
<?php if (isset($_GET['action']) && $_GET['action'] === 'new') { ?>
  
  <form  method="POST" action="#" enctype="multipart/form-data">

  
<div class="course-C">
    <h3> Course-Content</h3>
   
    <input type="hidden" id="id" name="id" placeholder="id"   >
<div class="cc">
<label>Title:</label>
<input type="text" name="title" placeholder="title"   >
</div>
   
<div class="cc">
<label>Subject:</label>
<input type="text" name="subject" placeholder="subject"   >
</div>

<div class="cc">
<label>Class:</label>
<input type="text"  name="class"  placeholder="class"  >
</div>
<div class="cc">
<label>Description:</label>
<textarea name="description"></textarea>
</div>
<div class="cc">

<input type="file" name="pdf"  >
</div>
<button type="submit" name="submit" class="conbtn">Submit</button>
</div>
</form>

<?php } else if (isset($_GET['action']) && $_GET['action'] === 'update' && isset($_GET['edit'])) {
     $editId = $_GET['edit'];
     $editQuery = mysqli_query($conn, "SELECT * FROM course_contents WHERE id='$editId'");
     $editcourse = mysqli_fetch_assoc($editQuery);
     $description= $editcourse['description'];
     $file= $editcourse['file'];
     ?>
      <form  method="POST" action="#" enctype="multipart/form-data">


<div class="course-C">
  <h3>Course_Content</h3>
 
  <input type="hidden" id="id" name="id" placeholder="id"  value="<?php echo $editcourse['id']; ?>" >
 
<div class="cc">
<label>Title:</label>
<input type="text" name="title" placeholder="title"  value="<?php echo $editcourse['title']; ?>" >
</div>
<div class="cc">
<label>Subject:</label>
<input type="text" name="subject" placeholder="subject"  value="<?php echo $editcourse['subject']; ?>" >
</div>

<div class="cc">
<label>Class:</label>
<input type="text"  name="class"  placeholder="class"  value="<?php echo $editcourse['class']; ?>">
</div>
<div class="cc">
<label>Description:</label>
<textarea name="description"><?php if(isset($description)) echo $description;?></textarea>

</div>
<div class="cc">

<input type="file" name="pdf"  value="<?php echo $editcourse['pdf']; ?>">
</div>
<button type="submit" name="update" >Submit</button>
</div>
</form>


<?php } else { ?>
   <?php $email= $_SESSION['email'] ;
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

            $row = mysqli_fetch_assoc($result);
            $class = $row['class'];?>
	<h1 class="teach_course"><?php echo $class ;?></h1>
    <div class="teach_coursecard">
       
        <a href="../teacher/courses.php?action=new" class="new">Add New</a>
        <br><br>
        <table class="teach_content">
            <tr>
			    <th>Title</th>
                <th>Subject</th>
                <th>Date</th>
                <th>Description</th>
                <th>Document</th>
                <th>Action</th>
            </tr>
            <?php
           
           $query= "SELECT * FROM course_contents ";
           $run = mysqli_query($conn,$query);
               

           while($rows = mysqli_fetch_array($run)){
			$descrip = $rows["description"];
           $description = strip_tags($descrip);
            ?>
                <tr class="tr_course">
				    <td><?php echo $rows["title"]; ?></td>
                    <td><?php echo $rows["subject"]; ?></td>
                    <td><?php echo $rows["date"]; ?></td>
                    
                    <td ><?php echo $description ?></td>
                    <td><a href="../files/<?php echo $rows['file'] ; ?>">Download</a></td>
                    <td class="td">
                        <a href="../teacher/courses.php?edit=<?php echo $rows["id"]; ?>&action=update"
                           class="edit_btn"><i class='bx bxs-edit'></i></a>
                        <a href="../teacher/manage_all.php?delete_course=<?php echo $rows["id"]; ?>" class="del_btn"><i class='bx bxs-trash'></i></a>
                    </td>
                    
                   
                </tr>
            <?php } ?>
        </table>
           </div>

<?php } ?>


<?php

if (isset($_POST['submit'])) {
    $subject = $_POST['subject'];
    $title = $_POST['title'];
    $class = $_POST['class'];
    $description = $_POST['description'];

    $record = "SELECT * FROM classes WHERE class='$class'";
    $result = mysqli_query($conn, $record);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);
    $class_id = $row['class_id'];

    if ($_FILES['pdf']['name'] != '') {
        $pdf = $_FILES['pdf']['name'];
        $pdf_type = $_FILES['pdf']['type'];
        $pdf_size = $_FILES['pdf']['size'];
        $pdf_temp_loc = $_FILES['pdf']['tmp_name'];
        $pdf_store = "../files/" . $pdf;

        move_uploaded_file($pdf_temp_loc, $pdf_store);

        $query = "INSERT INTO course_contents (title, subject, class_id, description, file) VALUES ('$title','$subject','$class_id','$description','$pdf')";
        $run = mysqli_query($conn, $query);

        if ($run) {
            echo "File uploaded and data inserted successfully.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "No file chosen.";
    }
}





   

if (isset($_POST['update'])) {
    $editId = $_POST['id'];
	$title = $_POST['title'];
    $class = $_POST['class'];
    $subject = $_POST['subject'];
    $description = $_POST['description'];
    $fileField = ''; 

    $record = "SELECT * FROM classes WHERE class='$class'";
        $result = mysqli_query($conn, $record);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        $row = mysqli_fetch_assoc($result);
        $class_id = $row['class_id'];

    if($_FILES['pdf']['name']){
        $fileField=$_FILES['pdf']['name'];
        $fileField_type=$_FILES['pdf']['type'];
        $fileField_size=$_FILES['pdf']['size'];
        $fileField_tem_loc=$_FILES['pdf']['tmp_name'];
        $fileField_store="../files/". $fileField;

        move_uploaded_file( $fileField_tem_loc, $fileField_store);
    }else{
    $selectQuery = "SELECT file FROM course_contents WHERE id='$editId'";
    $result = mysqli_query($conn, $selectQuery);
    $row = mysqli_fetch_assoc($result);
    $fileField = $row['file'];
    }
   
    $updateQuery = "UPDATE course_contents SET   title='$title' ,class_id='$class_id' ,file='$fileField',subject='$subject' , description='$description'  WHERE id='$editId'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "updated successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
   
   





</div>


<script src="./js/dashboard.js"></script>
 <script>
 CKEDITOR.replace( 'description' );
</script>

   
  