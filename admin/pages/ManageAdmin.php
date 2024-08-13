<?php 
include '../connect.php';

    if (isset($_POST['submit'])) {
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $checker = mysqli_query($conn, "SELECT * FROM tbl_admin WHERE email = '$email'");
        
        if (mysqli_num_rows($checker) > 0) {
            $_SESSION['alert'] = "Email already taken";
           
        } else {
            $sql = "INSERT INTO tbl_admin (firstname, lastname, phonenumber, email, password) VALUES ('$firstname', '$lastname', '$telephone', '$email', '$password')";
            
            if (mysqli_query($conn, $sql)) {
                $_SESSION['alert'] = "Admin added successfully";

            } else {
                $_SESSION['alert'] = "Admin added successfully";
            }
        }
    }
?>

<div class="container-fluid">
    <div class="row">
        <!-- HEADER -->
        <div class="col-12">
            <div class="row" id="header">
                <div class="col-4 d-flex align-items-center">
                    <img src="../../images/logo.png" alt="test" id="logo"><h4 class="brand-name">Coffee Hub</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="buttons">
        <div class="col-12">
            <?php include 'alert.php'; ?>
            <div class="button">
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#formmodal">Add New Admin</button>
            </div>
            <div class="modal fade" id="formmodal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false"> 
                <div class="modal-dialog modal-dialog-centered modal-md" role="document"> 
                    <div class="modal-content"> 
                        <div class="modal-body text-center p-lg-4"> 
                        <script>
                            if(window.history.replaceState){
                                window.history.replaceState(null, null, window.location.href);
                            }
                        </script>
                        <form action="" method="post" >
                            <div class="d-flex flex-column align-items-center justify-content-center text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g class="nc-icon-wrapper" fill="#1b1c1d" stroke-linejoin="round" stroke-linecap="round"><path data-cap="butt" d="M38.583,18.042C38.583,27.707,32.054,37,24,37S9.417,27.707,9.417,18.042" fill="none" stroke="#1b1c1d" stroke-miterlimit="10" stroke-width="2"></path><path data-color="color-2" d="M24,2C16,2,7.958,3.458,9.417,18.042c0,.634.031,1.267.086,1.895A6,6,0,0,1,15.5,14H25a6,6,0,0,0,6-6,10,10,0,0,0,7.611,9.7C39.907,3.442,31.935,2,24,2Z" fill="none" stroke="#1b1c1d" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"></path><path d="M6.263,45l8.409-1.433A4,4,0,0,0,18,39.624V37" fill="none" stroke="#1b1c1d" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"></path><path d="M41.737,45l-8.409-1.433A4,4,0,0,1,30,39.624V37" fill="none" stroke="#1b1c1d" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"></path></g></svg>
                                <h4>Create a Admin</h4>
                            </div>
                            <div class="input-group mb-3 d-flex">
                                <input type="text" class="form-control form-control-md " style="margin-right: 10px" placeholder="Firstname" name="firstname" required autocomplete="off">
                                <input type="text" class="form-control form-control-md ml-2" style="margin-left: 10px" placeholder="Lastname"name="lastname" required autocomplete="off">
                            </div>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control form-control-md" placeholder="Email Address" name="email" required autocomplete="off">
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control form-control-md" placeholder="Phone Number" name="telephone" required autocomplete="off">
                            </div>
                            <div class="input-group mb-4">
                                <input type="password" class="form-control form-control-md" placeholder="Password"name="password" required autocomplete="off">
                            </div>
                            <div class="">
                                <button type="button" class="btn btn-lg mt-3 btn-danger" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-lg mt-3 btn-success" name="submit">Done</button>
                            </div> 
                        </form>
                        </div>
                    </div> 
                </div> 
		    </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="container">

            </div>
        </div>
    </div>
</div>
