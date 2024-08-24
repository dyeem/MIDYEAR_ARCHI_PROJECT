<?php
session_start();
include '../connect.php';
require 'pages/PHPMailer-master/src/Exception.php';
require 'pages/PHPMailer-master/src/PHPMailer.php';
require 'pages/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phonenumber = $_POST['telephone'];
    $password = $_POST['password'];

    $checkQuery = "SELECT * FROM tbl_admin WHERE email = '$email'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $title = 'Error!';
        $messages = 'Email is already taken. Please use a different email.';
        $modal_id = 'statusErrorsModal';
    } else {
        $query = "INSERT INTO tbl_admin (firstname, lastname, phonenumber, email, password) VALUES ('$firstname', '$lastname', '$phonenumber', '$email', '$password');";
        $run = mysqli_query($conn, $query);

        if ($run) {
            $title = 'Success!';
            $messages = 'Account Successfully Created!';
            $modal_id = 'statusSuccessModal';

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'dyeemraker17@gmail.com';
                $mail->Password = 'eazoryzxhbpuywhb';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('dyeemraker17@gmail.com', 'CoffeeHub');
                $mail->addAddress($email); 

                $mail->isHTML(true);
                $mail->Subject = 'Admin Confirmation';
                $mail->Body    = "
                    <h1>Welcome Admin, $firstname!</h1>
                    <p>We are happy to Welcome you in our Company!! </p>



                    
                    <p>Very Demure, Very Cutesy</p>

                ";

                $mail->send();
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
            echo "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var modal = new bootstrap.Modal(document.getElementById('$modal_id'));
                    modal.show();
                    setTimeout(function() {
                        window.location.href = 'adminlogin.php';
                    }, 3000); // 3 seconds delay
                });
            </script>
            ";
            
        } else {
            $title = 'Error!';
            $messages = 'Error: ' . mysqli_error($conn);
            $modal_id = 'statusErrorsModal';
        }
    }

    echo "
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = new bootstrap.Modal(document.getElementById('$modal_id'));
        });
    </script>
    ";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/adminsignup.css">
    <link rel="stylesheet" href="../css/style.css">

    <title>Admin Sign Up</title>
</head>
<body>
    <div class="container">
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <!-- log in section -->
            <div class="row p-1 box-area">
                <!-- left box -->
                <div class="col-md-6 rounded-5 d-flex justify-content-center align-items-center flex-column left-box ">
                    
                    <h2>Coffee Hub</h2>
                    <small class="text-wrap text-center" style="width:18rem; font-size: .8rem;">Very Demure, Very Mindful</small>
                </div>

                <!-- right box -->
                <div class="col-md-6 right-box rounded-5 ">
                    <div class="row align-items-center d-flex justify-content-center">
                        <div class="header-text mb-4 text-center">
                            <h1>Create Admin?</h1>
                            <!-- <h6 class="sentence">Join our coffee community and get a taste of exclusive deals, fresh brews, and more—sign up today</h6> -->
                        </div>
                        <form action="" method="post" autocomplete="off">
                            <div class="input-group mb-3 d-flex">
                                <input type="text" class="form-control form-control-md " style="margin-right: 10px" placeholder="First Name" name="firstname" required>
                                <input type="text" class="form-control form-control-md ml-2" style="margin-left: 10px" placeholder="Last Name"name="lastname" required>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control form-control-md" placeholder="Phone Number" name="telephone" required>
                            </div>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control form-control-md" placeholder="Email Address" name="email" required>
                            </div>
                            <div class="input-group mb-4">
                                <input type="password" class="form-control form-control-md" placeholder="Password" name="password" required id="password">
                                <span class="input-group-text">
                                    <i class="fa fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                                </span>
                            </div>
                            <div class="input-group mb-3 d-flex justify-content-center">
                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-lg fs-6 btn-light" id="button" name="submit">Sign Up</button>
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
                                        <p class="mt-3 text-dark"><?php echo isset($messages) ? $messages : ''; ?></p>
                                        <button type="button" class="btn btn-sm mt-3 btn-success" data-bs-dismiss="modal">Ok</button> 
                                    </div> 
                                </div> 
                            </div> 
                        </div>
                        <!-- modal for password not match -->
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
                                <small>Already have an account? <a href="adminlogin.php" class="" style="color:#2C1A11;">Log in Here</a></small>
                            </div>
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

        this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
