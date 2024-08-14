<?php 
session_start();
include '../../connect.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <form action="" method="post" autocomplete="off">
            <?php
                if(isset($_GET['id'])){
                    $admin_id = mysqli_real_escape_string($conn,$_GET['id']);
                    $query = "SELECT * FROM tbl_admin WHERE id = '$admin_id'";
                    $run = mysqli_query($conn, $query);

                    if(mysqli_num_rows($run) > 0){
                        $admin = mysqli_fetch_array($run);
                        print_r($admin);
                    }
                }
            ?>
            <div class="d-flex flex-column align-items-center justify-content-center text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g class="nc-icon-wrapper" fill="#1b1c1d" stroke-linejoin="round" stroke-linecap="round"><path d="M19,9H7c-2.209,0-4,1.791-4,4v28c0,2.209,1.791,4,4,4h28c2.209,0,4-1.791,4-4v-12" fill="none" stroke="#1b1c1d" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"></path><line data-cap="butt" data-color="color-2" x1="33" y1="8" x2="40" y2="15" fill="none" stroke="#1b1c1d" stroke-miterlimit="10" stroke-width="2"></line><polygon data-color="color-2" points="23 32 13 35 16 25 38 3 45 10 23 32" fill="none" stroke="#1b1c1d" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"></polygon></g></svg>
                <h4>Edit a Admin</h4>
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
</body>
</html>
