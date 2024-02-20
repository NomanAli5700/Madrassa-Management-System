
<?php

//session_start();


include ("../includes/config.php");
include ("./header.php");
include ("./sidebar.php");
include ("./footer.php");
error_reporting(0);
?>

</head>

             

       
<body>
<h2 class="ad_admission">Admissions Data</h2>
  <div class="admissions">
<div class="view">
  <div class="wrapper">
    <table class="ad_admitable">
      <thead>
        <tr>
          <th class="sticky-col first-col">ID</th>
          <th class="sticky-col second-col">Name</th>
            <th class=" third-col">Email</th>
            <th class=" third-col" >Father Name</th>
            <th class=" third-col" >Age</th>
            <th class=" third-col" >DOB</th>
            <th class=" third-col" >Mobile</th>
            <th class=" third-col" >Hometell</th>
            <th class=" third-col" >Guardian<br>Name</th>
            <th class=" third-col" >Guardian<br> Job</th>
            <th class=" third-col" >Address</th>
            <th class=" third-col" >Applicant<br>CNIC</th>
            <th class=" third-col" >Guardian <br>CNIC</th>
            <th class=" third-col" >Date</th>
            <th class=" third-col" >City</th>
            <th class=" third-col" >Previous<br>Education</th>
            <th class=" third-col" >Marks</th>
            <th class=" third-col" >Previous<br>Madrassa<br>Attended</th>
            <th class=" third-col" >Course</th>
            <th class=" third-col" >Session</th>
            <th class=" third-col">Gender</th>
          <!-- Other header columns here -->
        </tr>
      </thead>
      <tbody>
        <?php
        $user_query = 'SELECT * FROM admission';
        $user_result = mysqli_query($conn, $user_query);
        while ($users = mysqli_fetch_object($user_result)) {
        ?>
        <tr>
          <td ><?=$users->id?></td>
          <td ><?=$users->name?></td>
          <td ><?=$users->email?></td>
   <td ><?=$users->fathername?></td>
   <td ><?=$users->age?></td>
   <td ><?=$users->dob?></td>
   <td><?=$users->mobile?></td>
   <td><?=$users->hometel?></td>
   <td><?=$users->gname?></td>
   <td><?=$users->gjob?></td>
   <td><?=$users->adress?></td>
   <td><?=$users->Acnic?></td>
   <td><?=$users->Gcnic?></td>
   <td><?=$users->date?></td>
   <td><?=$users->city?></td>
   <td><?=$users->predu?></td>
   <td><?=$users->marks?></td>
   <td><?=$users->preM?></td>
   <td><?=$users->course?></td>
   <td><?=$users->session?></td>
   <td><?=$users->gender?></td>
          <!-- Other data columns here -->
        </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
      


<form action="#" method="post" enctype="multipart/form-data">
  <h2>Upload List</h2>
    <input type="file" name="file">
    <input type="submit" value="Upload File" name="submit" class="upload">
</form>

    <?php
    

    
    
    
    if (isset($_POST['submit'])) {
      $filename = $_FILES['file']['name'];
      $filedata = addslashes(file_get_contents($_FILES['file']['tmp_name']));
     
      $query = "INSERT INTO list (filename, filedata) VALUES ('$filename', '$filedata')";
  
      if ($conn->query($query) === TRUE) {
          echo "File uploaded successfully.";
      } else {
          echo "Error uploading file: " . $conn->error;
      }
  }
    ?>
    
    
    </div>

        <!--===== MAIN JS =====-->
        <script src="./js/dashboard.js"></script>
       
   
