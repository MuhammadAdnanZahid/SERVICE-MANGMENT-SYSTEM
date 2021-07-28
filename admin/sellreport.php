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
                    <th scope="col">Customer Id</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Customer Address</th>
                    <th scope="col">Customer Number</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Quantity</th>
                    <th scope="col">Product Price</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Date of Sell</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(isset($_REQUEST['search'])){
                $data = "SELECT * FROM customer_sell WHERE product_dos BETWEEN '$startdate' AND '$enddate'";
                $res = $conn->query($data);
                if($res->num_rows> 0){
                    while ($row = $res->fetch_assoc()) {
                        echo '
                            <tr>
                                <td>'.$row['cus_id'].'</td>
                                <td>'.$row['cus_name'].'</td>
                                <td>'.$row['cus_add'].'</td>
                                <td>'.$row['cus_number'].'</td>
                                <td>'.$row['product_name'].'</td>
                                <td>'.$row['product_qty'].'</td>
                                <td>'.$row['product_sp'].'</td>
                                <td>'.$row['total_price'].'</td>
                                <td>'.$row['product_dos'].'</td>
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



