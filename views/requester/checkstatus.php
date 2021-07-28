<?php 
define('TITLE', 'Check Status');
define('PAGE', 'checkstatus.php');
    include('main_layout/top.php');
    include('main_layout/header.php');
if(isset($_SESSION['is_login'])){
    $rEmail = $_SESSION['rEmail'];
}else{
    echo "<script> location.href = 'rlogin.php'</script>";
}
?>

<!-- Start 2nd Column  -->
<div class="col-sm-6 mt-5 mx-3">
    <form action="" method="post" class="form-inline d-print-none">
        <div class="form-group mr-3">
        <label for="checkid">Enter Request ID:</label>
        <input type="number"  class="form-control ml-3" name="check_id" id="check_id">
        </div>
        <button class="btn btn-danger" name="search" type="submit">Search</button>
    </form>
        <?php
        if(isset($_REQUEST['check_id'])){
            if($_REQUEST['check_id']== ""){
                $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2">Please Enter Your Request Id</div>';
            } else{
                $sql = "SELECT * FROM assign_work where req_id = {$_REQUEST['check_id']}";
            $res= $conn->query($sql);
            $row = $res->fetch_assoc();
            if($row['req_id'] == $_REQUEST['check_id'] ){ ?>
        <h3 class="text-center my-5">Assigned Work Details</h3>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>Request ID</td>
                        <td><?php if(isset($row['req_id'])) {echo $row['req_id'];}?></td>
                    </tr>
                    <tr>
                        <td>Request Info</td>
                        <td><?php if(isset($row['req_info'])) {echo $row['req_info'];}?></td>
                    </tr>
                    <tr>
                        <td>Request Description</td>
                        <td><?php if(isset($row['req_des'])) {echo $row['req_des'];}?></td>
                    </tr>
                    <tr>
                        <td>Requester Name</td>
                        <td><?php if(isset($row['req_name'])) {echo $row['req_name'];}?></td>
                    </tr>
                    <tr>
                        <td>Requester Number</td>
                        <td><?php if(isset($row['req_mobile'])) {echo $row['req_mobile'];}?></td>
                    </tr>
                    <tr>
                        <td>Requester Email</td>
                        <td><?php if(isset($row['req_email'])) {echo $row['req_email'];}?></td>
                    </tr>
                    <tr>
                        <td>Requester Address Line 1</td>
                        <td><?php if(isset($row['req_address1'])) {echo $row['req_address1'];}?></td>
                    </tr>
                    <tr>
                        <td>Requester Address Line 2</td>
                        <td><?php if(isset($row['req_address2'])) {echo $row['req_address2'];}?></td>
                    </tr>
                    <tr>
                        <td>Requester City</td>
                        <td><?php if(isset($row['req_city'])) {echo $row['req_city'];}?></td>
                    </tr>
                    <tr>
                        <td>Requester State</td>
                        <td><?php if(isset($row['req_state'])) {echo $row['req_state'];}?></td>
                    </tr>
                    <tr>
                        <td>Requester Zip</td>
                        <td><?php if(isset($row['req_zip'])) {echo $row['req_zip'];}?></td>
                    </tr>
                    <tr>
                        <td>Technician Alloted</td>
                        <td><?php if(isset($row['tech_name'])) {echo $row['tech_name'];}?></td>
                    </tr>
                    <tr>
                        <td>Date Alloted</td>
                        <td><?php if(isset($row['req_date'])) {echo $row['req_date'];}?></td>
                    </tr>
                    <tr>
                        <td>Customer Sign</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Technician Sign</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center">
                <form action="" class="mb-3 d-print-none">
                    <input type="submit" class="btn btn-danger" value="Print" onClick="window.print()">
                    <input type="submit" Value="Close" class="btn btn-secondary">
                </form>
            </div>
        <?php } else{
            echo '<div class="alert alert-info mt-4">Your Request is still in Process</div>';
        }
            }
              } ?>
              <?php if(isset($msg)){}echo $msg;?>
</div>


<!-- End 2nd Column  -->

<?php include('main_layout/footer.php')?>