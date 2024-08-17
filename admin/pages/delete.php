<?php 
include '../../connect.php';

if(isset($_POST['del'])){
    $admin_id = mysqli_real_escape_string($conn, $_POST['del']);
    $query = "DELETE FROM tbl_admin WHERE id='$admin_id'";
    $run = mysqli_query($conn, $query);

    if($run){
        $_SESSION['alert'] = "Admin Information Deleted Successfully";
        header("Location: /MIDYEAR_ARCHI_PROJECT/admin/admin.php");
        exit(0);
    } else {
        $_SESSION['alert'] = "Admin not Deleted Successfully";
        header("Location: /MIDYEAR_ARCHI_PROJECT/admin/admin.php");
        exit(0);
    }
    
}