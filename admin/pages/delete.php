<?php 
session_start();
include '../../connect.php';

if(isset($_GET['id'])){
    $admin_id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "DELETE FROM tbl_admin WHERE id='$admin_id'";
    $run = mysqli_query($conn, $query);

    if($run){
        $_SESSION['alertadmin'] = "Admin Information Deleted Successfully";
    } else {
        $_SESSION['alertadmin'] = "Admin not Deleted Successfully";
    }
    header("Location: /MIDYEAR_ARCHI_PROJECT/admin/admin.php");
    exit(0);
}
?>