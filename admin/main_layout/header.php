
    <!-- Start Navigation  -->
     
    <nav class="navbar flex-md-nowrap navbar-dark fixed-top bg-danger p-0 shadow">
    <a href="rprofile.php" class="navbar-brand col-sm-3 col-md-2 mr-0">ADMIN</a>
    </nav> <!-- End Nav -->

     <!-- ============SIDE BAR ================= -->


     <div class="container-fluid " style="margin-top:40px;">
         <div class="row">
         
        <nav class="col-sm-2 bg-light sidebar py-4 mt-3 d-print-none" style="height: 78vh">
          <div class="sidebar-sticky">
              <ul class="nav flex-column">
                <li class="nav-item mb-2"><a class="nav-link <?PHP if(PAGE == 'dashboard' ){echo 'active';}?>" href="dashboard.php"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
                <li class="nav-item mb-2"><a href="work.php" class="nav-link <?PHP if(PAGE == 'work' ){echo 'active';}?>"> <i class="far fa-handshake mr-2 "></i>Work Order</a></li>
                <li class="nav-item mb-2"><a href="request.php" class="nav-link <?PHP if(PAGE == 'request' ){echo 'active';}?>"> <i class="fas fa-book center mr-2"></i>Requests</a></li>
                <li class="nav-item mb-2"><a href="assets.php" class="nav-link <?PHP if(PAGE == 'assets' ){echo 'active';}?>"> <i class="fa fa-database mr-2"></i>Assets</a></li>
                <li class="nav-item mb-2"><a href="technician.php" class="nav-link <?PHP if(PAGE == 'technician' ){echo 'active';}?>"> <i class="fas fa-headset center mr-2"></i>Technicians</a></li>
                <li class="nav-item mb-2"><a href="requester.php" class="nav-link <?PHP if(PAGE == 'requester' ){echo 'active';}?>"> <i class="fa fa-users center mr-2"></i>Requester</a></li>
                <li class="nav-item mb-2"><a href="sellreport.php" class="nav-link <?PHP if(PAGE == 'sellreport' ){echo 'active';}?>"> <i class="fas fa-table center mr-2"></i>Sell Repoart</a></li>
                <li class="nav-item mb-2"><a href="workreport.php" class="nav-link <?PHP if(PAGE == 'workreport' ){echo 'active';}?>"> <i class="fa fa-clipboard center mr-2"></i>Work Report</a></li>
                <li class="nav-item mb-2"><a href="changepass.php" class="nav-link <?PHP if(PAGE == 'changepass' ){echo 'active';}?>"> <i class="fas fa-key center mr-2"></i>Change Password</a></li>
                <li class="nav-item mb-2"><a href="logout.php" class="nav-link"> <i class="fas fa-sign-out-alt mr-2"></i>Logout</a></li>
              </ul>
          </div>
        </nav>  <!-- End Side Bar -->
      
     
    <!-- ============SIDE BAR ================= -->
    
    
    <!-- End Navigation  -->
    