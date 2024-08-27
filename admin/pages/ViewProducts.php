<?php 
session_start();
include '../../connect.php';

    if (!isset($_SESSION['customer_id'])) {
        header('Location: ../../login.php');
        exit();
    }

    if(isset($_POST['submit'])){
        $cart_quantity = $_POST['quantity'];
        $id = $_GET['id'];
        $customer_id = $_SESSION['customer_id'];

        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_stock = $_POST['product_stock'];

        $cart_check_query = "SELECT * FROM cart_tbl WHERE product_id = '$id' AND customer_id = '$customer_id'";
        $cart_check_result = mysqli_query($conn, $cart_check_query);

        if (mysqli_num_rows($cart_check_result) > 0) {
            $update_cart_query = "UPDATE cart_tbl SET product_quantity = product_quantity + ? WHERE product_id = ? AND customer_id = ?";
            $stmt = $conn->prepare($update_cart_query);
            $stmt->bind_param("iii", $cart_quantity, $id, $customer_id);
            $stmt->execute();
            $_SESSION['alertproduct.php'] = "Cart Product Quantity Updated.";
        } else {
            $insert_cart_query = "INSERT INTO cart_tbl (customer_id, product_id, product_name, product_image, product_price, product_quantity) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_cart_query);
            $stmt->bind_param("iissdi", $customer_id, $id, $product_name, $product_image, $product_price, $cart_quantity);
            $stmt->execute();
            $_SESSION['alertproduct.php'] = "Successfully Added to Cart.";
        }

        header("Location: " . $_SERVER['PHP_SELF'] . "?id=$id");
        exit;
    }

    if (isset($_POST['deletebtn'])) {
        $cart_id = $_POST['deletecaritem'];
        $customer_id = $_SESSION['customer_id'];
        $id = $_GET['id'];
        
        $query = mysqli_query($conn, "DELETE FROM cart_tbl WHERE id = '$cart_id'");
        
        if ($query) {
            $_SESSION['alert_addtocart'] = "Item Removed from the cart";
        } else {
            $_SESSION['alert_addtocart'] = "Failed to remove item from the cart";
        }
        
        header("Location: " . $_SERVER['PHP_SELF'] . "?id=$id");
        exit;
    }

    $customer_id = $_SESSION['customer_id'];

    if(isset($_GET['id'])){
        $product_id = mysqli_real_escape_string($conn,$_GET['id']);
        $query = "SELECT * FROM product_tbl WHERE id = '$product_id'";
        $run = mysqli_query($conn, $query);

        if(mysqli_num_rows($run) > 0){
            $product = mysqli_fetch_array($run);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$product['name']; ?></title>
    <?php
        }
    }
    ?>
    <link rel="stylesheet" href="../../css/viewproducts.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>
    <div class="row g-0">
        <div class="col-lg-12 col-md-12 col-sm-12"  style="margin:0; padding:0;">
            <nav class="navbar navbar-expand-lg bg-body-tertiary" >
                <div class="container-fluid text-center" id="navbar">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav sticky-top mx-auto mb-1 mb-lg-0">
                            <li class="nav-item ">
                                <a class="nav-link " href="../../homepagelst.php">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../../aboutus.php">ABOUT US</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="../../contactus.php">CONTACT US</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="../../product.php">PRODUCTS</a>
                            </li>
                            <li class= "nav-item">
                                <div class= "mod nav-link position-relative" data-bs-toggle="modal" data-bs-target="#cartModal">
                                    <i class="fa-solid fa-cart-shopping"></i>CART<span class="badge top-1  translate-middle start-100 bg-danger position-absolute notif rounded-pill">
                                        <?php 
                                            $totalitem = 0;
                                            $customer_id = $_SESSION['customer_id'];
                                            $query = "SELECT * FROM cart_tbl WHERE customer_id = $customer_id";
                                            $totalitem = mysqli_query($conn, $query);
    
                                            if(mysqli_num_rows($totalitem) > 0) {
                                            $totalitem = mysqli_num_rows($totalitem);
                                            echo $totalitem;
                                            }else{
                                                echo 0;
                                            }
                                        ?>
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <?php include 'alertproduct.php'; ?>
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
                    <a href="checkoutform.php" class="btn gotocart">Go to Checkout</a>
                </div>
            </div>
        </div>
    </div>
    <?php
        if(isset($_GET['id'])){
            $product_id = mysqli_real_escape_string($conn,$_GET['id']);
            $query = "SELECT * FROM product_tbl WHERE id = '$product_id'";
            $run = mysqli_query($conn, $query);
    
            if(mysqli_num_rows($run) > 0){
                $product = mysqli_fetch_array($run);
    ?>
    
    <div class="container-fluid d-flex justify-content-center align-items-center body"  style="margin:0; padding:0;">
        <div class="row box-area g-0">
            <!-- LEFT SIDE -->
            <div class="col-lg-6 col-md-4 rounded-5 left-box ">
                <div class="name">
                    <p class="vertical-text"><?=$product ['name']; ?></p>
                </div>
                <div class="featured-image mb-2 d-flex justify-content-center align-items-center flex-column">
                    <img src="../<?= $product['image']; ?>" class="img-fluid" alt="lbox" id="lboximg">
                </div>
                <div class="ft">
                    <div class="tot">
                        <p class="by">Very Demure, Very Cutesy</p>
                    </div>
                    <div class="foot">
                        <p class="brand">COFFEE HUB</p>
                    </div>
                </div>
            </div>

            <!-- right box -->
            <div class="col-lg-6 col-md-4 right-box rounded-5 ">
                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-end">
                        <a href="../../product.php"><button class="btn fs-3" style="color: #CCCCCC;">X</button></a>
                    </div>
                </div>
                <!-- PRODUCT NAME -->
                <div class="row align-items-center d-flex justify-content-center">
                    <div class="col-lg-12">
                        <p class="productname"  style="color: #CCCCCC;"><?=$product ['name']; ?></p>
                    </div>
                </div>
                <!-- DETAILS -->
                <div class="row mb-5">
                    <div class="col-lg-12">
                        <p class="details"  style="color: #CCCCCC;">Explore our coffee selection, where each blend offers a distinct flavor profile, from bold espressos to smooth lattes and refreshing cold brews, crafted to satisfy every coffee lover's taste. </p>
                    </div>
                </div>
                <!-- PRICE -->
                <div class="row mb-4 ">
                    <div class="container-fluid">
                        <div class="col-lg-12 pricesection">
                            <p class="pricename"  style="color: #CCCCCC;">Price</p>
                            <p class="price"  style="color: #CCCCCC;">₱ <?= number_format($product ['price'],2); ?></p>
                        </div>
                    </div>
                </div>
                <!-- QUANTITY -->
                <div class="row mb-5 ">
                    <div class="container-fluid innerquant">
                        <p class="quantity ">Quantity :</p>
                        <form action="" method="post">
                            <input type="hidden" name="product_name" value="<?= $product['name']; ?>">
                            <input type="hidden" name="product_price" value="<?= $product['price']; ?>">
                            <input type="hidden" name="product_image" value="<?= $product['image']; ?>">
                            <input type="hidden" name="product_stock" value="<?= $product['stock']; ?>">
                            <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                            <div class="col-lg-12 quantitysection">
                                <div class="input-group number-input">
                                    <button class="btn btn-outline-secondary minus-btn" type="button">-</button>
                                    <input type="number" id="quantity-<?= $product['id']; ?>" name="quantity" class="form-control text-center quantity-input" value="1" min="1" max="<?= $product['stock']; ?>">
                                    <button class="btn btn-outline-secondary plus-btn" type="button">+</button>
                                </div>
                                <?php
                                        }
                                    }
                                ?>
                            <div class="button">
                                <button class="add2cartbtn" type="submit" name="submit">ADD TO CART</button>
                            </div>
                            <div class="avail text-center">
                                <p style="color: #CCCCCC;"><i class="fa-solid fa-check" style="margin-right:.6rem; color: green;" ></i> In Store Available</p>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

 
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.minus-btn').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.nextElementSibling;
                let value = parseInt(input.value) || parseInt(input.min);
                if (value > parseInt(input.min)) {
                    value--;
                    input.value = value;
                }
            });
        });

        document.querySelectorAll('.plus-btn').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.previousElementSibling;
                let value = parseInt(input.value) || parseInt(input.min);
                if (value < parseInt(input.max)) {
                    value++;
                    input.value = value;
                }
            });
        });
    });
</script>
</body>
<footer>
    <div class="row d-flex justify-content-center align-items-center text-center">
        <div class="col-lg-12 col-md-6 col-sm-12">
            <div class="container-fluid ">
                <img src="../../images/logo.png" alt="test" class="img">
                <h4 class="coffeebrand">COFFEE HUB</h4>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center align-items-center text-center">
        <div class="col-lg-6 col-md-3 col-sm-12 ">
            <div class="container-fluid ">
              <p class="para">Coffee is the favorite drink of the civilized world. <br>— <i>Voltaire</i>  </p>
              
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <hr style="border: none; border-top: 2px solid white; width: 50%; margin: 10px auto;">
        </div>
    </div>  
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <nav class="navbar navbar-expand-lg" >
                <ul class="navbar-nav mx-auto mb-1 mb-lg-0">
                    <li class="nav-item ">
                        <a class="nav-link " href="../../homepagelst.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../aboutus.php">ABOUT US</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="../../contact.php">CONTACT US</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="../../product.php">PRODUCTS</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</footer>
</html>