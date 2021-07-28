<?php
define('TITLE', 'ADMIN DASBOARD');
define('PAGE', 'dashboard');
include('main_layout/top.php');
include('main_layout/header.php');
 if(isset($_SESSION['is_adminlogin'])){
     $aEmail = $_SESSION['aEmail'];
 }else{
     echo "<script> location.href = 'login.php'</script>";
 }
  
 $data =  "SELECT max(s_id) From submit_request";
$res = $conn->query($data);
$row = $res->fetch_assoc();
$submitreq = $row['s_id'];
 echo $row['s_id'];

?>

<!-- Start Dashboard  2nd Column -->
    <div class="col-sm-9 col-md-10">
        <div class="row text-center mx-5">
            <div class="col-sm-4 mt-5 ">
                <div class="card text-white bg-danger mb-3 shadow-lg " style="max-width:18rem;">
                    <div class="card-header">Requests Recieved</div>
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $submitreq; ?></h4>
                        <a href="" class=" nav-link text-white shadow-sm">view</a> 
                        </div>    
                </div>
            
            </div> <!-- End 1st card -->

            <div class="col-sm-4 mt-5 ">
                <div class="card text-white bg-success mb-3 shadow-lg " style="max-width:18rem;">
                    <div class="card-header">Assigned Work</div>
                        <div class="card-body">
                            <h4 class="card-title">43</h4>
                        <a href="" class=" nav-link text-white shadow-sm">view</a> 
                        </div>    
                </div>
            
            </div> <!-- End 2ndst card -->

            <div class="col-sm-4 mt-5 ">
                <div class="card text-white bg-info mb-3 shadow-lg " style="max-width:18rem;">
                    <div class="card-header">No. of Technician</div>
                        <div class="card-body">
                            <h4 class="card-title">10</h4>
                        <a href="" class=" nav-link text-white shadow-sm">view</a> 
                        </div>    
                </div>
            
            </div> <!-- End 3rd card -->
        
        </div> <!-- End Row -->

        <div class="mx-5 mt-5 text-center">
            <p class="bg-dark text-white p-2">List of Requesters </p>
            <?php
                $sql = "SELECT * FROM requster_login";
                $res = $conn->query($sql);
                if($res->num_rows>0){
                    echo '
                    <table class="table">
                        <thead>
                            <tr>
                                <th scop="col">Requester Id</th>
                                <th scop="col">UserName</th>
                                <th scop="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>';
                        while($row = $res->fetch_assoc()){
                           echo '<tr>';
                             echo   '<td>'.$row["r_id"].'</td>';
                             echo   '<td>'.$row["r_name"].'</td>';
                             echo   '<td>'.$row["r_email"].'</td>';
                           echo '</tr>';
                        }
                        echo '</tbody>
                    
                    </table>
                    ';
                }else{
                    echo'No records in database';
                }
            
            ?>
        </div>
    
    </div> <!-- Start Dashboard 2nd Column -->




<?php
include('main_layout/footer.php');
?>