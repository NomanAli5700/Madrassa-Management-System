<div class="l-navbar" id="nav-bar">

       <nav class="nav">
      <div>
          <a href="#" class="nav__logo">
              <i class='bx bx-layer nav__logo-icon bx-sm'></i>
              <span class="nav__logo-name">MMS</span>
          </a>
      <div class="nav__list">
              <a href="<?=$site_url?>admin/dashboard.php" class="nav__link ">
                  <i class='bx bx-grid-alt  bx-sm' ></i>
                  <span class="nav__name">Dashboard  </span>
              </a>
             
              <div class="nav__enrollment" onclick="toggleEnrollment()">
                    <i class='bx bx-group bx-sm'></i>
                    <span class="nav__name">Enrollment <i class='bx bx-chevron-down bx-sm nav__enrollment-icon'></i></span>
                   
               </div>
              <div class="nav__enrollment-items">
                    <a href="<?=$site_url?>admin/teacher.php?user=teacher" class="nav-link nav__link">
                        <i class='bx bxs-user-detail bx-sm'></i>
                        <span class="nav__name">Teachers</span>
                    </a>
                    <a href="<?=$site_url?>admin/student.php?user=student" class="nav-link nav__link">
                        <i class='bx bxs-user-plus bx-sm'></i>
                        <span class="nav__name">Students</span>
                    </a>
                    <a href="<?=$site_url?>admin/admin.php?user=admin" class="nav-link nav__link">
                    <i class="fas fa-users"></i>
                        <span class="nav__name">Admin</span>
                    </a>
              </div>
             
   
  
           
              
              
              <a href="<?=$site_url?>admin/courses.php" class="nav__link ">
              <i class="fas fa-book-open"></i>
                  <span class="nav__name">Subject</span>
              </a>
              
              
               <a href="<?=$site_url?>admin/class.php" class="nav__link ">
               <i class='bx bxs-chalkboard bx-sm' ></i>
                  <span class="nav__name">Course</span>
              </a>
              
              <a href="<?=$site_url?>admin/Library.php" class="nav__link ">
              <i class='bx bx-book-add bx-sm'></i>
                  <span class="nav__name">Library</span>
              </a>
             
              <a href="<?=$site_url?>admin/timetable.php" class="nav__link ">
              <i class="fas fa-clock "></i>
                  <span class="nav__name">TimeTable</span>
              </a>
             

             
             
             
             
       
    
      
     
              
               
 
    
  
      </div>
   



 
              <a href="../admin/logout.php" class="nav__link ">
          <i class='bx bx-log-out bx-sm' ></i>
          <span class="nav__name">Log Out</span>
          </a>
          </div>
      </div>
      
  </nav>
</div>
        
<script>
   function toggleEnrollment() {
        document.body.classList.toggle("show-enrollment");
    }
</script>