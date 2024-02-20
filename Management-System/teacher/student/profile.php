<?php
include ("../includes/config.php");
include ("./header.php");
include ("./sidebar.php");
include ("./footer.php");

error_reporting(0);


?>



<?php

if (isset($_GET['edit'])) {
    
    $id = $_GET['edit'];
    $record = mysqli_query($conn, "SELECT * FROM students WHERE student_id=$id");
    $data = mysqli_fetch_array($record);
     $name = $data['name'];
     $email = $data['email'];
     $id = $data['student_id'];
     $password = $data['password'];
     
  }
?>





<form  method="POST" action="#" enctype="multipart/form-data">

        <div class="f">
            <h3>Edit Profile</h3>
            <input type="hidden" id="email" name="email" placeholder="email"  value="<?php echo $email; ?>" >
            <input type="hidden" id="id" name="id" placeholder="id"  value="<?php echo $id; ?>" >
  <div class="fc">
 
  <p  class="name" name="name" placeholder="Name"   ><?php echo $name; ?></p>
</div>

<div class="fc">
 
  <p>Password:</p><input type="password" id="password" name="password"  placeholder="Password"  value="<?php echo $password; ?>">
</div>
<div class="fc">

<p>Photo:</p><input type="file" name="image"  >
</div>
  <button type="submit" class="probtn" name="submit" >Submit</button>
  </div>
</form>









<?php
if (isset($_POST['submit'])) {
   
    $password = $_POST['password'];
    $id = $_POST['id'];

    
 

    // Update image if it is selected
    if (!empty($_FILES["image"]["name"])) {
        $fileName = basename($_FILES["image"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

        if (in_array($fileType, $allowTypes)) {
            $image = $_FILES['image']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));

            mysqli_query($conn, "UPDATE students SET  password='$password',image='$imgContent' WHERE student_id=$id");
           if($query){
            $_SESSION['message'] = "Data Updated Successfully";
            header("Location: ../student/dashboard.php");
           }
        } else {
            echo '<script>alert("Sorry, only JPG, JPEG, PNG, and GIF files are allowed.");</script>';
        }
    }

    header('location: profile.php');
}
?>





<script src="./js/dashboard.js"></script>