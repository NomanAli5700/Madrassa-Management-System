
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
  
    $record = mysqli_query($conn, "SELECT * FROM admin WHERE id =$id");
   
$data = mysqli_fetch_array($record);
      $id = $data['id'];
     
      $EmailID = $data['email'];
      $password = $data['password'];
     

      
  }
?>




     
         


         
       
   
   
  <?php if (isset($_SESSION['message'])):?>
    <div class="message">
      <?php 
      echo $_SESSION['message']; 
      unset($_SESSION['message']); 
      ?>
   </div>
  <?php endif ?>
  
        <?php if(isset($_GET['action'])   )  {?>
        
          
           
                        
                        
                         
                       
        
         
         <br>
        <h2 class="regist">Create Admin Login</h2>
        <div class="ad_adminbody">
       <form  class="ad_adminform" action="../manage/manage-accounts.php"  method="POST">
      
                       
                          <input type="hidden" name="id" placeholder="id" value="<?php echo $id; ?>">
                          
                          
                          <label>Email</label>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="email"  class="form-control" placeholder="Email Address" name="email" value="<?php echo $EmailID; ?>">
                         
                         <br><br>
                         
                          <label>Password</label>
                          <input type="text"  class="form-control" placeholder="password" name="password" value="<?php echo $password; ?>">
                         
                         
                          
                         
                          
                       
                        <input type="hidden" name="type" value="<?php echo $_REQUEST['user'] ?>"><br><br>

                        <?php if ($edit_state == false) { ?>
                          
                        <button type="submit" name="submit1" class="btn">Register</button>
                        <?php } else { ?>
                       <button class="btn" type="submit" name="update" >Update</button>
                        <?php } ?>
                        <a href="../admin/admin.php?user=admin" class="back">Back</a>
                       
                        
            </form>
                        </div>
                       
        <?php  } else {?>
            <h2 class="ad_admin">Administration</h2>
       <br>
       
        <!-- Info boxes -->
        <div class="ad_admincard">
       
            <div >
             <a href="#">Enroll</a>
             <?php echo ucfirst($_REQUEST['user'])?>
         
        <a href="../admin/admin.php?user=<?php echo $_REQUEST['user'] ?>&action=add-new" class="add">Add New</a><br><br>
        </div>
          
        <table class="ad_admintable">
            <thead>
              <tr>
                <th>S.No.</th>
               
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
             
              <?php
              
             

             $user_query = 'SELECT * FROM admin  ';
             
              $user_result = mysqli_query($conn , $user_query);
              while ($users = mysqli_fetch_object($user_result)) 
              {  

                ?>
              <tr>
                <td><?=$users->id?></td>
               
                <td><?=$users->email?></td> 
                 
      <td><a href="../admin/admin.php?edit=<?=$users->id?>&action=update" class="edit_btn"><i class='bx bxs-edit'></i></a>
    
    <a href="../manage/manage-accounts.php?delete=<?=$users->id?>" class="del_btn"><i class='bx bxs-trash'></i></a></td>
              </tr>
              <?php } ?>
              
    
     
            </tbody>
          </table>
          
        </div>
        <!-- /.row -->
        <?php } ?>
      </div><!--/. container-fluid -->
    </section>


        <!--===== MAIN JS =====-->
        <script src="./js/dashboard.js"></script>
       
   
