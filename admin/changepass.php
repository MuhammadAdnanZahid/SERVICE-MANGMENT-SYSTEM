<?php
define('TITLE', 'Change Password');
define('PAGE', 'changepass');
include('main_layout/top.php');
include('main_layout/header.php');

    if($_SESSION['is_adminlogin']){
        $aEmail = $_SESSION['aEmail'];
    }else{
        echo "<script> location.href = 'login.php'</script>";
    }
    $data = "SELECT * from admin_login where admin_email= '$aEmail'";
    $res = $conn->query($data);
    if($res->num_rows>0){
        $row=$res->fetch_assoc();
        $apassword = $row['admin_password'];
    }
    if(isset($_REQUEST['passupdate'])){
        $apassword = $_REQUEST['apassword'];
        $confirm  = $_REQUEST['confirm'];
        if($apassword == ''){
            $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Password Field is required</div>';
        }elseif($apassword === $confirm){
            $data = "UPDATE admin_login SEt admin_password = '$apassword' where admin_email = '$aEmail'";
            $res = $conn->query($data);

            if($res){
                $msg = '<div class="alert alert-success col-sm-6 mt-2 ml-5" role="alert">Password Update Successfully</div>';
            }else{
                $msg = '<div class="alert alert-danger col-sm-6 mt-2 ml-5" role="alert">Unable to Update</div>';
            }

        }else{
            $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Password & confirm Password are not matched</div>';
        }
    }
?>

<div class="col-sm-10 col-md-10 mt-5">

    <form action="" method="POST" class="mx-5 p-4 shadow-lg">
        <div class="form-group">
            <label for="aEmail">Email</label>
            <input type="Email" class="form-control" name="aemail" value="<?php echo $row['admin_email']?>" readonly>       
        </div>
        <div class="form-group">
        <label for="password">Password</label>
        <input type="text" class="form-control" name="apassword" id="apassword">
        </div>
        <div class="form-group">
        <label for="password">Confirm Password</label>
        <input type="text" class="form-control" name="confirm" id="apassword">
        </div>
        <button type="submit" name="passupdate" class="btn btn-danger">Update</button>
        <?php if(isset($msg)) { echo $msg; } ?>
    </form>
</div>