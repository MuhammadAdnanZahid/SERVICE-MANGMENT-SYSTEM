<?php
    define('TITLE', 'sellproductslip');
    define('PAGE', 'sellproductslip');
    include('main_layout/top.php');
    include('main_layout/header.php');

    if(isset($_SESSION['is_adminlogin'])){
        $aEmail = $_SESSION['aEmail'];
    }else{
        echo "<Script> location.href='login.php'; </script>";
    }

    $kry = "SELECT * from customer_sell Where cus_id = {$_SESSION['lastid']}";
    $res= $conn->query($kry);
    if($res->num_rows == 1){
        $row = $res->fetch_assoc();
        echo "<div class='ml-5 mt-5'>
        <h3 class='text-center'>Customer Bill</h3>
        <table class='table'>
            <tbody>
                <tr>
                    <th>Customer ID</th>
                    <td>".$row['cus_id']."</td>
                </tr>
                <tr>
                    <th>Customer Name</th>
                    <td>".$row['cus_name']."</td>
                </tr>
                <tr>
                    <th>Cutomer Address</th>
                    <td>".$row['cus_add']."</td>
                </tr>
                <tr>
                    <th>Cutomer Number</th>
                    <td>".$row['product_name']."</td>
                </tr>
                <tr>
                    <th>Product Quantity</th>
                    <td>".$row['product_qty']."</td>
                </tr>
                <tr>
                    <th>Product Sell Price</th>
                    <td>".$row['product_sp']."</td>
                </tr>
                <tr>
                    <th>Product Price</th>
                    <td>".$row['total_price']."</td>
                </tr>
                <tr>
                    <th>Product Sell Date</th>
                    <td>".$row['product_dos']."</td>
                </tr>
                <tr>
                    <td><form class='d-print-none'><input class='btn btn-danger'
                    type='submit' value='Print' onClick='window.print()'></form>
                    </td>
                    <td><a href='assets.php' class='btn btn-secondary d-print-none'
                        >Close</a>
                    </td>
                    "
                    ;


    }else{
        echo " Failed";
    }
    


?>