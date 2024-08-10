<?php
    include 'connect.php';
    
    if (isset($_POST['submit'])) {
        // Retrieve and sanitize form inputs
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        
        // Check if email already exists
        $checker = mysqli_query($conn, "SELECT * FROM usersaccount WHERE email = '$email'");
        
        if (mysqli_num_rows($checker) > 0) {
            $message = 'Email is already taken!';
            $modal_id = 'errorModal';
        } else {
            
            $sql = "INSERT INTO usersaccount (firstname, lastname, gender, phonenumber, email, password) VALUES ('$firstname', '$lastname', '$gender', '$telephone', '$email', '$password')";
            
            if (mysqli_query($conn, $sql)) {
                $message = 'Account creation successful!';
                $modal_id = 'successModal';
            } else {
                $message = 'Error: ' . mysqli_error($conn);
                $modal_id = 'errorModal';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="container">
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <!-- log in section -->
            <div class="row p-1 box-area">
                <!-- left box -->
                <div class="col-md-6 rounded-5 d-flex justify-content-center align-items-center flex-column left-box ">
                    <div class="featured-image">
                        <img src="images/products/1.png" class="img-fluid" alt="lbox" id="lboximg">
                    </div>
                    <h2> Want A Coffee?</h2>
                    <small class="text-wrap" style="width:18rem"> Find the best Coffee to accompany your days</small>
                </div>

                <!-- right box -->
                <div class="col-md-6 right-box rounded-5 ">
                    <div class="row align-items-center d-flex justify-content-center">
                        <div class="header-text mb-4 text-center">
                            <h1>Create Account?</h1>
                            <h6 class="sentence">Join our coffee community and get a taste of exclusive deals, fresh brews, and more—sign up today</h6>
                        </div>
                        <form action="" method="post" autocomplete="off">
                            <div class="input-group mb-3 d-flex">
                                <input type="text" class="form-control form-control-md " style="margin-right: 10px" placeholder="Firstname" name="firstname" required>
                                <input type="text" class="form-control form-control-md ml-2" style="margin-left: 10px" placeholder="Lastname"name="lastname" required>
                            </div>
                            
                            <div class="input-group mb-3">
                                <select class="form-select" aria-label="Default select example" name="gender" required>
                                    <option selected>Please select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control form-control-md" placeholder="Phone Number" name="telephone" required>
                            </div>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control form-control-md" placeholder="Email Address" name="email" required>
                            </div>
                            <div class="input-group mb-4">
                                <input type="password" class="form-control form-control-md" placeholder="Password"name="password" required>
                            </div>
                            <div class="input-group mb-3 d-flex justify-content-center">
                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-lg fs-6 btn-light" id="button" name="submit">Sign Up</button>
                            </div>
                        </form>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="successModalLabel">Success</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h3 class="text-success">Account Creation Success!</h3>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="errorModalLabel">Error</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h3 class="text-danger"><?php echo isset($message) ? $message : ''; ?></h3>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                                <small>Already have an account? <a href="login.php" class="text-light">Log in Here</a></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
