
<?php

//session_start();


include ("../includes/config.php");
include ("./header.php");
include ("./sidebar.php");
include ("./footer.php");
error_reporting(0);


?>





<?php
include '../manage/manage-teacher.php';
if (isset($_GET['edit'])) {
 
    $id = $_GET['edit'];
   
    $edit_state = true;
  
    $record = mysqli_query($conn, "SELECT * FROM teachers WHERE teacher_id =$id");
   
$data = mysqli_fetch_array($record);
      $id = $data['teacher_id'];
      $year = $data['year'];
      $name = $data['name'];
      $age = $data['age'];
      $mobile = $data['mobile'];
      $emailID = $data['email'];
      $password = $data['password'];
      $address = $data['address'];
      $contect = $data['contect'];
      $qualification = $data['qualification'];
      $experience = $data['experience'];
      $class = $data['class_id'];
      $date = $data['doa'];

      $record = mysqli_query($conn, "SELECT * FROM classes WHERE class_id =$class");
   
      $data = mysqli_fetch_array($record);
      $class_name = $data['class'];
  }
?>




     
         


         
       
   
    <h2 class="ad_teacher">TEACHER</h2>
  <?php if (isset($_SESSION['message'])):?>
    <div class="message">
      <?php 
      echo $_SESSION['message']; 
      unset($_SESSION['message']); 
      ?>
   </div>
  <?php endif ?>
  
        <?php if(isset($_GET['action'])   )  {?>
        
          
           
                        
                        
                         
                       
        
         
<div class="container">
<h2 class="register">Teacher Enrollment</h2>
<form  class="form-inline" action="../manage/manage-teacher.php"  method="POST">
<div class="form first">
<div class="details personal">
                       
                          <input type="hidden" name="id" placeholder="id" value="<?php echo $id; ?>">
                          <div class="fields">
                          <div class="input-field">
                          <label>FullName</label>
                          <input type="text" class="form-control" placeholder="Full Name" name="name" value="<?php echo $name; ?>">
                          </div>
                          <div class="input-field"> 
                          <label>Contact Number</label>
                          <input type="text" class="form-control" placeholder="Contact Number" name="mobile" value="<?php echo $contect; ?>">
                          </div>
                          <div class="input-field">
                          <label>Email</label>
                          <input type="text"  class="form-control" placeholder="Email Address" name="email"  value="<?php echo $emailID ; ?>">
                          <span style="font-size:15px ;color:red;" class="message"><?php echo $_SESSION['subjectError']; ?></span>
                          <?php unset($_SESSION['subjectError']); ?>
                          </div>
                          <div class="input-field">
                          <label>Password</label>
                          <input type="text"  class="form-control" placeholder="password" name="password" value="<?php echo $password; ?>">
                          </div>
                          <div class="input-field">
                          <label>Address</label>
                          <input type="text" class="form-control" placeholder="Address" name="address" value="<?php echo $address; ?>">
                          </div>
                          
                          <div class="input-field">
                          <label>Qualification</label>
                          <input type="text" class="form-control" placeholder="Qualification" name="qualification" value="<?php echo $qualification; ?>">
                          </div>
                          <div class="input-field">
                          <label>Experience</label>
                          <input type="text" class="form-control" placeholder="experience" name="experience" value="<?php echo $experience; ?>">
                          </div>
                          <div class="input-field">
                          <label>Course</label>
                          <input type="text" class="form-control" placeholder="Course" name="class" value="<?php echo $class_name; ?>">
                          </div>
                          <div class="input-field">
                          <label>Date</label>
                          <input type="date" class="form-control" placeholder="Date" name="doa" value="<?php echo $date; ?>">
                          </div>
                          <div class="input-field">
                          <label>Age</label>
                          <input type="text" class="form-control" placeholder="Age" name="age" value="<?php echo $age; ?>">
                          </div>
                          <div class="input-field">
                          <?php  $editQuery = mysqli_query($conn, "SELECT * FROM teachers WHERE teacher_id='$id'");
                            $editgender = mysqli_fetch_assoc($editQuery);
                              ?>
                              <label for="gender">Gender</label>
                              <select name="gender" id="gender">
                                <option value="">-- Select Gender --</option>
                                <option value="male" <?php echo ($editgender['gender'] === 'male') ? 'selected' : ''; ?>>Male</option>
                                <option value="female" <?php echo ($editgender['gender'] === 'female') ? 'selected' : ''; ?>>Female</option>
                              </select>
                            </div>


                          <div class="inputs-field">
                          <label>Academic Year</label>
                          <input type="text" class="form-control" placeholder="Academic Year" name="year" value="<?php echo $year; ?>">
                          </div>
                          
                         
                          
                       
                        <input type="hidden" name="type" value="<?php echo $_REQUEST['user'] ?>"><br><br>

                        <?php if ($edit_state == false) { ?>
                          <div class="button-field">
                        <button type="submit" name="submit1" >register</button>
                        <?php } else { ?>
                       <button style="margin-left: auto; background-color: green; border-radius: 10px; color: white; padding: 15px; font-size:20px;" type="submit" name="update" >Update</button>
                        <?php } ?>
                       
                        </div>
                        </div>
                        </div>
            </form><br><br>
                        </div>
        <?php  } else {?>
       <br><br>
        <!-- Info boxes -->
        <div class="ad_teachcard">
       
            <div >
             <a href="#">Enroll</a>
             <?php echo ucfirst($_REQUEST['user'])?>
         
        <a href="../admin/teacher.php?user=<?php echo $_REQUEST['user'] ?>&action=add-new" class="add">Add New</a><br><br>
        </div>
          
        <table class="ad_teachtable">
            <thead>
              <tr>
                <th>S.No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
             
              <?php
              
             

             $user_query = 'SELECT * FROM teachers  ';
             
              $user_result = mysqli_query($conn , $user_query);
              while ($users = mysqli_fetch_object($user_result)) 
              {  

                ?>
              <tr>
                <td><?=$users->teacher_id?></td>
                <td><?=$users->name?></td>
                <td><?=$users->email?></td> 
                 
      <td><a href="../admin/teacher.php?edit=<?=$users->teacher_id?>&action=update" class="edit_btn"><i class='bx bxs-edit'></i></a>
    
    <a href="../manage/manage-teacher.php?delete=<?=$users->teacher_id?>" class="del_btn"><i class='bx bxs-trash'></i></a></td>
              </tr>
              <?php } ?>
              
    
     
            </tbody>
          </table>
          
        </div>
        <!-- /.row -->
        <?php } ?>
      </div><!--/. container-fluid -->
    </section>
          

   

     

  <script src="./js/dashboard.js"></script>