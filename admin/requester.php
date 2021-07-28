<?php
define('TITLE', 'Requester');
define('PAGE', 'requester');
include('main_layout/top.php');
include('main_layout/header.php');

if(isset($_SESSION['is_adminlogin'])){
    $aEmail = $_SESSION['aEmail'];
}else{
    echo "<script> location.href = 'login.php'</script>";
}
?>

<!--Start 2nd Column -->
<div class="col-sm-9 col md-10 mt-5 text-center">
<div class="float-right mr-1"><a href="insertreq.php" class="btn btn-danger"><i class="fas fa-plus fa-1x"></i></a></div>
    <p class="bg-dark text-white p-2">List of Requester </p>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Requester ID</th>
                <th scope="col">Name</th>
                <th scope="col">Mobile Number</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $kry = "SELECT * FROM requster_login";
        $res = $conn->query($kry);
        if($res->num_rows> 0){
            while($row = $res->fetch_assoc()){
               echo '<tr>
                 <td>'.$row['r_id'].'</td>
                 <td>'.$row['r_name'].'</td>
                 <td>'.$row['r_mobile'].'</td>
                 <td>'.$row['r_email'].'</td>
                 <td> 
                 <form action="editreq.php" class="d-inline mr-2" method="POST">
                 <input type ="hidden" name="id" value='.$row['r_id'].'>
                 <button class="btn btn-info" name="edit" value="edit" type="submit"><i class="fas fa-pen"></i></button>
                 </form>
                 <form action="" class="d-inline mr-2" method="POST">
                 <input type ="hidden" name="id" value='.$row['r_id'].'>
                 <button class="btn btn-danger" name="delete" value="Delete" type="submit"><i class="far fa-trash-alt"></i></button>
                 </form>
                 </td>
                
               ';


            } }
            else{
                echo 'No records in database';
            }
            if(isset($_REQUEST['delete'])){
                $sql = "DELETE FROM requster_login WHERE r_id = {$_REQUEST['id']}";
                if($conn->query($sql) == true){
                    echo'<meta http-equiv="refresh" content="0;URL=?deleted"/>';
                }
            }
    ?>
        </tbody>
    </table>
</div>



<!--End 2nd Column -->

<?php
include('main_layout/footer.php');
?>