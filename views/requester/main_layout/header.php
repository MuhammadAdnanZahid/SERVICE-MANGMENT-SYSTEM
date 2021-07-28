
    <!-- Start Navigation  -->
     
    <nav class="navbar flex-md-nowrap navbar-dark fixed-top bg-danger p-0 shadow">
    <a href="rprofile.php" class="navbar-brand col-sm-3 col-md-2 mr-0">SMS</a>
    </nav> <!-- End Nav -->

     <!-- ============SIDE BAR ================= -->


     <div class="container-fluid " style="margin-top:40px;">
         <div class="row">
         
        <nav class="col-sm-2 bg-light sidebar py-5 mt-3  d-print-none" style="height: 75vh">
          <div class="sidebar-sticky">
              <ul class="nav flex-column">
                <li class="nav-item mb-2"><a class="nav-link <?PHP if(PAGE == 'rprofile.php' ){echo 'active';}?>" href="rprofile.php"><i class="fas fa-user mr-2"></i>Profile</a></li>
                <li class="nav-item mb-2"><a href="submitrequest.php" class="nav-link <?PHP if(PAGE == 'submitrequest.php' ){echo 'active';}?>"> <i class="fab fa-accessible-icon mr-2 "></i>Submit Request</a></li>
                <li class="nav-item mb-2"><a href="checkstatus.php" class="nav-link <?PHP if(PAGE == 'checkstatus.php' ){echo 'active';}?>"> <i class="fas fa-align center mr-2"></i>Service Status</a></li>
                <li class="nav-item mb-2"><a href="changepassword.php" class="nav-link <?PHP if(PAGE == 'changepassword.php' ){echo 'active';}?>"> <i class="fas fa-key mr-2"></i>Change Password</a></li>
                <li class="nav-item mb-2"><a href="../logout.php" class="nav-link"> <i class="fas fa-sign-out-alt mr-2"></i>Logout</a></li>
              </ul>
          </div>
        </nav>  <!-- End Side Bar -->
      
     
    <!-- ============SIDE BAR ================= -->
    
    
    <!-- End Navigation  -->
    