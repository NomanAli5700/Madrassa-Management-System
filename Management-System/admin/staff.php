
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
<h2 class="ad_staff">Staff_Registeration _Data</h2>
  <div class="staff">
<div class="view">
  <div class="wrapper">
    <table class="ad_stafftable">
      <thead>
        <tr>
          <th class="sticky-col first-col">ID</th>
          <th class="sticky-col second-col">Name</th>
            <th class=" third-col">Email</th>
            <th class=" third-col" >Age</th>
            
           
            <th class=" third-col" >Contact</th>
            
            <th class=" third-col" >Address</th>
            <th class=" third-col" >Qualification</th>

            <th class=" third-col" >Date</th>
            <th class=" third-col" >City</th>
           
            <th class=" third-col" >Previous<br>Madrassa<br>visited</th>
            <th class=" third-col" >Class</th>
            <th class=" third-col" >Session</th>
            <th class=" third-col">Gender</th>
          <!-- Other header columns here -->
        </tr>
      </thead>
      <tbody>
        <?php
        $user_query = 'SELECT * FROM staff';
        $user_result = mysqli_query($conn, $user_query);
        while ($users = mysqli_fetch_object($user_result)) {
        ?>
        <tr>
          <td ><?=$users->id?></td>
          <td ><?=$users->name?></td>
          <td ><?=$users->email?></td>
 
   <td ><?=$users->age?></td>
  
   <td><?=$users->contact?></td>
   
   <td><?=$users->address?></td>
   <td><?=$users->qualification?></td>
   
   <td><?=$users->date?></td>
   <td><?=$users->city?></td>
  
   <td><?=$users->madrassa_visited?></td>
   <td><?=$users->class?></td>
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
      
<br><br>


    
    </div>

        <!--===== MAIN JS =====-->
        <script src="./js/dashboard.js"></script>
       
   
