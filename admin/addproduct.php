<?php
define('TITLE', 'Add product');
define('PAGE', 'assets');
include('main_layout/top.php');
include('main_layout/header.php');

if(isset($_SESSION['is_adminlogin'])){
    $aEmail = $_SESSION['aEmail'];
}else{
    echo "<script> location.href = 'login.php'</script>";
}

if(isset($_REQUEST['prosubmit'])){
 //  Checking Empty Fields
 if(($_REQUEST['product_name'] == "") || ($_REQUEST['product_op'] == "") || ($_REQUEST['product_dop'] == "") ){
    $msg = '<div class="alert alert-warning mb-2 mt-5" role="alert">All Feilds are Required</div';
}else{

       // Assigning User's Values to Variables
       $product_name = $_REQUEST['product_name'];
       $product_dop = $_REQUEST['product_dop'];
       $product_ava = $_REQUEST['product_ava'];
       $product_total = $_REQUEST['product_total'];
       $product_op = $_REQUEST['product_op'];
       $product_sp = $_REQUEST['product_sp'];

       $sql = "INSERT INTO assets(product_name, product_dop, product_ava, product_total,product_op,product_sp) VALUES('$product_name','$product_dop','$product_ava','$product_total','$product_op','$product_sp')";
       $conn->query($sql);
       if($conn){
         $msg = '<div class="alert alert-success mt-5" role="alert">Successfully Registered</div';
       } else{
         $msg = '<div class="alert alert-success mt-5" role="alert">Insert UnSuccessful</div';
       }

     
       
 }
}
?>

<div class="col-sm-6 mt-5 mx-3 jumbotron">
<h3 class="text-center">Add Product</h3>
    <form action="" method="POST">
    <div class="form-group">
    <label for="name" class="font-weight-bold pl-2">Product Name</label>
    <input type="text" class="form-control" name="product_name">
    </div>
    <div class="form-group">
    <label for="email" class="font-weight-bold pl-2">Date of Purchase</label>
    <input type="date" class="form-control"  name="product_dop">
    </div>
    <div class="form-group">
    <label for="name" class="font-weight-bold pl-2">Available Product</label>
    <input type="text" class="form-control" name="product_ava" id="product_ava">
    </div>
    <div class="form-group">
    <label for="Address" class="font-weight-bold pl-2">Total Product</label>
    <input type="text" class="form-control" name="product_total">
   </div>
   <div class="form-group">
    </i><label for="City" class="font-weight-bold pl-2">Orignal Price</label>
    <input type="text" class="form-control" name="product_op">
   </div>
   <div class="form-group">
    </i><label for="City" class="font-weight-bold pl-2">Selling Price</label>
    <input type="text" class="form-control" name="product_sp">
   </div>

   <button type="submit" class="btn btn-danger" name="prosubmit" id="empsubmit">Submit</button>
   <a href="assets.php" class="btn btn-secondary">Close</a>
   </form>
   </div>
        <div class="col-sm-3">
        <?php if(isset($msg)) { echo $msg; }?> 
        </div>


<?php
include('main_layout/footer.php');
?>