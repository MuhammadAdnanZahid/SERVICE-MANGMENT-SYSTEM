<?php
define('TITLE', 'WORK ORDER');
define('PAGE', 'work');
include('main_layout/top.php');
include('main_layout/header.php');

if(isset($_SESSION['is_adminlogin'])){
    $aEmail = $_SESSION['aEmail'];
}else{
    echo "<script> location.href = 'login.php'</script>";
}

?>

<!-- Start 2nd Column -->
<div class="col-sm-9 col-md-10 mt-5">
    <?php 
     $sql = "SELECT * FROM assign_work";
     $res = $conn->query($sql);
    ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">City</th>
                <th scope="col">Mobile</th>
                <th scope="col">Req Info</th>
                <th scope="col">Technician</th>
                <th scope="col">Assigned Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($res->num_rows> 0){
               while($row = $res->fetch_assoc()){
                  echo '<tr>
                    <td>'.$row['req_id'].'</td>
                    <td>'.$row['req_name'].'</td>
                    <td>'.$row['req_address1'].'</td>
                    <td>'.$row['req_city'].'</td>
                    <td>'.$row['req_mobile'].'</td>
                    <td>'.$row['req_info'].'</td>
                    <td>'.$row['tech_name'].'</td>
                    <td>'.$row['req_date'].'</td>
                    <td> 
                    <form action="viewassignwork.php" class="d-inline mr-2" method="POST">
                    <input type ="hidden" name="id" value='.$row['req_id'].'>
                    <button class="btn btn-warning" name="view" value="view" type="submit"><i class="far fa-eye"></i></button>
                    </form>
                    <form action="" class="d-inline mr-2" method="POST">
                    <input type ="hidden" name="id" value='.$row['req_id'].'>
                    <button class="btn btn-danger" name="delete" value="Delete" type="submit"><i class="far fa-trash-alt"></i></button>
                    </form>
                    </td>
                   
                  ';


               } }
               else{
                   echo 'No records in database';
               }
               if(isset($_REQUEST['delete'])){
                   $sql = "DELETE FROM assign_work WHERE req_id = {$_REQUEST['id']}";
                   if($conn->query($sql) == true){
                       echo'<meta http-equiv="refresh" content="0;URL=?deleted"/>';
                   }
               }
            ?>
        </tbody>
    </table>

</div>

<!-- End 2nd Column -->



<?php
include('main_layout/footer.php');
?>