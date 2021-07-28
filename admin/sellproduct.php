<?php
define('TITLE', 'Edit product');
define('PAGE', 'assets');
include('main_layout/top.php');
include('main_layout/header.php');

if(isset($_SESSION['is_adminlogin'])){
    $aEmail = $_SESSION['aEmail'];
}else{
    echo "<script> location.href = 'login.php'</script>";
}

if(isset($_REQUEST['productsell'])){
 //  Checking Empty Fields
    if(($_REQUEST['product_name'] == "") || ($_REQUEST['product_sp'] == "") || ($_REQUEST['product_dos'] == "") ){
        $msg = '<div class="alert alert-warning mb-2 mt-5" role="alert">All Feilds are Required</div>';
    } else{

            // Assigning User's Values to Variables
            $product_id = $_REQUEST['product_id'];
            $cus_id = $_REQUEST['cus_id'];
            $cus_name = $_REQUEST['cus_name'];
            $cus_add =$_REQUEST['cus_add'];
            $cus_number =$_REQUEST['cus_number'];
            $product_name = $_REQUEST['product_name'];
            $product_ava = $_REQUEST['product_ava']- $_REQUEST['product_qty'];
            $product_qty = $_REQUEST['product_qty'];
            $total_price = $_REQUEST['product_qty'] * $_REQUEST['product_sp'];
            $product_sp = $_REQUEST['product_sp'];
            $product_dos = $_REQUEST['product_dos'];

            $kry = "INSERT INTO customer_sell(cus_name,cus_add,cus_number,product_name,product_qty,total_price,product_sp,product_dos) VALUES('$cus_name','$cus_add','$cus_number','$product_name',
            '$product_qty','$product_sp','$total_price','$product_dos')";
            $conn->query($kry);
            if($conn){
                $lastdata = mysqli_insert_id($conn);
                $_SESSION['lastid'] = $lastdata;
                echo "<script> location.href ='sellproductslip.php'; </script> ";
            } 
   
       $krry = "UPDATE assets SET product_ava = '$product_ava' Where product_id = '$product_id'";
       $conn->query($krry);
 }
}
?>

<div class="col-sm-9 mt-5 mx-3 jumbotron">
<h3 class="text-center">Update Product Detail</h3>
        <?php
        if(isset($_REQUEST['issue'])){
            $kry = "SELECT * from assets Where product_id ={$_REQUEST['proid']}";
            $res = $conn->query($kry);
            $row = $res->fetch_assoc();
        }


        ?>
    <form action="" method="POST">
    <div class="row">
        <div class="col-sm-5 mt-5 mx-3">
                <div class="form-group">
                <label for="name" class="font-weight-bold pl-2">Customer Name</label>
                <input type="text" class="form-control" name="cus_name">
                </div>
                <div class="form-group">
                <label for="name" class="font-weight-bold pl-2">Customer Address</label>
                <input type="text" class="form-control" name="cus_add">
                </div>
                <div class="form-group">
                <label for="name" class="font-weight-bold pl-2">Customer Number</label>
                <input type="text" class="form-control" name="cus_number">
                </div>
                <div class="form-group">
                <label for="Address" class="font-weight-bold pl-2">Purchasing Qunatity</label>
                <input type="text" class="form-control" name="product_qty" id="product_qty">
            </div>
                <div class="form-group">
                </i><label for="City" class="font-weight-bold pl-2">total Price</label>
                <input type="text" class="form-control" name="total_price" >
            </div>
            <div class="form-group">
                <label for="date" class="font-weight-bold pl-2">Date of Sell</label>
                <input type="date" class="form-control"  name="product_dos">
                </div>
        </div>
        <div class="col-sm-5 mt-5 mx-3">
            <div class="form-group">
            <label for="Product Id" class="font-weight-bold pl-2">Product Id</label>
            <input type="text" class="form-control" name="product_id" value="<?php echo $_REQUEST['proid'] ?>" readonly>
            </div>
            <div class="form-group">
            <label for="name" class="font-weight-bold pl-2">Product Name</label>
            <input type="text" class="form-control" name="product_name" value="<?php echo $row['product_name']?>">
            </div>
            <div class="form-group">
            <label for="name" class="font-weight-bold pl-2">Available Product</label>
            <input type="text" class="form-control" name="product_ava" id="product_ava" value="<?php echo $row['product_ava']?>" readonly>
            </div>
            <div class="form-group">
            </i><label for="City" class="font-weight-bold pl-2">Each Selling Price</label>
            <input type="text" class="form-control" name="product_sp" value="<?php echo $row['product_sp']?>">
            </div>
            <?php if(isset($msg)) { echo $msg; }?> 
        </div>
    </div>
        <button type="submit" class="btn btn-danger" name="productsell" id="productsell">Submit</button>
        <a href="assets.php" class="btn btn-secondary">Close</a>
        </form>
        
</div>

<script>
    funnction total(){
   var l = document.getElementById('product_qty').value;
   var h = document.getElementById('product_sp').value;
   var total = l*h;
   document.getElementById('total_price').value = result;
   }

</script>

<?php
include('main_layout/footer.php');
?>