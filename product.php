<?php 
session_start();
include 'connect.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container-fluid g-0">
        <!-- HEADER -->
        <div class="row g-0" id="ultraheader">
            <div class="col-3 g-0" >
                <nav class="navbar">
                    <a href="homepagelst.php"><img src="images/logo.png" alt="" class="logo"></a>
                </nav>
                <div >
                    <p class="brand-title">Coffee Hub </p>
                </div>
            </div>
            
        </div>
        <!-- NAVBAR -->
        <div class="row g-0" >
            <div class="col-12" >
                <nav class="navbar  navbar-expand-lg bg-body-tertiary" >
                    <div class="container-fluid text-center" id="navbar">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav sticky-top mx-auto mb-1 mb-lg-0">
                                <li class="nav-item ">
                                    <a class="nav-link " href="homepagelst.php">HOME</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="homepagelst.php">ABOUT US</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="">CONTACT US</a>
                                </li>
                                <li class="nav-item ">
                                    <div class="d-inline cart">
                                       
                                    </div>
                                 </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cartModalLabel"><i class="fa-solid fa-cart-shopping"></i> Cart</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Your modal content goes here -->
                        <p>Your cart items will be displayed here.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="cart.php" class="btn gotocart">Go to Cart</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- PRODUCTS HEADER-->
        <div class="row g-0" id="products">
            <div class="col-12">
                <div class="container mt-4">
                    <!-- <ul class="nav nav-tabs d-flex justify-content-center" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Ice</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Hot</button>
                        </li>
                        
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            ...
                        </div>
                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                            ...
                        </div>
                    </div> -->
                    <p class="title"><i class="fa-solid fa-tag"></i> Products</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-auto cart">
                    <button class="btn-cart" data-bs-toggle="modal" data-bs-target="#cartModal">
                        <span class=""><i class="fa-solid fa-cart-shopping"></i>CART</span>
                    </button>
                </div>
            </div>
        </div>
        <!-- PRODUCTS CONTENT -->
        <?php include 'alert_product.php';?>
        <div class="container products">
            <div class="box-container">
                <?php 
                    $products = mysqli_query($conn, "SELECT * FROM product_tbl ");
                    if(mysqli_num_rows($products) > 0) {
                        while($fetch_product = mysqli_fetch_assoc($products)) {
                ?>
                    <form action="" method="post">
                        <div class="box">
                            <img src="<?=$fetch_product['image'];?>" alt="" >
                            <p class="itemname"><?=$fetch_product['name'];?></p>
                            <p class="itemprice">Price:  ₱<?=$fetch_product['price'];?></p>
                            <p class="itemstock">Stock: <?=$fetch_product['stock'];?></p>
                            <input type="hidden" name="itemname" value="<?=$fetch_product['name'];?>">
                            <button class="btn" type="submit" name="addtocart">Add to Cart</button>
                        </div>
                    </form>
                <?php
                        };
                    }else{
                        $_SESSION['alert_product'] = "NO RECORD FROM THE DATABASE";
                    };
                ?>
            </div>
        </div>
    </div>
</body>
</html>