<?php
define('TITLE', 'Assign Work');
define('PAGE', 'viewassignwork');
include('main_layout/top.php');
include('main_layout/header.php');

if(isset($_SESSION['is_adminlogin'])){
    $aEmail = $_SESSION['aEmail'];
}else{
    echo "<script> location.href = 'login.php'</script>";
}
?>

<!-- Start 2nd Colum -->
<div class="col-sm-6 mt-5 mx-5">
<h3 class="text-center my-5">Assigned Work Details</h3>
<?php
        if(isset($_REQUEST['view'])){
        $sql = "SELECT * FROM assign_work where req_id = {$_REQUEST['id']}";
            $res= $conn->query($sql);
            $row = $res->fetch_assoc();?>
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
                <form action="" class="mb-3 d-print-none d-inline">
                    <input type="submit" class="btn btn-danger" value="Print" onClick="window.print()"></form>
                    <form action="work.php" class="mb-3 d-print-none d-inline">
                    <input type="submit" Value="Close" class="btn btn-secondary">
                </form>
            </div>
<?php } ?>
</div>

<!-- End 2nd Colum -->




<?php
include('main_layout/footer.php');
?>