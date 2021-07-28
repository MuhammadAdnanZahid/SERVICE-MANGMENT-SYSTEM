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
    <h3 class="text-center">Update Requester Details</h3>
    <?php
        if(isset($_REQUEST['edit'])){
            $kry= "SELECT * FROM requster_login WHERE r_id = {$_REQUEST['id']}";
            $res = $conn->query($kry);
            $row = $res->fetch_assoc();
        }

        if(isset($_REQUEST['update'])){
            $rid = $_REQUEST['r_id'];
            $rname = $_REQUEST['r_name'];
            $remail = $_REQUEST['r_email'];
            $rmobile = $_REQUEST['r_mobile'];
        $kry= "UPDATE requster_login SET r_id = '$rid', r_name = '$rname', r_email = '$remail', r_mobile = '$rmobile' WHERE r_id = '$rid'";
        $res = $conn->query($kry);
            if($res){
                $msg ='<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Update Successfully</div>';
            }else{
                $msg ='<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Can not Update</div>';
            }
        }
    ?>
    <form action="" method="POST">
        <div class="form-group">
            <label for="r_id">Requster Id :</label>
            <input type="text" class="form-control" name="r_id" id="r_id" readonly value="<?php if(isset($row['r_id'])) { echo $row['r_id']; } ?>">
        </div>
        <div class="form-group">
            <label for="r_name">Name :</label>
            <input type="text" class="form-control" name="r_name" id="r_name" value="<?php if(isset($row['r_name'])) { echo $row['r_name']; } ?>" required>
        </div>
        <div class="form-group">
            <label for="r_email">Email :</label>
            <input type="text" class="form-control" name="r_email" id="r_email" value="<?php if(isset($row['r_email'])) { echo $row['r_email']; } ?>" required>
        </div>
        <div class="form-group">
            <label for="r_mobile">Mobile Number :</label>
            <input type="text" class="form-control" name="r_mobile" id="r_mobile" value="<?php if(isset($row['r_mobile'])) { echo $row['r_mobile']; } ?>" required>
        </div>
        <div class="text-center">
            <button class="btn btn-danger" name="update" id="update">Update</button>
            <a href="requester.php" class="btn btn-secondary">Close</a>
        </div>
        <?php if(isset($msg)){ echo $msg ;}?>
    </form>

</div>


<?php
include('main_layout/footer.php');
?>