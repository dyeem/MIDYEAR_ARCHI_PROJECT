<?php
session_start();
    include '../../connect.php'; 
    require 'PHPMailer-master/src/Exception.php';
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $customerId = $_SESSION['customer_id'] ?? null;
    if (!$customerId) {
        die('Customer ID is not set.');
    }

    if (isset($_POST['submit'])) {
        // Retrieve cart items
        $query = "
            SELECT product_name, product_quantity, product_price
            FROM cart_tbl
            WHERE customer_id = ?
        ";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $customerId);
        $stmt->execute();
        $result = $stmt->get_result();
        $cartItems = $result->fetch_all(MYSQLI_ASSOC);

        if (!$cartItems) {
            die('No items found in the cart.');
        }

        // Retrieve form data
        $paymentMethod = $_POST['payment_method'] ?? null;
        $firstName = $_POST['fname'] ?? null;
        $lastName = $_POST['lname'] ?? null;
        $phone = $_POST['phone'] ?? null;
        $zipcode = $_POST['zipcode'] ?? null;
        $address1 = $_POST['address1'] ?? null;
        $address2 = $_POST['address2'] ?? null;

        if (!$paymentMethod || !$firstName || !$lastName || !$phone || !$zipcode || !$address1 || !$address2) {
            die('All fields are required.');
        }

        // Aggregate cart items
        $productNames = [];
        $totalAmount = 0;
        $totalitem = 0;


        foreach ($cartItems as $item) {
            $subtotal = $item['product_quantity'] * $item['product_price'];
            $totalitem += $item['product_quantity'];
            $totalAmount += $subtotal;
            $productNames[] = $item['product_name'];
        }

        $productNamesString = implode(', ', $productNames);

        // Insert data into transactions table
        $insertQuery = "
            INSERT INTO transaction (customer_id, product_name, quantity, subtotal, payment_method, first_name, last_name, phone, zipcode, address1, address2, transaction_date)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ";

        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param('isidsssssss', 
            $customerId, 
            $productNamesString, 
            $totalitem, 
            $subtotal, 
            $paymentMethod, 
            $firstName, 
            $lastName, 
            $phone, 
            $zipcode, 
            $address1, 
            $address2
        );
        $stmt->execute();

        $deleteQuery = "DELETE FROM cart_tbl WHERE customer_id = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param('i', $customerId);
        $stmt->execute();

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
            $mail->addAddress($_SESSION["customeremail"]); 

            $mail->isHTML(true);
            $mail->Subject = 'Order Confirmation';
            $mail->Body    = "
                <h1>Thank you for your order!</h1>
                <p>We are happy to serve you! and please do remember that you have a special place in our Heart! <3</p>
                <p>Happy Palpitation!</p>
                <p>But, Here are the details:</p>
                <p>Products: $productNamesString</p>
                <p>Total Amount: ₱" . number_format($totalAmount, 2) . "</p>
                <p>Mode of Payments:  $paymentMethod </p>

                
                <p>Very Demure, Very Cutesy. </p>
            ";

            $mail->send();
            echo 'Message has been sent';
            header("location: ../../thankyoupage.php");
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../css/payment.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row" id="ultraheader">
            <div class="col-3 g-0" >
                <nav class="navbar">
                    <a href="../../homepagelst.php"><img src="../../images/logo.png" alt="" class="logo"></a>
                </nav>
                <div >
                    <p class="brand-title">Coffee Hub </p>
                </div>
            </div>
        </div>
        <!-- BREADCRUMB -->
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb" class="breadcrumbnav">
                    <ol class="breadcrumb" >
                        <li class="breadcrumb-item" id="usod">
                            <a href="../../product.php" id="breadlink" class="link">PRODUCT</a>
                        </li>
                        <li class="breadcrumb-item " >
                            <a href="checkoutform.php" id="breadlink">CHECKOUT FORM</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"id="breadlink">
                            PAYMENT FORM
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- HEADER -->
        <div class="row body">
            <div class="col-lg-9 col-md-6" id="leftside">
                <div class="row title">
                    <div class="col-lg-12" >
                        <div class="container" >
                            <div class="row" id="headertitle">
                                <div class="col-md-8">
                                    <p class="titlepay"><i class="fa-solid fa-file-invoice-dollar"></i> PAYMENT FORM</p>
                                </div>
                                <div class="col-md-4">
                                <p class="fw-bold"> 
                                    Order Subtotal (<?=$_SESSION['totalitem']?> items): ₱ <?= number_format($_SESSION ['subtotal'],2) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="container">
                        <div class="col-lg-9 mx-auto mb-4" id="innerleft">
                            <div class="container  innerleft">
                                <h5 class="lake pb-1">Delivery Address</h5>
                                <p class="liit">Please Input Your Valid Credentials</p>
                                <p class="liit pt-1">*Indicates required field</p>
                            </div>
                            <div class="container">
                                <form action="" method="post">
                                    <div class="container" id="form">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="fname" class="form-label">FIRST NAME*</label>
                                                <input type="text" class="form-control" id="fname" placeholder="" name="fname" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="lname" class="form-label">LAST NAME*</label>
                                                <input type="text" class="form-control" id="lname" placeholder="" name="lname" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="phone" class="form-label">PHONE NUMBER*</label>
                                                <input type="text" class="form-control" id="phone" placeholder="" name="phone" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="zipcode" class="form-label">ZIP CODE*</label>
                                                <input type="text" class="form-control" id="zipcode" placeholder="" name="zipcode" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="add1" class="form-label">ADDRESS - PROVINCE, CITY, BARANGAY*</label>
                                                <input type="text" class="form-control" id="add1" placeholder="" name="address1" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="add2" class="form-label">ADDRESS - STREET NAME, BUILDING, HOUSE NO.*</label>
                                                <input type="text" class="form-control" id="add2" placeholder="" name="address2" required>
                                            </div>
                                        </div>
                                        <!-- PAYMENT -->
                                        <div class="row">
                                            <div class="container  innerleft">
                                                <h5 class="lake pb-1">Payment Details</h5>
                                                <p class="liit pt-1">Please Specify Your Mode of Payment </p>
                                            </div>
                                            <div class="container">
                                                <div class="row payment">
                                                    <div class="col-md-6 mb-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="COD" required>
                                                            <label class="form-check-label" for="cod">
                                                                Cash On Delivery
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="payment_method" id="op" value="OP" required>
                                                            <label class="form-check-label" for="op">
                                                                Online Payment
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class=" col-lg-6 mb-5 mx-auto">
                                                <button class="" type="submit" name="submit" id="button">
                                                    Complete Payment
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <!-- SUMMARY -->
            <div class="col-lg-3 col-md-6 badgeq">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="container" id="rightside">
                            <h5 class="righttitle"><i class="fa-solid fa-clipboard-list"></i> SUMMARY</h5>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="container d-flex justify-content-between">
                            <p class="summarydetails">Subtotal:</p>
                            <p class="summarydetails"> ₱ <?= number_format($_SESSION['subtotal'],2);?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="container d-flex justify-content-between">
                            <p class="summarydetails">Shipping:</p>
                            <p class="summarydetails">+ 38</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="container d-flex justify-content-between">
                            <p class="summarydetails">Estimated tax:</p>
                            <p class="summarydetails">---</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 ">
                        <div class="container total d-flex justify-content-between">
                            <strong>
                                <p class="summarydetails">Total:</p>
                            </strong>
                            <strong>
                                <p class="summarydetails"> ₱ <?= number_format($_SESSION['totalprice'],2);?></p>
                            </strong>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 ">
                        <div class="container righttitle mt-3">
                            <p><i class="fa-solid fa-cart-shopping"></i> Cart <span style="font-size: 1rem;">(<?= $_SESSION['totalitem'];?> items)</span></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" >
                        <?php 
                            $customer_id = $_SESSION['customer_id'];
                            $query = mysqli_query($conn, "SELECT * FROM cart_tbl WHERE customer_id = $customer_id");
                            if(mysqli_num_rows($query) > 0){
                                foreach($query as $cart){
                                    $prod_id = $cart['product_id']; 
                                    $prod_query = mysqli_query($conn, "SELECT stock FROM product_tbl WHERE id = $prod_id");
                                    $prod_data = mysqli_fetch_assoc($prod_query);
                                    $prodstock = $prod_data['stock'];
                        ?>
                        <div class="container mt-2 " id="prod">
                            <div class="row ">
                                <div class="col-lg-4">
                                    <div class="img-wrapper">
                                        <img src="../<?= $cart['product_image']; ?>" alt="product" class="product-image"> 
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <p class="cartproductheader"><?= $cart['product_name'];?></p>
                                            
                                        </div>
                                        <div class="col-lg-5">
                                            <p class="cartproductheader">₱ <?= number_format($cart['product_price'],2);?></p>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p class="mid">Size: 22oz </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p class="mid"><?= $cart['product_quantity'];?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-12">
                        <div class="container">
                            <div class="row">
                                <div class="col-7">
                                    <p class="big">Need help?</p>
                                    <a href="" class="contactlink">Contact Us!</a>
                                    <p class="needhelp">Call Us</p>
                                    <p class="needhelp">+64 912384523</p>
                                    <p class="last">Mon-Fri 8am-6am EST </p>
                                </div>
                                <div class="col-5">
                                    <div class="img-wrapper">
                                        <a href="../../homepagelst.php">
                                            <img src="../../images/logo.png" alt="logo" class="img">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>