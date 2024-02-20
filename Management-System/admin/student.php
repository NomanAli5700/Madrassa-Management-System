
<?php

//session_start();


include ("../includes/config.php");
include ("./header.php");
include ("./sidebar.php");
include ("./footer.php");
error_reporting(0);


?>





<?php
include '../manage/manage-student.php';
if (isset($_GET['edit'])) {
 
    $id = $_GET['edit'];
   
    $edit_state = true;
  
    $record = mysqli_query($conn, "SELECT * FROM students WHERE student_id =$id");
   
$data = mysqli_fetch_array($record);
      $id = $data['student_id'];
      $name = $data['name'];
      $age = $data['age'];
      $gender = $data['gender'];
      $year = $data['year'];
      $dob = $data['dob'];
      $mobile = $data['mobile'];
      $email_id = $data['email'];
      $password = $data['password'];
      $adress = $data['address'];
      $fname = $data['father_name'];
      $fmobile = $data['father_mobile'];
      $preclass =$data['previous_class'];
      $Prepercen = $data['previous_percentage'];
      $class = $data['class_id'];
      $doa = $data['doa'];
      
      
      $record = mysqli_query($conn, "SELECT * FROM classes WHERE class_id =$class");
   
      $data = mysqli_fetch_array($record);
      $class_name = $data['class'];
     
  }
?>





<h2 class="ad_student">STUDENT</h2>
  <?php if (isset($_SESSION['message'])):?>
    <div class="message">
      <?php 
      echo $_SESSION['message']; 
      unset($_SESSION['message']); 
      ?>
   </div>
  <?php endif ?>
  <br><br>
  
        <?php if(isset($_GET['action'])   )  {?>
        
          
           
                        
                        
                         
                       
        
         
          <div class="containers">
        <h2 class="registers">Registration</h2>
       <form   action="../manage/manage-student.php"  method="POST">
         <div class="form first">
                <div class="details personal">
                   
                       <input type="hidden" name="id" placeholder="id" value="<?php echo $id; ?>">
                       <div class="fields" >
                        <div class="input-field">
                        <label>FullName</label><input type="text" class="form-control" placeholder="Full Name" name="name" value="<?php echo $name; ?>" >
                        </div>
                        <div class="input-field">
                        <label>DOB</label><input type="date" class="form-control" placeholder="DOB" name="dob" value="<?php echo $dob; ?>">
                        </div>
                        <div class="input-field">
                        <label>Mobile</label><input type="text" class="form-control" placeholder="Mobile" name="mobile" value="<?php echo $mobile; ?>">
                        </div>
                        <div class="input-field">
                        <label>Email</label><input type="email"  class="form-control" placeholder="Email Address" name="email" value="<?php echo $email_id; ?>">
                        <span style="font-size:15px ;color:red;" class="message"><?php echo $_SESSION['subjectError']; ?></span>
                          <?php unset($_SESSION['subjectError']); ?>
                        </div>
                        <div class="input-field">
                       <label>Password</label><input type="text"  class="form-control" placeholder="password" name="password" value="<?php echo $password; ?>">
                        </div>
                        <div class="input-field">
                         <label>Address</label><input type="text" class="form-control" placeholder="Address" name="address" value="<?php echo $adress; ?>">
                        </div>
                        <div class="input-field">
                        <label>FatherName</label><input type="text" class="form-control" placeholder="Father's Name" name="father_name" value="<?php echo $fname; ?>">
                        </div>
                        <div class="input-field">
                        <label>Father_Mobile</label><input type="text" class="form-control" placeholder="Father's Mobile" name="father_mobile" value="<?php echo $fmobile; ?>">
                        </div> 
                        <div class="input-field">
                        <label>Previous_Class</label><input type="text" class="form-control" placeholder="Previous Class" name="previous_class" value="<?php echo $preclass; ?>">
                        </div>
                        <div class="input-field">
                        <label>Percentage</label><input type="text" class="form-control" placeholder="Percentage" name="previous_percentage" value="<?php echo $Prepercen; ?>">
                        </div>
                        <div class="input-field">
                        <label>Admission_Date</label><input type="date" class="form-control" placeholder="Date of Admission" name="doa" value="<?php echo $doa; ?>">
                        </div>
                        <div class="input-field">
                        <label>Academic_Year</label><input type="text" class="form-control" placeholder="Academic Year" name="year" value="<?php echo $year; ?>">
                        </div>
                        <div class="input-field">
                        <label>Course</label><input type="text" class="form-control" placeholder="Course" name="class" value="<?php echo $class_name; ?>">
                        </div>
                        <div class="input-field">
                          <label>Age</label>
                          <input type="text" class="form-control" placeholder="Age" name="age" value="<?php echo $age; ?>">
                          </div>
                          <div class="input-field">
                          <?php  $editQuery = mysqli_query($conn, "SELECT * FROM students WHERE student_id='$id'");
                            $editgender = mysqli_fetch_assoc($editQuery);
                              ?>
                              <label for="gender">Gender</label>
                              <select name="gender" id="gender">
                                <option value="">-- Select Gender --</option>
                                <option value="male" <?php echo ($editgender['gender'] === 'male') ? 'selected' : ''; ?>>Male</option>
                                <option value="female" <?php echo ($editgender['gender'] === 'female') ? 'selected' : ''; ?>>Female</option>
                              </select>
                            </div>
                 
                   <input type="hidden" name="type" value="<?php echo $_REQUEST['user'] ?>">

                        <?php if ($edit_state == false) { ?>
                          <div class="button-field">
                           
                            <button type="submit" name="submit" >register</button>
                            <a href="../admin/student.php?user=student" class="back" >back</a>
                        <?php } else { ?>
                          
                       <button style="margin-left: auto; background-color: green; border-radius: 10px; color: white; padding: 15px; font-size:20px;" type="submit" name="update" >Update</button>
                        
                        <?php } ?>
                       
                    
                      
                        </div>
                        </div>
                        </div>
                        
            </form>
                       
                        </div>
        <?php  } else {?>
       
        
       
        <div class="ad_stucard">
        <div >
             <a href="#">Enroll</a>
             <?php echo ucfirst($_REQUEST['user'])?>
       
        <a href="../admin/student.php?user=<?php echo $_REQUEST['user'] ?>&action=add-new" class="add">Add New</a>
        </div>
        <br><br>
        <table class="ad_stutable">
           
              <tr>
                <th>S.No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
           
            <tbody>
             
              <?php
              
             

             $user_query = 'SELECT * FROM students  ';
             
              $user_result = mysqli_query($conn , $user_query);
              while ($users = mysqli_fetch_object($user_result)) 
              {  

                ?>
              <tr>
                <td><?=$users->student_id?></td>
                <td><?=$users->name?></td>
                <td><?=$users->email?></td> 
                 
      <td><a href="../admin/student.php?edit=<?=$users->student_id?>&action=update" class="edit_btn"><i class='bx bxs-edit'></i></a>
    
    <a href="../manage/manage-student.php?delete=<?=$users->student_id?>" class="del_btn"><i class='bx bxs-trash'></i></a></td>
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