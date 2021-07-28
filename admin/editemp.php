<?php
define('TITLE', 'Update Requester');
define('PAGE', 'editreq');
include('main_layout/top.php');
include('main_layout/header.php');

if(isset($_SESSION['is_adminlogin'])){
    $aEmail = $_SESSION['aEmail'];
}else{
    echo "<script> location.href = 'login.php'</script>";
}
?>
<div class="col-sm-6 jumbotron mx-3 mt-5">
    <h3 class="text-center">Update Technician Details</h3>
    <?php
        if(isset($_REQUEST['empedit'])){
            $kry= "SELECT * FROM technician_emp WHERE emp_id = {$_REQUEST['eid']}";
            $res = $conn->query($kry);
            $res = $res->fetch_assoc();
        }

        if(isset($_REQUEST['empupdate'])){
            $empid = $_REQUEST['emp_id'];
            $empname = $_REQUEST['emp_name'];
            $empemail = $_REQUEST['emp_email'];
            $empmobile = $_REQUEST['emp_mobile'];
            $empaddress = $_REQUEST['emp_address'];
            $empcity = $_REQUEST['emp_city'];
        $kry= "UPDATE technician_emp SET emp_name = '$empname', emp_email = '$empemail', emp_mobile = '$empmobile',emp_address= '$empaddress', emp_city ='$empcity' WHERE emp_id = '$empid'";
        $res = $conn->query($kry);
            if($res){
                $msg ='<div class="alert alert-success col-sm-12 ml-5 mt-5" role="alert">Update Successfully</div>';
            }else{
                $msg ='<div class="alert alert-danger col-sm-12 ml-5 mt-5" role="alert">Can not Update</div>';
            }
        }
    ?>
    <form action="" method="POST">
        <div class="form-group">
            <label for="r_id">Technician Id :</label>
            <input type="text" class="form-control" name="emp_id" id="emp_id" readonly value="<?php if(isset($res['emp_id'])) { echo $res['emp_id']; } ?>">
        </div>
        <div class="form-group">
            <label for="r_name">Name :</label>
            <input type="text" class="form-control" name="emp_name" id="emp_name" value="<?php if(isset($res['emp_name'])) { echo $res['emp_name']; } ?>" required>
        </div>
        <div class="form-group">
            <label for="r_email">Email :</label>
            <input type="text" class="form-control" name="emp_email" id="emp_email" value="<?php if(isset($res['emp_email'])) { echo $res['emp_email']; } ?>" required>
        </div>
        <div class="form-group">
            <label for="r_mobile">Mobile Number :</label>
            <input type="text" class="form-control" name="emp_mobile" id="emp_mobile" value="<?php if(isset($res['emp_mobile'])) { echo $res['emp_mobile']; } ?>" required>
        </div>
        <div class="form-group">
            <label for="r_mobile">Address :</label>
            <input type="text" class="form-control" name="emp_address" id="emp_address" value="<?php if(isset($res['emp_address'])) { echo $res['emp_address']; } ?>" required>
        </div>
        <div class="form-group">
            <label for="r_mobile">City :</label>
            <input type="text" class="form-control" name="emp_city" id="emp_city" value="<?php if(isset($res['emp_city'])) { echo $res['emp_city']; } ?>" required>
        </div>
        <div class="text-center">
            <button class="btn btn-danger" name="empupdate" id="empupdate">Update</button>
            <a href="technician.php" class="btn btn-secondary">Close</a>
        </div>
        
    </form>
</div>
<div class="col-md-3">
    <?php if(isset($msg)){ echo $msg ;}?>
    </div>


<?php
include('main_layout/footer.php');
?>