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

if(isset($_REQUEST['empsubmit'])){
 //  Checking Empty Fields
 if(($_REQUEST['empName'] == "") || ($_REQUEST['empEmail'] == "") || ($_REQUEST['empMobile'] == "") ){
    $msg = '<div class="alert alert-warning mb-2" role="alert">All Feilds are Required</div';
}else{

 // Email Already registred
   $sql = "SELECT emp_email From requster_login WHERE emp_email ='".$_REQUEST['empEmail']."'";
   $res = $conn->query($sql);
   if($res->num_rows==1){
     $msg = '<div class="alert alert-danger mb-2" role="alert">Email Already Registered</div';
   } 
     else{
       // Assigning User's Values to Variables
       $empName = $_REQUEST['empName'];
       $empEmail = $_REQUEST['empEmail'];
       $empMobile = $_REQUEST['empMobile'];
       $empAddress = $_REQUEST['empAddress'];
       $empCity = $_REQUEST['empCity'];

       $sql = "INSERT INTO technician_emp(emp_name, emp_email, emp_mobile, emp_address,emp_city) VALUES('$empName','$empEmail','$empMobile','$empAddress','$empCity')";
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
<h3 class="text-center">Add New Technician</h3>
    <form action="" method="POST">
    <div class="form-group">
    <label for="name" class="font-weight-bold pl-2">Name</label>
    <input type="text" class="form-control" name="empName">
    </div>
    <div class="form-group">
    <label for="email" class="font-weight-bold pl-2">Email</label>
    <input type="email" class="form-control"  name="empEmail">
    <small class="form-text">We'll never share your email with anyon else.</small>
    </div>
    <div class="form-group">
    <label for="name" class="font-weight-bold pl-2">Mobile Number</label>
    <input type="text" class="form-control" placeholder="e g:03481234567" name="empMobile" id="empMobile">
    </div>
    <div class="form-group">
    <label for="Address" class="font-weight-bold pl-2">Address</label>
    <input type="text" class="form-control" name="empAddress">
   </div>
   <div class="form-group">
    </i><label for="City" class="font-weight-bold pl-2">City</label>
    <input type="text" class="form-control" name="empCity">
   </div>

   <button type="submit" class="btn btn-danger" name="empsubmit" id="empsubmit">Submit</button>
   <a href="technician.php" class="btn btn-secondary">Close</a>
   <?php if(isset($msg)) { echo $msg; }?> 
   </form>
   </div>



<?php
include('main_layout/footer.php');
?>