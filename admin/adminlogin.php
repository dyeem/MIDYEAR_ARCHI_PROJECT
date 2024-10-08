<?php
session_start();
include '../connect.php';

    if(isset($_POST['submit'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $query = "SELECT * FROM tbl_admin WHERE firstname = '$name'";

        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($password === $row['password']) {
                $_SESSION ['admin_id'] = $row['id'];
                $_SESSION ['admin_name'] = $row['firstname'];

                $title = 'SHEEESH!';
                $messages = 'Successfully Log in';
                $modal_id = 'statusSuccessModal';
                $redirectUrl = 'admin.php';
                echo "
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var modal = new bootstrap.Modal(document.getElementById('$modal_id'));
                        modal.show();
                        setTimeout(function() {
                            window.location.href = '$redirectUrl';
                        }, 3000);
                    });
                </script>";   
            } else {
                $title = 'Invalid Password!';
                $messages = 'Password does not Match';
                $modal_id = 'statusErrorsModal';
            }
        } else {
            $title = 'Invalid Admin';
            $messages = 'Admin not Existing, try again.';
            $modal_id = 'statusErrorsModal';
        }
        echo "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var modal = new bootstrap.Modal(document.getElementById('$modal_id'));
                });
            </script>";          
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/adminlogin.css">
    <link rel="stylesheet" href="../css/style.css">

    <title>Admin Login</title>
</head>
<body>
    <!-- main container -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <!-- log in section -->
        <div class="row p-1 box-area">

            <!-- left box -->
            <div class="col-md-6 rounded-5 d-flex justify-content-center align-items-center flex-column left-box ">
                <div class="featured-image">
                </div>
                <h2 style="color: #221518;">Coffee Hub </h2>
                <small class="text-wrap" style="width:18rem; color: #221518; font-size: .8rem;">Very Demure, Very Mindful</small>
            </div>

            <!-- right box -->
            <div class="col-md-6 right-box rounded-5 ">
                <div class="row align-items-center d-flex justify-content-center">
                    <div class="header-text mb-4 text-center">
                        <h2 style="color: #221518; ">Welcome, Admin!</h2>
                        <h6 class="" style="color: #221518;">We are happy to have you back</h6>
                    </div>
                    <form action="" method="post" autocomplete="off">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-md" placeholder="Name" name="name" required>
                        </div>
                        <div class="input-group mb-1">
                            <input type="password" class="form-control form-control-md" placeholder="Password" name="password" id="password" required>
                            <span class="input-group-text">
                                <i class="fa fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                            </span>
                        </div>
                        <div class="input-group mb-5 d-flex justify-content-between" id="formCheck">
                            <div class="form-check">
                                <input type="hidden" class="form-check-input">
                                <label for="formCheck" type="hidden" class="form-check-label text-light">Remember Me?</label>
                            </div>
                            
                        </div>
                        <div class="input-group mb-3 align-items-center d-flex justify-content-center">
                            <button type="submit" class="btn btn-lg w-50 fs-6 btn-light" name="submit"> login</button>
                        </div>
                    </form>
                    <!-- modal for success login -->
                    <div class="modal fade" id="statusSuccessModal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false"> 
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document"> 
                            <div class="modal-content"> 
                                <div class="modal-body text-center p-lg-4"> 
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                                        <circle class="path circle" fill="none" stroke="#198754" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                                        <polyline class="path check" fill="none" stroke="#198754" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " /> 
                                    </svg> 
                                    <h4 class="text-success mt-3"><?php echo isset($title) ? $title : ''; ?></h4> 
                                    <p class="mt-3 text-success"><?php echo isset($messages) ? $messages : ''; ?></p>
                                    <button type="button" class="btn btn-sm mt-3 btn-success" data-bs-dismiss="modal">Ok</button> 
                                </div> 
                            </div> 
                        </div> 
                    </div>
                    <!-- modal for error passwordnotmatch/emailnotfound-->
                    <div class="modal fade" id="statusErrorsModal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false"> 
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document"> 
                            <div class="modal-content"> 
                                <div class="modal-body text-center p-lg-4"> 
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                                        <circle class="path circle" fill="none" stroke="#db3646" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" /> 
                                        <line class="path line" fill="none" stroke="#db3646" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3" />
                                        <line class="path line" fill="none" stroke="#db3646" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="95.8" y1="38" X2="34.4" y2="92.2" /> 
                                    </svg> 
                                    <h4 class="text-danger mt-3"><?php echo isset($title) ? $title : ''; ?></h4> 
                                    <p class="mt-3 text-danger"><?php echo isset($messages) ? $messages : ''; ?></p>
                                    <button type="button" class="btn btn-sm mt-3 btn-danger" data-bs-dismiss="modal">Ok</button> 
                                </div> 
                            </div> 
                        </div> 
                    </div>
                    
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            <?php if (isset($modal_id)) { ?>
                                var myModal = new bootstrap.Modal(document.getElementById('<?php echo $modal_id; ?>'));
                                myModal.show();
                            <?php } ?>
                        });
                    </script>
                    <div class="input-group mb-3 d-flex justify-content-center">
                        <div class="row">
                            <small class="" style="color: #221518;">Don't have a Account? <a href="adminsignup.php" class="" style="color: #221518;"> Sign Up here</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/script.js"></script>
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);

        // Toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });

</script>
</body>
</html>