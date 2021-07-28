
   <?php
   define('TITLE', 'ADMIN LOGIN');
   include('main_layout/top.php');
   session_start();
   if(!isset($_SESSION['is_login'])){
  
      if(isset($_REQUEST['admin_email'])){
            $aEmail = mysqli_real_escape_string($conn,trim($_REQUEST['admin_email']));
            $aPassword = mysqli_real_escape_string($conn,trim($_REQUEST['admin_password']));

            $sql ="SELECT admin_email, admin_password FROM admin_login WHERE admin_email = '".$aEmail."' AND admin_password = '".$aPassword."' limit 1";
            $res = $conn->query($sql);
            if($res->num_rows == 1){
               $_SESSION['is_adminlogin'] = true;
               $_SESSION['aEmail'] = $aEmail;
            echo "<script>location.href='dashboard.php';</script>";
               exit;
            }else{
               $msg = '<div class="alert alert-warning mt-2" role="alert">Enter Valid Email or Password</div>';
            }
         }
          
   }else{
      echo "<script>location.href='login.php';</script>";
   }
   ?>

   <div class="mt-5 mb-3 text-center" style="font-size:30px;">
   <i class="fas fa-stethoscope"></i>
   <span>Online Service Managment System</span> 
   </div> 

   <p class="text-center  m-4" style="font-size:20px"><i class="fas fa-user-secret text-danger"></i> ADMIN Area </p>
   
   <div class="container-fluid">
      <div class="row justify-content-center mt-4">
         <div class="col-sm-6 col-md-4">
           <form action="" method="POST" class="shadow-lg p-4">
              <div class="form-group">
                <i class="fas fa-envelope"></i><label for="email" class="font-weight-bold pl-2">Emali</label>
                <input type="email" class="form-control" placeholder="Email" name="admin_email" ></input>
                <small class="form-text">We will not share your information</small>
              </div>
               <div class="form-group">
               <i class="fas fa-key"></i><label for="pass" class="font-weight-bold pl-2">Password</label>
               <input type="password" class="form-control" placeholder="Password" name="admin_password">
               </div>
               <button class="btn btn-outline-danger mt-4 font-weight-bold btn-block shadow-sm">Login</button>
               <?php if(isset($msg)) { echo $msg; }?>
           </form>
           <div class="text-center"><a class="btn btn-info mt-4 font-weight-bold shadow-sm" href="../index">Back to Home</a></div>
         </div>
      </div>
   </div>
<?php
   include('main_layout/footer.php');
   ?>