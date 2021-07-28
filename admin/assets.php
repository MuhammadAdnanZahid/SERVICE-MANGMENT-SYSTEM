<?php
define('TITLE', 'Inventory');
define('PAGE', 'assets');
include('main_layout/top.php');
include('main_layout/header.php');

if(isset($_SESSION['is_adminlogin'])){
    $aEmail = $_SESSION['aEmail'];
}else{
    echo "<script> location.href = 'login.php'</script>";
}
?>
<!--Start 2nd Column -->
<div class="col-sm-9 col md-10 mt-5 text-center">
<div class="float-right mr-1"><a href="addproduct.php" class="btn btn-danger"><i class="fas fa-plus fa-1x"></i></a></div>
    <p class="bg-dark text-white p-2">List of Product </p>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">product ID</th>
                <th scope="col">Product Name</th>
                <th scope="col">Date of Purchase</th>
                <th scope="col">Available Product</th>
                <th scope="col">Total Product</th>
                <th scope="col">Orignal Price</th>
                <th scope="col">Selling Price</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $kry = "SELECT * FROM assets";
        $res = $conn->query($kry);
        if($res->num_rows> 0){
            while($row = $res->fetch_assoc()){
               echo '<tr>
                 <td>'.$row['product_id'].'</td>
                 <td>'.$row['product_name'].'</td>
                 <td>'.$row['product_dop'].'</td>
                 <td>'.$row['product_ava'].'</td>
                 <td>'.$row['product_total'].'</td>
                 <td>'.$row['product_op'].'</td>
                 <td>'.$row['product_sp'].'</td>
                 <td> 
                 <form action="editproduct.php" class="d-inline mr-2" method="POST">
                 <input type ="hidden" name="pid" value='.$row['product_id'].'>
                 <button class="btn btn-info" name="proedit" value="proedit" type="submit"><i class="fas fa-pen"></i></button>
                 </form>
                 <form action="" class="d-inline mr-2" method="POST">
                 <input type ="hidden" name="pid" value='.$row['product_id'].'>
                 <button class="btn btn-danger" name="delete" value="Delete" type="submit"><i class="far fa-trash-alt"></i></button>
                 </form>
                 <form action="sellproduct.php" class="d-inline mr-2" method="POST">
                 <input type ="hidden" name="proid" value='.$row['product_id'].'>
                 <button class="btn btn-warning" name="issue" value="issue" type="submit"><i class="fas fa-handshake"></i></button>
                 </form>
                 </td>
                
               ';


            } }
            else{
                echo 'No records in database';
            }
            if(isset($_REQUEST['delete'])){
                $sql = "DELETE FROM assets WHERE product_id = {$_REQUEST['id']}";
                if($conn->query($sql) == true){
                    echo'<meta http-equiv="refresh" content="0;URL=?deleted"/>';
                }
            }
    ?>
        </tbody>
    </table>
</div>




<?php
include('main_layout/footer.php');
?>