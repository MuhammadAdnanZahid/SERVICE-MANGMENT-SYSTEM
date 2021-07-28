<?php 
define('TITLE', 'CHANGE PASSWORD');
    include('main_layout/top.php');
    include('main_layout/header.php');

    if($_SESSION['is_login']){

        $rEmail = $_SESSION['rEmail'];
    } else{
        echo "<script> location.href='rlogin.php'<script>";
    } 

    $sql = "SELECT r_password, r_email FROM requster_login WHERE r_email = '$rEmail'";
    $res = $conn->query($sql);
    if($res->num_rows == 1){
        $row = $res->fetch_assoc();
        $rPassword = $row['r_password'];
    }

    if(isset($_REQUEST['passupdate'])){
        if($_REQUEST['r_password']== ""){
            $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Password Field is required</div>';      
        }
        else{
            $rPassword = $_REQUEST['r_password'];
            $sql ="UPDATE requster_login SET r_password = '$rPassword' WHERE r_email='$rEmail'";
            if($conn->query($sql) == TRUE){
                $msg = '<div class="alert alert-success col-sm-6 mt-2 ml-5" role="alert">Password Update Successfully</div>';
            } else{
                $msg = '<div class="alert alert-danger col-sm-6 mt-2 ml-5" role="alert">Unable to Update</div>';

            }
        }
    }
?>

<div class="col-sm-6 col-md-8 mt-5">
    <form action="" method="POST" class="mx-5 p-4 shadow-lg">
        <div class="form-group">
            <label for="inputEmail">Email</label><input class="form-control" type="email" name="rEmail" id="rEmail" value="<?php echo $rEmail ?>" readonly>
                    
            </div>
            <div class="form-group">
            <label for="rName">New Password</label><input class="form-control" type="text" name="r_password" id="r_password">
            </div>
            <button name="passupdate" type="submit"  class="btn btn-danger">Update</button>
            <?php if(isset($msg)) { echo $msg; } ?>
          </div>  
    </form>

</div> 

<?php include('main_layout/footer.php')?>