<?php
include ("../includes/config.php");
include ("./header.php");
include ("./sidebar.php");
include ("./footer.php");

error_reporting(0);


?>
<style>
.f{

width: 500px;
height: auto;
background-color: #dbdbd5;
border: #999 1px solid;
border-radius: 7px;
margin: 90px  250px;
}
.f h3{

margin-left: 170px;
font-size: 1.8rem;
}
.fc{
width: auto;
margin: 30px;
display: flex;
height:70px;
border: 1px solid #090a0a;
background-color: #868484;
border-radius: 5px;
justify-content: center;
}
.fc input[type=text]{ 
margin: 15px;
width: 60%;
height: 40px;
display: flex;
outline: none;
}
.fc .name{ 
 
  margin: 15px;
  margin-left: 170px;
width: 60%;
height: 40px;
display: flex;
outline: none;
color:#fff;
font-size:30px;
}
.fc p { 
color:#fff;
font-size:20px;
}
.fc input[type=password]{ 
margin: 15px;
width: 60%;
height: 40px;
display: flex;
outline: none;
}
.fc input[type=file]{ 
margin: 15px;
width: 60%;
height: 40px;
display: flex;
outline: none;
}
.probtn{
background-color: green;
color:#fff;
border: none;
width:90px;
height:50px;
margin-left: 40%;
margin-bottom: 30px;
font-size: 1.2rem;
cursor: pointer;
}


</style>
<?php

if (isset($_GET['edit'])) {
    
    $id = $_GET['edit'];
    $record = mysqli_query($conn, "SELECT * FROM teachers WHERE teacher_id =$id");
    $data = mysqli_fetch_array($record);
     $name = $data['name'];
     $email = $data['email'];
     $id = $data['teacher_id'];
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
<p>Password:</p>
<input type="password" id="password" name="password"  placeholder="Password"  value="<?php echo $password; ?>">
</div>
<div class="fc">

<p>Photo:</p><input type="file" name="image"  >
</div>
<button type="submit" name="submit" class="probtn">Submit</button>
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

            $query= mysqli_query($conn, "UPDATE teachers SET  password='$password',image='$imgContent' WHERE teacher_id=$id");
           if($query){
            $_SESSION['message'] = "Data Updated Successfully";
            header("Location: ../teacher/dashboard.php");
           }
        } else {
            echo '<script>alert("Sorry, only JPG, JPEG, PNG, and GIF files are allowed.");</script>';
        }
    }
    header("Location: ../teacher/dashboard.php");
    exit();
   
}
?>







<script src="./js/dashboard.js"></script>