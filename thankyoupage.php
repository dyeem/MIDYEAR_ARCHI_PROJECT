<?php
    include 'connect.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap');

        body{
            background-image: url("images/homebg.jpg");
            background-size: cover; 
            background-repeat: no-repeat; 
            background-position: center ; 
            background-attachment: fixed;
        }

        .fa-envelope-circle-check {
            font-size: 7rem;
            color: #2C1A11; 
        }

        .card-custom {
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(1px); 
            border: 1px solid rgba(255, 255, 255, 0.2); 
        }
        .body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .text-center-custom {
            text-align: center;
        }

        button {
            background-color: #2C1A11; 
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        button:hover {
            background-color: #855C47; 
        }

        h5,p,a{
            font-family: "Poppins", sans-serif;
        }
    </style>
</head>
<body>
    <div class="container-fluid body text-center-custom">
        <div class="card card-custom text-center-custom">
            <div class="row mb-4">
                <div class="col-lg-12">
                    <i class="fa-solid fa-envelope-circle-check"></i>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-12">
                    <h5>Thank you, <?= htmlspecialchars($_SESSION['customername']); ?>!</h5>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-12">
                    <p>We sent the Summary email to your Google Mail. Kindly check it.</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-12">
                    <a href="homepagelst.php"><button>< Back to Home</button></a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p>If you didn't receive any mail, contact <a href="mailto:coffeehub.tc.ph@gmail.com" style="color: #2C1A11; font-weight: 600;">coffeehub.tc.ph@gmail.com</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
