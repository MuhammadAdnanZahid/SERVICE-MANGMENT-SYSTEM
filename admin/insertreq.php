<?php
define('TITLE', 'Requester');
define('PAGE', 'requester');
include('main_layout/top.php');
include('main_layout/header.php');

if(isset($_SESSION['is_adminlogin'])){
    $aEmail = $_SESSION['aEmail'];
}else{
    echo "<script> location.href = 'login.php'</script>";
}

if(isset($_REQUEST['rsubmit'])){
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
       $rMobile = $_REQUEST['rMobile'];
       $rPassword = $_REQUEST['rPassword'];

       $sql = "INSERT INTO requster_login(r_name, r_email, r_mobile, r_password) VALUES('$rName','$rEmail','$rMobile','$rPassword')";
       $conn->query($sql);
       if($conn){
         $msg = '<div class="alert alert-success my-2" role="alert">Successfully Registered</div';
       } else{
         $msg = '<div class="alert alert-success my-2" role="alert">Insert UnSuccessful</div';
       }

     }
       
 }
}
?>

<div class="col-sm-6 mt-5 mx-3 jumbotron">
<h3 class="text-center">Add New Requester</h3>
    <form action="" method="POST">
    <div class="form-group">
    <i class="fas fa-user"></i><label for="name" class="font-weight-bold pl-2">Name</label>
    <input type="text" class="form-control" name="rName">
    </div>
    <div class="form-group">
    <i class="fas fa-envelope"></i><label for="email" class="font-weight-bold pl-2">Email</label>
    <input type="email" class="form-control"  name="rEmail">
    <small class="form-text">We'll never share your email with anyon else.</small>
    </div>
    <div class="form-group">
    <i class="fas fa-phone"></i><label for="name" class="font-weight-bold pl-2">Mobile Number</label>
    <input type="text" class="form-control" placeholder="e g:03481234567" name="rMobile" id="rMobile">
    </div>
    <div class="form-group">
    <i class="fas fa-key"></i><label for="password" class="font-weight-bold pl-2">Password</label>
    <input type="password" class="form-control" name="rPassword">
   </div>

   <button type="submit" class="btn btn-danger" name="rsubmit" id="rsubmit">Submit</button>
   <a href="requester.php" class="btn btn-secondary">Close</a>
   <?php if(isset($msg)) { echo $msg; }?> 
   </form>
   </div>



<?php
include('main_layout/footer.php');
?>