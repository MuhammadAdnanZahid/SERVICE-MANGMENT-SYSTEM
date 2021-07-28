<?php
define('TITLE', 'SUBMIT SUCCESS');
include('main_layout/top.php');
include('main_layout/header.php');

    if($_SESSION['is_login']){
            $rEmail = $_SESSION['rEmail'];
        }else{
            echo "<Script>location.href = 'rlogin.php'</Script>";
        }

        $sql = "SELECT * FROM submit_request WHERE s_id = {$_SESSION['myid']} ";
        $res = $conn->query($sql);
        if($res->num_rows == 1){
            $row = $res->fetch_assoc(); 
            echo "<div class='ml-5 mt-5'id='print'>
            <table class='table'>
                <tbody>
                    <tr>
                       <th>REQUEST ID</th>
                       <td>".$row['s_id']."</td>
                    </tr>
                    <tr>
                       <th>REQUESTER NAME</th>
                       <td>".$row['req_name']."</td>
                    </tr>
                    <tr>
                       <th>REQUESTER EMAIL</th>
                       <td>".$row['req_email']."</td>
                    </tr>
                    <tr>
                       <th>REQUEST INFO</th>
                       <td>".$row['req_info']."</td>
                    </tr>
                    <tr>
                       <th>REQUEST DESCRIPTION</th>
                       <td>".$row['req_des']."</td>
                    </tr>
                    <tr>
                        <td><form class='d-print-none'><input class='btn
                        btn-danger' type='submit' value='Print' onClick='window.print()'</form></td>
                    </tr>
                </tbody> 
            </table>
        </div>
                        ";
    }else{
        echo "Failed to Processs";
    }
 

?>






<?php include('main_layout/footer.php'); ?>