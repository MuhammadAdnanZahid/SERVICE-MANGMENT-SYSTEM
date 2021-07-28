<?php 
define('TITLE', 'REQUESTER PROFILE');
define('PAGE', 'rprofile.php');
include("main_layout/top.php");
?>
<?php
    if($_SESSION['is_login']){

        $rEmail = $_SESSION['rEmail'];
    } else{
        echo "<script> location.href='rlogin.php'<script>";
    } 

    $sql = "SELECT r_name, r_email, r_mobile FROM requster_login WHERE r_email = '$rEmail'";
    $res = $conn->query($sql);
    if($res->num_rows == 1){
        $row = $res->fetch_assoc();
        $rName = $row['r_name'];
        $rMobile = $row['r_mobile'];
    }

    if(isset($_REQUEST['nameupdate'])){
        if($_REQUEST['rName']== "" && $_REQUEST['rMobile']== ""){
            $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">All fields are required</div>';      
        }
        else{
            $rName = $_REQUEST['rName'];
            $rMobile = $_REQUEST['rMobile'];
            $sql ="UPDATE requster_login SET r_name = '$rName', r_mobile ='$rMobile' WHERE r_email='$rEmail'";
            if($conn->query($sql) == TRUE){
                $msg = '<div class="alert alert-success col-sm-6 mt-2 ml-5" role="alert">Update Successfully</div>';
            } else{
                $msg = '<div class="alert alert-danger col-sm-6 mt-2 ml-5" role="alert">Unable to Update</div>';

            }
        }
    }

?>

  

            <?php
            include("main_layout/header.php");
            ?>
            
        <div class="col-sm-6 mt-5"> <!-- Start Profile Area 2nd Column -->
           <form action="" method="POST" class="mx-5 p-4 shadow-lg">
              <div class="form-group">
                 <label for="inputEmail">Email</label><input class="form-control" type="email" name="rEmail" id="rEmail" value="<?php echo $rEmail ?>" readonly>
            
              </div>
              <div class="form-group">
              <label for="rName">Name</label><input class="form-control" type="text" name="rName" id="rName" value="<?php echo $rName; ?>">
              </div>
              <div class="form-group">
              <label for="rMobile">Mobile Number</label><input class="form-control" type="text" name="rMobile" id="rMobile" value="<?php echo $rMobile; ?>">
              </div>
              <button name="nameupdate" type="submit"  class="btn btn-danger">Update</button>
              <?php if(isset($msg)) { echo $msg; } ?>
           </form>
        
        </div> <!-- End Profile Area 2nd Column -->

     

<?php
    include("main_layout/footer.php")
    ?>