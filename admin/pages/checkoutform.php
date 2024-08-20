<?php 
session_start();
include '../../connect.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Out</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../css/checkoutform.css">
</head>
<body>
    <div class="container-fluid">

        <div class="row g-0" id="ultraheader">
            <div class="col-3 g-0" >
                <nav class="navbar">
                    <a href="../../homepagelst.php"><img src="../../images/logo.png" alt="" class="logo"></a>
                </nav>
                <div >
                    <p class="brand-title">Coffee Hub </p>
                </div>
            </div>
        </div>

        <div class="row g-0" >
            <div class="col-12" >
                <nav aria-label="breadcrumb" class="breadcrumbnav">
                    <ol class="breadcrumb" >
                        <li class="breadcrumb-item" id="usod">
                            <a href="../../product.php" id="breadlink" class="link">PRODUCT</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="" id="breadlink">CHECKOUT FORM</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-12 title">
                <p class="titlepay"><i class="fa-solid fa-file-invoice"></i> CHECKOUT FORM</p>
            </div>
        </div>

        <div class="row">
            <div class="col-9">
                <div class="container">
                    <table class="table table-bordered table-light table-hover">
                        <thead class="table">
                            <tr class="text-center">
                                <th colspan="1">Product</th>
                                <th >Price</th>
                                <th >Quantity</th>
                                <th>Subtotal</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        
                        <tbody class="table-group-divider">
                        <?php
                            $totalPricee = 0;
                            $customer_id = $_SESSION['customer_id'];
                            $query = mysqli_query($conn, "SELECT * FROM cart_tbl WHERE customer_id = $customer_id");

                            if(mysqli_num_rows($query) > 0){
                                foreach($query as $cart){

                                    $subtotal = $cart['product_price'] * $cart['product_quantity']; 
                                    $totalPricee += $subtotal;
                           
                        ?>
                            <tr class="text-center align-middle">
                                <td colspan="1" style="padding: 10px;">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="img-wrapper">
                                            <img src="../<?= $cart['product_image']; ?>" class="img" alt="test">
                                        </div>
                                        <p class="text-center  product_name"><?= $cart ['product_name'];?></p>
                                    </div>
                                </td>
                                <td style="padding: 5px;"><?= $cart ['product_price'];?></td>
                                <td style="padding: 5px;"><?= $cart ['product_quantity'];?></td>
                                <td style="padding: 5px;"><?= $subtotal?></td>
                                <td style="padding: 5px;"><button class="btn removebtn">x</button></td>
                            </tr>
                        </tbody>
                        <?php 
                                }
                            }
            
                        ?>
                        <tfoot>
                            <tr class="text-center">
                                <td colspan="3"></td>
                            </tr>
                        </tfoot>
                    </table>
                   
                </div>
            </div>
           
            <div class="col-3">
                <div class="container checkoutbox">
                    <p class="header text-center">
                        <i class="fa-solid fa-bag-shopping"></i> Cart Totals
                    </p>    
                    <div class="d-flex justify-content-between" id="lefttotal">
                        <?php 
                            $customer_id = $_SESSION['customer_id'];
                            $query = mysqli_query($conn, "SELECT * FROM cart_tbl WHERE customer_id = $customer_id");
                            $totalPrice = 0;
                            $totalitem = 0;
                            $shipping = 38;

                            if(mysqli_num_rows($query) > 0){
                                foreach($query as $cart){
                                    $totalPrice += $cart['product_price'] * $cart['product_quantity']; 
                                    $totalitem +=  $cart['product_quantity'];
                                }
                            }else{

                            }

                            $totalPrice += $shipping;
                           
                        ?>
                        <p class="total fs-5 fw-bold">
                            Total:
                        </p>
                        <p class="total fs-5 fw-bold">
                            <?= number_format($totalPrice, 2); ?>
                        </p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="coupon fw-bold">
                            Items:
                        </p>
                        <p class="coupon">
                            <?= $totalitem;?>
                        </p>
                    </div>
                    <div class="d-flex justify-content-between" id="lefttotal">
                        <p class="coupon fw-bold">
                            Shipping:
                        </p>
                        <p class="coupon">
                            + <?= number_format($shipping, 2);?>
                        </p>
                    </div>
                    <?php 
                               
                    ?>
                    <div class="d-flex justify-content-center">
                        <a href="payment.php" style="color: #2C1A11;"><button class="btn buttonpay">Pay Now</button></a>
                    </div>
                </div>
            </div>
            <?php
            ?>
        </div>

        <div class="row" >
            <div class="container" id="continue">
                <div class="col-12">
                    <a href="../../product.php" class="continue">< Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>