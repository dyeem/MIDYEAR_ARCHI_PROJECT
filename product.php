<?php 
session_start();
include 'connect.php';

    if (!isset($_SESSION['customer_id'])) {
        header('Location: login.php');
        exit();
    }

    if (isset($_POST['addtocart'])) {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_stock = $_POST['product_stock'];
        $product_quantity = 1;

        $customer_id = $_SESSION['customer_id'];    

        $select_cart = mysqli_query($conn, "SELECT * FROM cart_tbl WHERE product_id = $product_id AND customer_id = '$customer_id'");

        if (mysqli_num_rows($select_cart) > 0) {
            $fetch_cart = mysqli_fetch_assoc($select_cart);
            $new_quantity = $fetch_cart['product_quantity'] + $product_quantity;

            mysqli_query($conn, "UPDATE cart_tbl SET product_quantity = '$new_quantity' WHERE product_id = '$product_id' AND customer_id = '$customer_id'");
            $_SESSION['alert_addtocart'] = "Product quantity updated in the cart.";
        } else {
            mysqli_query($conn, "INSERT INTO cart_tbl (customer_id, product_id, product_name, product_image, product_price, product_quantity) VALUES ('$customer_id','$product_id','$product_name','$product_image','$product_price','$product_quantity')");
            $_SESSION['alert_addtocart'] = "Product successfully added to cart.";
        }
    };

    if (isset($_POST['deletebtn'])) {
        $cart_id =$_POST['deletecaritem'];
        $customer_id = $_SESSION['customer_id'];
        
        $query = mysqli_query($conn, "DELETE FROM cart_tbl WHERE id = '$cart_id'");
    
        if ($query) {
            $_SESSION['alert_addtocart'] = "Item Removed from the cart";
        } else {
            $_SESSION['alert_addtocart'] = "Failed to remove item from the cart";
        }
    
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
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

    <style>
        .delete-btn{
            background-color: #2C1A11;
            color: #E9E9E9;

        }
        .table{
            th{
                font-family: "Poppins", sans-serif;
            }
            td{
                font-family: "Poppins", sans-serif;
            }
            tfoot strong{
                font-weight: 500;

            }
        }
    </style>
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
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- CART MODAL -->
        <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title-container">
                            <h5 class="modal-title" id="cartModalLabel" style="color: #2C1A11;">
                                <i class="fa-solid fa-cart-shopping"></i> Cart
                            </h5>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-light table-hover">
                            <thead class="table">
                                <tr class="text-center">
                                    <th>Id</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php
                                    $customer_id = $_SESSION['customer_id'];
                                    $query = "SELECT * FROM cart_tbl WHERE customer_id = $customer_id";
                                    $run = mysqli_query($conn, $query);

                                    $totalQuantity = 0; 
                                    $totalPrice = 0;

                                    if (mysqli_num_rows($run) > 0){
                                        foreach($run as $cart){
                                            $totalPrice += $cart['product_price'] * $cart['product_quantity']; 
                                ?>
                                        <tr class="text-center">
                                            <td><?= $cart ['id']; ?></td>
                                            <td><?= $cart ['product_name']; ?></td>
                                            <td><?= $cart ['product_price']; ?></td>
                                            <td><?= $cart ['product_quantity']; ?></td>
                                            <td>
                                            <form action="" method="post">
                                                <input type="hidden" name="deletecaritem" value="<?= $cart['id']; ?>">
                                                <button type="submit" class="btn delete-btn" name="deletebtn">x</button>
                                            </form>
                                            </td>
                                        </tr>
                                <?php
                                        }
                                    }else{
                                    }
                                ?>
                            </tbody>
                            <tfoot class="table-light" id="tfoot">
                                <tr class="text-center">
                                    <td colspan="2"></td>
                                    <td colspan="2"><strong>Total:</strong></td>
                                    <td><strong>₱<?= number_format($totalPrice, 2); ?></strong></td>
                                </tr>
                            </tfoot>
                        </table>  
                    </div> 

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="admin/pages/checkoutform.php" class="btn gotocart">Go to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- PRODUCTS HEADER-->
        <div class="row g-0" id="products">
            <div class="col-12">
                <div class="container mt-4">
                    <p class="title"><i class="fa-solid fa-tag"></i> Products</p>
                    <?php include 'alert_addtocart.php';?>
                    <div class="container">
                        <div class="row justify-content-end">
                            <div class="col-auto cart">
                                <button class="btn-cart position-relative" data-bs-toggle="modal" data-bs-target="#cartModal">
                                    <i class="fa-solid fa-cart-shopping"></i>CART<span class="badge top-0  translate-middle start-100 bg-danger position-absolute notif rounded-pill">
                                        <?php 
                                            $totalitem = 0;
                                            $customer_id = $_SESSION['customer_id'];
                                            $query = "SELECT * FROM cart_tbl WHERE customer_id = $customer_id";
                                            $totalitem = mysqli_query($conn, $query);
       
                                            if(mysqli_num_rows($run) > 0) {
                                               $totalitem = mysqli_num_rows($totalitem);
                                               echo $totalitem;
                                            }else{
                                                echo 0;
                                            }
                                        ?>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- PRODUCTS SHOWCASE -->
                    <div class="container products">
                        <div class="row mt-3">
                            <?php 
                                $products = mysqli_query($conn, "SELECT * FROM products; ");
                                if(mysqli_num_rows($products) > 0) {
                                    while($fetch_product = mysqli_fetch_assoc($products)) {
                            ?>
                                <div class="col-3 mt-3 mb-3">
                                    <div class="card text-center">
                                        <form action="" method="post">
                                            <input type="hidden" name="product_name" value="<?= $fetch_product['name']; ?>">
                                            <input type="hidden" name="product_price" value="<?= $fetch_product['price']; ?>">
                                            <input type="hidden" name="product_image" value="<?= $fetch_product['image']; ?>">
                                            <input type="hidden" name="product_stock" value="<?= $fetch_product['stock']; ?>">
                                            <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">

                                            <a href="admin/pages/ViewProducts.php?id=<?= $fetch_product['id']; ?>">
                                                <div class="img-wrapper">
                                                    <img src="admin/movedimages/<?= basename($fetch_product['image']); ?>" name="product_image" alt="test" class="imgproduct">
                                                </div>
                                            </a>
                                            <div class="card-body">
                                                <h5 class="card-title" ><?=$fetch_product['name'];?></h5>
                                                <p class="card-text" >Price:  ₱<?=$fetch_product['price'];?></p>
                                                <p class="card-price">Stock: <?=$fetch_product['stock'];?></p>
                                               
                                                <button class="btn " type="submit" name="addtocart" id="addtocart">
                                                    Add to Cart
                                                </button>;
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php
                                    };
                                }else{
                                    $_SESSION['alert_product'] = "NO RECORD FROM THE DATABASE";
                                };
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>