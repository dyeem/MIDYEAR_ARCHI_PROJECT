<?php 
    session_start();
    include '../../connect.php';

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
            $stmt->bind_param("dii", $cart_quantity, $id, $customer_id);
            $stmt->execute();
        } else {
            $insert_cart_query = "INSERT INTO cart_tbl (customer_id, product_id, product_name, product_image, product_price, product_quantity) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_cart_query);
            $stmt->bind_param("iissdi", $customer_id, $id, $product_name, $product_image, $product_price, $cart_quantity);
            $stmt->execute();
        }
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
    <?php
        if(isset($_GET['id'])){
            $product_id = mysqli_real_escape_string($conn,$_GET['id']);
            $query = "SELECT * FROM product_tbl WHERE id = '$product_id'";
            $run = mysqli_query($conn, $query);
    
            if(mysqli_num_rows($run) > 0){
                $product = mysqli_fetch_array($run);
    ?>
    <div class="container-fluid d-flex justify-content-center align-items-center ">
        <div class="row p-1 box-area">
            <!-- LEFT SIDE -->
            <div class="col-lg-6 col-md-4 rounded-5 left-box ">
                <div class="name">
                    <p class="vertical-text"><?=$product ['name']; ?></p>
                </div>
                <div class="featured-image mb-5 d-flex justify-content-center align-items-center flex-column">
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
                        <a href="../../product.php"><button class="btn fs-3">X</button></a>
                    </div>
                </div>
                <!-- PRODUCT NAME -->
                <div class="row align-items-center d-flex justify-content-center">
                    <div class="col-lg-12">
                        <p class="productname"><?=$product ['name']; ?></p>
                    </div>
                </div>
                <!-- DETAILS -->
                <div class="row mb-5">
                    <div class="col-lg-12">
                        <p class="details">Explore our coffee selection, where each blend offers a distinct flavor profile, from bold espressos to smooth lattes and refreshing cold brews, crafted to satisfy every coffee lover's taste. </p>
                    </div>
                </div>
                <!-- PRICE -->
                <div class="row mb-4 ">
                    <div class="container-fluid">
                        <div class="col-lg-12 pricesection">
                            <p class="pricename">Price</p>
                            <p class="price">₱ <?= number_format($product ['price'],2); ?></p>
                        </div>
                    </div>
                </div>
                <!-- QUANTITY -->
                <div class="row mb-5 ">
                    <div class="container-fluid ">
                        <p class="quantity ">Quantity</p>
                        <form action="" method="post">
                            <input type="hidden" name="product_name" value="<?= $product['name']; ?>">
                            <input type="hidden" name="product_price" value="<?= $product['price']; ?>">
                            <input type="hidden" name="product_image" value="<?= $product['image']; ?>">
                            <input type="hidden" name="product_stock" value="<?= $product['stock']; ?>">
                            <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                            <div class="col-lg-12 quantitysection">
                                <div class="input-group number-input">
                                    <button class="btn btn-outline-secondary minus-btn" type="button">-</button>
                                    <input type="number" id="quantity-<?= $product['id']; ?>" class="form-control text-center quantity-input" value="1" min="1" max="<?= $product['stock']; ?>" placeholder="">
                                    <button class="btn btn-outline-secondary plus-btn" type="button">+</button>
                                </div>
                                    <?php
                                            }
                                        }
                            
                                    ?>
                                <div class="button">
                                    <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                    <input type="hidden" id="cartquantity-<?= $product['id']; ?>" name="quantity">
                                    <button class="add2cartbtn" type="submit" name="submit">ADD TO CART</button>
                                </div>
                                <div class="avail text-center">
                                    <p class=""><i class="fa-solid fa-check" style="margin-right:.6rem;"></i> In Store Available </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
       
                <!-- FOOTER -->
                <div class="container text-center navi">
                    <div class="row ">
                        <div class="col-lg-3">
                            <a href="../../homepagelst.php">HOME</a>
                        </div>
                        <div class="col-lg-3">
                            <a href="../../product.php">PRODUCTS</a>
                        </div>
                        <div class="col-lg-3">
                            <a href="">ABOUT US</a>
                        </div>
                        <div class="col-lg-3">
                            <a href="">CONTACT US</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners to the minus buttons
    document.querySelectorAll('.minus-btn').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.nextElementSibling;
            let value = parseInt(input.value) || parseInt(input.min);
            if (value > parseInt(input.min)) {
                value--;
                input.value = value;
                updateHiddenQuantity(input);
            }
        });
    });

    // Add event listeners to the plus buttons
    document.querySelectorAll('.plus-btn').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.previousElementSibling;
            let value = parseInt(input.value) || parseInt(input.min);
            if (value < parseInt(input.max)) {
                value++;
                input.value = value;
                updateHiddenQuantity(input);
            }
        });
    });

    // Function to update the hidden quantity input field
    function updateHiddenQuantity(input) {
        const cartId = input.id.split('-')[1];
        const hiddenInput = document.getElementById("cartquantity-" + cartId);
        hiddenInput.value = input.value;
    }
});
</script>

</body>
</html>