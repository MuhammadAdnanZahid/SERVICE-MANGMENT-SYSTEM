<?php
 if(isset($_REQUEST['rSignup'])){
  //  Checking Empty Fields
   if(($_REQUEST['rName'] == "") || ($_REQUEST['rEmail'] == "") || ($_REQUEST['rPassword'] == "") ){
       $msg = '<div class="alert alert-warning mb-2" role="alert">All Feilds are Required</div';
   }else{

    // Email Already registred
      $sql = "SELECT r_email From requster_login WHERE r_email ='".$_REQUEST['rEmail']."'";
      $res = $conn->query($sql);
      if($res->num_rows==1){
        $msg = '<div class="alert alert-danger mb-2" role="alert">Email Already Registered</div';
      } 
        else{
          // Assigning User's Values to Variables
          $rName = $_REQUEST['rName'];
          $rEmail = $_REQUEST['rEmail'];
          $rMobile = $_REQUEST['r_mobile'];
          $rPassword = $_REQUEST['rPassword'];

          $sql = "INSERT INTO requster_login(r_name, r_email, r_mobile, r_password) VALUES('$rName','$rEmail','$rMobile','$rPassword')";
          $conn->query($sql);
          if($conn){
            $msg = '<div class="alert alert-success mb-2" role="alert">Successfully Registered</div';
          } else{
            $msg = '<div class="alert alert-success mb-2" role="alert">Connection Error</div';
          }

        }
          
    }
     
    }
    
?>

<!-- Registration Form Container -->
<div class="container pt-5" id="Registration">
    <h2 class="text-center">Create an Account</h2>
    <div class="row mt-4 mb-4">
    <div class="col-md-6 offset-md-3">
    <form action="" method="POST" class="shadow-lg p-4">
    <div class="form-group">
    <i class="fas fa-user"></i><label for="name" class="font-weight-bold pl-2">Name</label>
    <input type="text" class="form-control" placeholder="Name" name="rName">
    </div>
    <div class="form-group">
    <i class="fas fa-envelope"></i><label for="email" class="font-weight-bold pl-2">Email</label>
    <input type="email" class="form-control" placeholder="Email" name="rEmail">
    <small class="form-text">We'll never share your email with anyon else.</small>
    </div>
    <div class="form-group">
    <i class="fas fa-phone"></i><label for="name" class="font-weight-bold pl-2">Mobile Number</label>
    <input type="text" class="form-control" placeholder="03481234567" name="r_mobile" id="r_mobile">
    </div>
    <div class="form-group">
    <i class="fas fa-key"></i><label for="password" class="font-weight-bold pl-2">Password</label>
    <input type="password" class="form-control" placeholder="Password" name="rPassword">
   </div>

   <button type="submit" class="btn btn-danger mt-5 btn-block shadow-sm font-weight-bold" name="rSignup">Sign UP</button>
   <em style="font-size: 10px;"> Note - By clicking Sign Up, You agree to our Terms, Data Policy and cookie Policy</em>
   <?php if(isset($msg)) { echo $msg; }?> 
   </form>
   </div>
   </div>

   </div> <!-- End Registration Form Container -->