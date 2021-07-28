<?php
    define('PAGE','Sell report');
    define('TITLE','sellreport');
    include('main_layout/top.php');
    include('main_layout/header.php');

    if(isset($_REQUEST['search'])){
        $startdate = $_REQUEST['satrtdate'];
        $enddate= $_REQUEST['enddate'];
    }

?>

<div class="col-sm-9 col-md-10 mt-5 text-center">
    <form action="" method="POST" class="d-print-none">
        <div class="form-row">

            <div class="form-group col-md-2">
                <input type="date" name="startdate" id="startdate" class="form-control">
            </div> &nbsp <span> to </span> &nbsp
            <div class="form-group col-md-2">
                <input type="date" name="enddate" id="enddate" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" name="search" id="search" value="Search" class="btn btn-secondary">
                <input type="submit" class="btn btn-danger" value="Print" onClick="window.print()">
            </div>
        </div>
    </form>

    <p class="bg-dark text-white p-2 mt-4">Details</p>
    <table class="table">
        <thead>
            <tr>
                    <th scope="col">Requster Id</th>
                    <th scope="col">Requster Name</th>
                    <th scope="col">Requster Email</th>
                    <th scope="col">Requster Number</th>
                    <th scope="col">Requster Address</th>
                    <th scope="col">Requster City</th>
                    <th scope="col"> State</th>
                    <th scope="col">Technician Name</th>
                    <th scope="col">Date of Requster</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(isset($_REQUEST['search'])){
                $data = "SELECT * FROM assign_work WHERE req_date BETWEEN '$startdate' AND '$enddate'";
                $res = $conn->query($data);
                if($res->num_rows> 0){
                    while ($row = $res->fetch_assoc()) {
                        echo '
                            <tr>
                                <td>'.$row['req_id'].'</td>
                                <td>'.$row['req_name'].'</td>
                                <td>'.$row['req_email'].'</td>
                                <td>'.$row['req_mobile'].'</td>
                                <td>'.$row['req_address1'].'</td>
                                <td>'.$row['req_city'].'</td>
                                <td>'.$row['req_state'].'</td>
                                <td>'.$row['tech_name'].'</td>
                                <td>'.$row['req_date'].'</td>
                            </tr>
                            
                        ';
                    }

                }
                else{
                    echo '<div class="alert alert-warning mb-2 mt-5" role="alert">No Records</div>';
                }
            }
            ?>
        </tbody>

    </table>
</div>



