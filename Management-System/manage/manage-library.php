
<?php
include ("../includes/config.php");


if (isset($_POST['submit'])) {
    $category = $_POST['category'];
    $filename = $_FILES['file']['name'];
    
    $filedata = addslashes(file_get_contents($_FILES['file']['tmp_name']));
    $image = $_FILES['picture']['tmp_name'];
    $imgContent = addslashes(file_get_contents($image));

    $query = "INSERT INTO library (category ,filename, filedata, image) VALUES ('$category','$filename', '$filedata' , '$imgContent')";

    if ($conn->query($query) === TRUE) {
        $_SESSION['message'] = "Data Deleted Successfully";
        header('location:../admin/library.php');
    } else {
        echo "Error uploading file: " . $conn->error;
    }

   

   
}



if (isset($_GET['delete'])) {
      $id = $_GET['delete'];
      mysqli_query($conn, "DELETE FROM library WHERE id=$id");
      $_SESSION['message'] = "Data Deleted Successfully";
      header('location:../admin/library.php');
    }






?>