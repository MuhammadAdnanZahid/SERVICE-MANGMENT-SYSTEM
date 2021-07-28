<?php
define('TITLE', 'REQUESTS');
define('PAGE', 'request');
include('main_layout/top.php');
include('main_layout/header.php');
if(isset($_SESSION['is_adminlogin'])){
    $aEmail = $_SESSION['aEmail'];
}else{
    echo "<script> location.href = 'login.php'</script>";
}




?>

<!-- Start 2nd Colum -->
<div class="col-sm-4 mb-5">
    <?php
        $sql ="SELECT s_id,req_name,req_info,req_des,req_date FROM submit_request";
        $res = $conn->query($sql);
        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                echo '<div class="card mt-5 mx-5">';
                    echo '<div class="card-header">';
                        echo 'Request ID: '.$row['s_id'];
                   echo '</div>';
                   echo'<div class="card-body">';
                   echo '<h5 class="card-title">Request Info: '.$row['req_info'];
                   echo'</h5>';
                   echo'<p class="card-text">'.$row['req_des'];
                   echo'</p>';
                   echo'<p class="card-text">Request Date: '.$row['req_date'];
                   echo'</p>';
                   echo'<div class="float-right">';
                   echo' <form action="" method="POST">';
                   echo'<input type="hidden" name="s_id" value='.$row["s_id"].'>';
                   echo '<input type="submit" value="view" name="view" class="btn btn-danger mr-3">';
                   echo '<input type="submit" value="close" name="close" class="btn btn-secondary">';
                   echo'</form>';
                   echo'</div>';
                   echo'</div>';
               echo ' </div>';
            }
        }
    
    ?>
</div> <!-- End 2nd Column -->

<!-- Start 3rd Column -->
<?php
        if(isset($_REQUEST['view'])){
        $sql ="SELECT * FROM submit_request WHERE s_id = {$_REQUEST['s_id']}";
        $res = $conn->query($sql);
        $row = $res->fetch_assoc();
    } 
    if(isset($_REQUEST['close'])){
        $sql ="DELETE FROM submit_request WHERE s_id = {$_REQUEST['s_id']}";
        $res = $conn->query($sql);
        if($res == TRUE){
            echo '<meta http-equiv="refresh" content = "0;URL=?closed" />';
        }else{
            echo"Unable to delete";
        }
    }
        ?>



<?php
include('assignwork.php');
include('main_layout/footer.php');
?>