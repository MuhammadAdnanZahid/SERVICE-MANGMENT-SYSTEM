<?php 
    define('TITLE', 'SUBMIT REQUEST');
    define('PAGE', 'submitrequest.php');
    include('main_layout/top.php');
    include('main_layout/header.php');

    if($_SESSION['is_login']){

        $rEmail = $_SESSION['rEmail'];
    } else{
        echo "<script> location.href='rlogin.php'</script>";
    } 

    if(isset($_REQUEST['rsubmit'])){
        $req_name = $_REQUEST['req_name'];
        $req_email = $_REQUEST['req_email'];
        $req_mobile = $_REQUEST['req_mobile'];
        $req_address1 = $_REQUEST['req_address1'];
        $req_address2 = $_REQUEST['req_address2'];
        $req_city= $_REQUEST['req_city'];
        $req_state = $_REQUEST['req_state'];
        $req_zip = $_REQUEST['req_zip'];
        $req_info = $_REQUEST['req_info'];
        $req_date = $_REQUEST['req_date'];
        $req_des = $_REQUEST['req_des'];
    
            $sql = ' submit_request set
            req_name = "'.$req_name.'",
            req_email = "'.$req_email.'",
            req_mobile = "'.$req_mobile.'",
            req_address1 = "'.$req_address1.'",
            req_address2 = "'.$req_address2.'",
            req_city = "'.$req_city.'",
            req_state = "'.$req_state.'",
            req_zip = "'.$req_zip.'",
            req_info = "'.$req_info.'",
            req_date = "'.$req_date.'",
            req_des = "'.$req_des.'"
            ';
            
   
        $res = "INSERT INTO" .$sql;
        $conn->query($res);
        if($conn == TRUE){
        $genid = mysqli_insert_id($conn);
        $msg = '<div class="alert alert-success col-sm-6 mt-2 ml-5" role="alert">Request Submit Successfully</div>';
        $_SESSION['myid'] = $genid;
        echo "<script> location.href='submitsuccess.php'</script>";
        } else{
        $msg = '<div class="alert alert-danger col-sm-6 mt-2 ml-5" role="alert">Unable to Submit Request</div>';

        }
    }
   
?>

<div class="col-sm-9 col-md-10 mt-5"> <!-- Start Service Form 2nd Column -->
    <form action="" class="mx-5 p-4 shadow-lg" method="POST">
    <div class="form-row">
            <div class="form-group col-md-4">
                <label for="RequesterName">Name</label>
                <input type="text" class="form-control" id="req_name" name="req_name" placeholder="eg: Ali Ahmad" required>
            </div>
            <div class="form-group col-md-4">
                <label for="RequesterEmail">Email</label>
                <input type="email" class="form-control" id="req_email" name="req_email" required>
            </div>
            <div class="form-group col-md-4">
            <label for="RequesterMobile">Mobile</label>
            <input type="text" class="form-control" id="req_mobile" name="req_mobile" onkeypress="isInputNumber(event)" placeholder="03481234567" required>
            </div> 
            
       </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="Address1">Address Line 1</label>
                <input type="text" class="form-control" id="req_address1" name="req_address1" placeholder="House & Street No. 123" required>
            </div>
            <div class="form-group col-md-4">
            <label for="Address2">Address Line 2</label>
            <input type="text" class="form-control" id="req_address2" name="req_address2" placeholder="XYZ Colony" required>
            </div>
            <div class="form-group col-md-4">
                <label for="RequesterCity">City</label>
                <input type="text" class="form-control" id="req_city" name="req_city" placeholder="eg: Islamabad" required>
            </div>
       </div>
       <div class="form-row">
            <div class="form-group col-md-4">
            <label for="RequesterCity">State</label>
            <input type="text" class="form-control" id="req_state" name="req_state" placeholder="eg: Punjab" required>
            </div>
            <div class="form-group col-md-4">
            <label for="RequesterZip">Zip</label>
            <input type="text" class="form-control" id="req_zip" name="req_zip" onkeypress="isInputNumber(event)" placeholder="1234" required>
            </div>
            <div class="form-group col-md-4">
                <label for="RequesterDate">Date</label>
                <input type="date" class="form-control" id="req_date" name="req_date" required>
            </div>
       </div>
            <div class="form-group">
                <label for="inputRequestInfo">Request Info</label>
                <input type="text" class="form-control" id="req_info" name="req_info" placeholder="Request Info" required>
            </div>
       <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="req_des" name="req_des" placeholder="Request Description" required>
        </div>
       <button class="btn btn-danger" type="submit" name="rsubmit">Submit</button>
       <button class="btn btn-secondary" type="reset">Reset</button>
       <?php if(isset($msg)) { echo $msg; } ?>
    </form> 

</div> <!-- End Service Form 2nd Column -->

<script>
    function isInputNumber(evt){
        var ch = String.formCharCode(evt.which);
        if(!(/[0-9]/.test(ch))){
            evt.preventDefault();
        }

    }
</script>


<!-- Only number for INPUT Fields -->
<?php include('main_layout/footer.php')?>
