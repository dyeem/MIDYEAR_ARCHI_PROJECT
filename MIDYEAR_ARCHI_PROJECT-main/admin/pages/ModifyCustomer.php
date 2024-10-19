<?php 
session_start();
include '../../connect.php';

    if(isset($_POST['editcustomer'])){
        $cus_id = mysqli_real_escape_string($conn, $_POST['cus-id']);
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $query = "UPDATE usersaccount SET firstname='$firstname', lastname='$lastname', gender='$gender', phonenumber='$telephone', email='$email', password='$password' WHERE id='$cus_id'";


        $run = mysqli_query($conn, $query);

        if ($run) {
            $_SESSION['alertcus'] = "Customer Information Updated Successfully";
            header("Location: /MIDYEAR_ARCHI_PROJECT/admin/admin.php");
            exit(0);
        } else {
            $_SESSION['alertcus'] = "Customer Not Updated Successfully";
            header("Location: /MIDYEAR_ARCHI_PROJECT/admin/admin.php");
            exit(0);
        }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap');

        body{
            background-image: url(../../images/homebg.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
        }

        .form{
            font-family: "Josefin Sans", sans-serif;
        }
        .box-area{
            border-radius: 30px;
            box-shadow: 10px 20px 40px rgba(0, 0, 0, 0.2), 10px 20px 40px rgba(0, 0, 0, 0.19);
            padding-bottom: 3%;
            background-color: rgba(255, 255, 255, 0.2); /* Slight transparency */
            backdrop-filter: blur(10px); /* Adjust the blur amount as needed */
            
            input{
                padding-left: 4%;
                padding-right: 4%;
                font-size: 100%;
                border: black 1px solid;
            }
            select{
                border: black 1px solid;
            }

            form #leftbtn{
                margin-right: 3%;
                border-radius: 14px;
                box-shadow: 10px 20px 40px rgba(0, 0, 0, 0.2), 10px 20px 40px rgba(0, 0, 0, 0.19);
            }
            form #rightbtn{
                border-radius: 14px;
                box-shadow: 10px 20px 40px rgba(0, 0, 0, 0.2), 10px 20px 40px rgba(0, 0, 0, 0.19);
            }
        }
    </style>
</head>
<body>
    <div class="row d-flex align-items-center justify-content-center min-vh-100 ">
        <div class="col-4 ">
            <div class="container box-area mt-5">
                <?php
                    if(isset($_GET['id'])){
                        $cus_id = mysqli_real_escape_string($conn,$_GET['id']);
                        $query = "SELECT * FROM usersaccount WHERE id = '$cus_id'";
                        $run = mysqli_query($conn, $query);

                        if(mysqli_num_rows($run) > 0){
                            $customer = mysqli_fetch_array($run);
                            ?>

                            <form action="" class="form" method="post" autocomplete="off">

                                <div class="d-flex flex-column align-items-center justify-content-center text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g class="nc-icon-wrapper" fill="#1b1c1d" stroke-linejoin="round" stroke-linecap="round"><path d="M19,9H7c-2.209,0-4,1.791-4,4v28c0,2.209,1.791,4,4,4h28c2.209,0,4-1.791,4-4v-12" fill="none" stroke="#1b1c1d" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"></path><line data-cap="butt" data-color="color-2" x1="33" y1="8" x2="40" y2="15" fill="none" stroke="#1b1c1d" stroke-miterlimit="10" stroke-width="2"></line><polygon data-color="color-2" points="23 32 13 35 16 25 38 3 45 10 23 32" fill="none" stroke="#1b1c1d" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"></polygon></g></svg>
                                    <h4>Edit a Customer</h4>
                                </div>
                                <input type="hidden" class="form-control form-control-md mb-2" name="cus-id" value="<?= $customer['ID']?>" id="id">
                                <div class="input-group mb-3 d-flex">
                                    <input type="text" class="form-control form-control-md " style="margin-right: 10px" placeholder="Firstname" name="firstname" value="<?= $customer['firstname'];?>" required autocomplete="off">
                                    <input type="text" class="form-control form-control-md ml-2" style="margin-left: 10px" placeholder="Lastname" name="lastname" value="<?= $customer['lastname'];?>" required autocomplete="off">
                                    <select class="form-select form-control form-control-md ml-2" style="margin-left: 10px"  aria-label="Default select example" name="gender" required>
                                        <option selected><?= $customer['gender'];?></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control form-control-md" placeholder="Email Address" name="email" value="<?= $customer['email'];?>" required autocomplete="off">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control form-control-md" placeholder="Phone Number" name="telephone" value="<?= $customer['phonenumber'];?>" required autocomplete="off">
                                </div>
                                <div class="input-group mb-4">
                                    <input type="password" class="form-control form-control-md" placeholder="Password" value="<?= $customer['password'];?>" id="password" name="password" required autocomplete="off">
                                    <span class="input-group-text">
                                        <i class="fa fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                                    </span>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <a href="../admin.php" type="button" class="btn btn-lg mt-3 btn-danger" id="leftbtn">Cancel</a>
                                    <button type="submit" class="btn btn-lg mt-3 btn-success" name="editcustomer" id="rightbtn">Done</button>
                                </div>
                            </form>
                            <?php
                            
                        }else{

                        }
                    }
                ?>
            </div>
        </div>
    </div>
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
