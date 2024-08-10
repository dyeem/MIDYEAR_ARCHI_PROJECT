<?php
session_start();
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="login.css">
    <title>Log in</title>
</head>
<body>
    <!-- main container -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <!-- log in section -->
        <div class="row p-1 box-area">
            <!-- left box -->
            <div class="col-md-6 rounded-5 d-flex justify-content-center align-items-center flex-column left-box ">
                <div class="featured-image">
                    <img src="images/LBOX.png" class="img-fluid" alt="lbox" id="lboximg">
                </div>
                <h2> Want A Coffee?</h2>
                <small class="text-wrap" style="width:18rem"> Find the best Coffee to accompany your days</small>
            </div>

            <!-- right box -->
            <div class="col-md-6 right-box rounded-5 ">
                <div class="row align-items-center d-flex justify-content-center">
                    <div class="header-text mb-4 text-center">
                        <h1>Welcome back!</h1>
                        <h6 class="fs-6">We are happy to have you back</h6>
                    </div>
                    <form action="connect.php" method="post" autocomplete="off">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-md" placeholder="Email Address" name="email" required>
                        </div>
                        <div class="input-group mb-1">
                            <input type="password" class="form-control form-control-md" placeholder="Password" name="password" required>
                        </div>
                        <div class="input-group mb-5 d-flex justify-content-between" id="formCheck">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input">
                                <label for="formCheck" class="form-check-label text-light ">Remember Me?</label>
                            </div>
                            <div class="forgot">
                                <small ><a href="" class="text-light">Forgot Password</a></small>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <button type="submit" class="btn btn-lg w-100 fs-6 btn-light" value="Register"> login</button>
                        </div>
                    </form>
                    <div class="input-group mb-3 d-flex justify-content-center">
                        <div class="input-group mb-3">
                            <button class="btn btn-lg w-100 fs-6"><img src="images/g.png" style="width:30px" class="me-2"><small class="text-light" id="signup">Sign In with Google</small></button>
                        </div>
                        <div class="row">
                            <small class="">Don't have a Account? <a href="signup.php" class="text-light"> Sign Up here</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelector("form").addEventListener("submit", function(event) {
            const email = document.querySelector('input[name="email"]').value;
            const password = document.querySelector('input[name="password"]').value;

            // Basic email format validation
            const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                event.preventDefault();
                return;
            }

            // Password length validation (e.g., minimum 8 characters)
            if (password.trim() === "") {
                alert("Password cannot be empty.");
                event.preventDefault();
                return;
            }
        });
    </script>
</body>
</html>