<?php
if(isset($_SESSION['is_adminlogin'])){
    $aEmail = $_SESSION['aEmail'];
}else{
    echo "<script> location.href = 'login.php'</script>";
}


if(isset($_REQUEST['asubmit'])){
    $req_id = $_REQUEST['req_id'];
    $req_name = $_REQUEST['req_name'];
    $req_email = $_REQUEST['req_email'];
    $req_mobile = $_REQUEST['req_mobile'];
    $req_address1 = $_REQUEST['req_address1'];
    $req_address2 = $_REQUEST['req_address2'];
    $req_city= $_REQUEST['req_city'];
    $req_state = $_REQUEST['req_state'];
    $req_zip = $_REQUEST['req_zip'];
    $req_info = $_REQUEST['req_info'];
    $tech_name =$_REQUEST['assigntech'];
    $req_date = $_REQUEST['req_date'];
    $req_des = $_REQUEST['req_des'];

        $sql = ' assign_work set
        req_id = "'.$req_id.'",
        req_name = "'.$req_name.'",
        req_email = "'.$req_email.'",
        req_mobile = "'.$req_mobile.'",
        req_address1 = "'.$req_address1.'",
        req_address2 = "'.$req_address2.'",
        req_city = "'.$req_city.'",
        req_state = "'.$req_state.'",
        req_zip = "'.$req_zip.'",
        req_info = "'.$req_info.'",
        tech_name = "'.$tech_name.'",
        req_date = "'.$req_date.'",
        req_des = "'.$req_des.'"
        ';
        

    $res = "INSERT INTO" .$sql;
    $conn->query($res);
    if($conn == TRUE){
    $genid = mysqli_insert_id($conn);
    $msg = '<div class="alert alert-success col-sm-6 mt-2 ml-5" role="alert">Request Submit Successfully</div>';
    $_SESSION['myid'] = $genid;
    } else{
    $msg = '<div class="alert alert-danger col-sm-6 mt-2 ml-5" role="alert">Unable to Submit Request</div>';

    }
}


?>

<div class="col-sm-5 mt-5 jumbotron shadow-sm" style="max-height:55rem">
    <form action="" method="POST">
        <h5 class="text-center">Assign Work Order Request</h5>
        <div class="form-group">
                <label for="RequesterId">Request ID</label>
                <input type="text" class="form-control" id="req_id" name="req_id" value="<?php if(isset($row['s_id'])){echo $row['s_id'];}?>" readonly>
        </div>
        <div class="form-group">
                <label for="inputRequestInfo">Request Info</label>
                <input type="text" class="form-control" id="req_info" name="req_info" value="<?php if(isset($row['req_info'])){echo $row['req_info'];}?>"  placeholder="Request Info" required>
            </div>
       <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="req_des" name="req_des" value="<?php if(isset($row['req_des'])){echo $row['req_des'];}?>"  placeholder="Request Description"  required>
        </div>
        <div class="form-group">
                <label for="RequesterName">Name</label>
                <input type="text" class="form-control" id="req_name" name="req_name" value="<?php if(isset($row['req_name'])){echo $row['req_name'];}?>"  placeholder="eg: Ali Ahmad" required>
            </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="Address1">Address Line 1</label>
                <input type="text" class="form-control" id="req_address1" name="req_address1" value="<?php if(isset($row['req_address1'])){echo $row['req_address1'];}?>"  placeholder="House & Street No. 123" required>
            </div>
            <div class="form-group col-md-6">
            <label for="Address2">Address Line 2</label>
            <input type="text" class="form-control" id="req_address2" name="req_address2" value="<?php if(isset($row['req_address2'])){echo $row['req_address2'];}?>"  placeholder="XYZ Colony" required>
            </div>
       </div>
       <div class="form-row">
            <div class="form-group col-md-4">
                <label for="RequesterCity">City</label>
                <input type="text" class="form-control" id="req_city" name="req_city" value="<?php if(isset($row['req_city'])){echo $row['req_city'];}?>"  placeholder="eg: Islamabad" required>
            </div>
            <div class="form-group col-md-4">
            <label for="RequesterCity">State</label>
            <input type="text" class="form-control" id="req_state" name="req_state" value="<?php if(isset($row['req_state'])){echo $row['req_state'];}?>"  placeholder="eg: Punjab" required>
            </div>
            <div class="form-group col-md-4">
            <label for="RequesterZip">Zip</label>
            <input type="text" class="form-control" id="req_zip" name="req_zip" value="<?php if(isset($row['req_zip'])){echo $row['req_zip'];}?>" onkeypress="isInputNumber(event)" placeholder="1234" required>
            </div>
       </div>
       <div class="form-row">
            <div class="form-group col-md-8">
                <label for="RequesterEmail">Email</label>
                <input type="email" class="form-control" id="req_email" name="req_email" value="<?php if(isset($row['req_email'])){echo $row['req_email'];}?>"  required>
            </div>
            <div class="form-group col-md-4">
            <label for="RequesterMobile">Mobile</label>
            <input type="text" class="form-control" id="req_mobile" name="req_mobile" value="<?php if(isset($row['req_mobile'])){echo $row['req_mobile'];}?>"  onkeypress="isInputNumber(event)" placeholder="03481234567" required>
            </div> 
       </div>
       <div class="form-row">
            <div class="form-group col-md-6">
            <label for="assigntech">Assign to Technician</label>
            <input type="text" class="form-control" id="assigntech" name="assigntech"  required>
            </div> 
            <div class="form-group col-md-6">
                <label for="RequesterDate">Date</label>
                <input type="date" class="form-control" id="req_date" name="req_date" required>
            </div>
       </div>
        <div class="float-right">
           <button class="btn btn-success" type="submit" name="asubmit">Submit</button>
           <button class="btn btn-secondary" type="reset">Reset</button>
        </div>
        <?php if(isset($msg)) { echo $msg; } ?>

    </form>

</div>
<!-- End 3rd Column -->
<script>
function isInputNumber(evt){
        var ch = String.formCharCode(evt.which);
        if(!(/[0-9]/.test(ch))){
            evt.preventDefault();
        }

    }
</script>