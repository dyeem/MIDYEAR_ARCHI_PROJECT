<?php 
session_start();
include '../../connect.php';

if (isset($_POST['updatecheckout'])) {
    $cartIds = $_POST['cartid']; // Expecting an array of cart IDs
    $cartQuantities = $_POST['cartquantity']; // Expecting an associative array of quantities indexed by cart ID
    $customerid = $_SESSION['customer_id'];

    foreach ($cartIds as $index => $cartId) {
        $cartQuantity = $cartQuantities[$cartId];

        $sql = "UPDATE cart_tbl SET product_quantity = ? WHERE customer_id = ? AND id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $cartQuantity, $customerid, $cartId);

        if (!$stmt->execute()) {
            $_SESSION['alertproduct'] = "Quantity Failed to Update.";
            break;
        }
    }
    $_SESSION['alertproduct'] = "Quantity Updated Successfully.";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Out</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../../css/checkoutform.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row g-0" id="ultraheader">
            <div class="col-3 g-0">
                <nav class="navbar">
                    <a href="../../homepagelst.php"><img src="../../images/logo.png" alt="" class="logo"></a>
                </nav>
                <div>
                    <p class="brand-title">Coffee Hub</p>
                </div>
            </div>
        </div>
        <div class="container-fluid body">
            <div class="row g-0">
                <div class="col-12">
                    <nav aria-label="breadcrumb" class="breadcrumbnav">
                        <ol class="breadcrumb">
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

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="container">
                            <table class="table table-bordered table-light table-hover">
                                <thead class="table">
                                    <tr class="text-center">
                                        <th colspan="1">Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                
                                <tbody class="table-group-divider">
                                <?php
                                    $prod = mysqli_query($conn, "SELECT * FROM product_tbl");
                                    if(mysqli_num_rows($prod) > 0){
                                        foreach($prod as $result){
                                            $prodstock = $result['stock'];
                                        }
                                    }
                                ?>
                                <?php
                                    $totalPricee = 0;
                                    $customer_id = $_SESSION['customer_id'];
                                    $query = mysqli_query($conn, "SELECT * FROM cart_tbl WHERE customer_id = $customer_id");
                                    if(mysqli_num_rows($query) > 0){
                                        foreach($query as $cart){
                                            // Fetch the stock for the specific product in the cart
                                            $prod_id = $cart['product_id']; // assuming your cart_tbl has a product_id field
                                            $prod_query = mysqli_query($conn, "SELECT stock FROM product_tbl WHERE id = $prod_id");
                                            $prod_data = mysqli_fetch_assoc($prod_query);
                                            $prodstock = $prod_data['stock'];

                                            $subtotal = $cart['product_price'] * $cart['product_quantity'];
                                            $totalPricee += $subtotal;
                                ?>
                                        <tr class="text-center align-middle">
                                            <td colspan="1" style="padding: 10px;">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div class="img-wrapper">
                                                        <img src="../<?= $cart['product_image']; ?>" class="img" alt="test">
                                                    </div>
                                                    <p class="text-center  product_name"><?= $cart['product_name'];?></p>
                                                </div>
                                            </td>
                                            <td style="padding: 5px;"><?= $cart['product_price'];?></td>
                                            <td style="padding: 5px;">
                                                <div class="input-group number-input justify-content-center">
                                                    <button class="btn btn-outline-secondary minus-btn" type="button">-</button>
                                                    <input type="number" id="quantity-<?= $cart['id']; ?>" class="form-control text-center quantity-input" value="<?= $cart['product_quantity']; ?>" min="1" max="<?= $prodstock; ?>" placeholder="<?= $cart['product_quantity']; ?>">
                                                    <button class="btn btn-outline-secondary plus-btn" type="button">+</button>
                                                </div>
                                            </td>
                                            <td style="padding: 5px;"><?= number_format($subtotal,2); ?></td>
                                            <td style="padding: 5px;"><button class="btn removebtn">x</button></td>
                                        </tr>
                                    <?php
                                        }
                                    }
                                     ?>
                                </tbody>
                                <tfoot>
                                    <tr class="text-center subtotal-row">
                                        <td colspan="2"></td>
                                        <td colspan="1">Subtotal:</td>
                                        <td colspan="">₱ <?= number_format($totalPricee,2);?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="container" id="continue">
                            <div class="row footer">
                                <div class="col-lg-6">
                                    <a href="../../product.php" class="continue text-center">< Continue Shopping</a>
                                </div>
                                <div class="col-lg-6">
                                    <form action="" method="post" id="update-cart-form">
                                        <?php 
                                            // Reset pointer to get correct cart ID and quantity for each item
                                            $query->data_seek(0); 
                                            while ($cart = $query->fetch_assoc()) { 
                                        ?>
                                        <input type="hidden" id="cartquantity-<?= $cart['id']; ?>" name="cartquantity[<?= $cart['id']; ?>]" value="<?= $cart['product_quantity']; ?>">
                                        <input type="hidden" name="cartid[]" value="<?= $cart['id']; ?>">
                                        <?php } ?>
                                        <button type="submit" name="updatecheckout" class="continue">
                                            <i class="fa-solid fa-rotate-right"></i> Update Checkout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 ">
                        <div class="container checkoutbox">
                            <p class="header text-center">
                                <i class="fa-solid fa-bag-shopping"></i> Cart Totals
                            </p>    
                            <div class="d-flex justify-content-between" id="lefttotal">
                                <?php 
                                    $totalPrice = 0;
                                    $totalitem = 0;
                                    $shipping = 38;

                                    if(mysqli_num_rows($query) > 0){
                                        foreach($query as $cart){
                                            $totalPrice += $cart['product_price'] * $cart['product_quantity']; 
                                            $totalitem +=  $cart['product_quantity'];
                                        }
                                    }

                                    $totalPrice += $shipping;
                                
                                ?>
                                <p class="total fs-5 fw-bold">
                                    Total:
                                </p>
                                <p class="total fs-5 fw-bold">
                                    ₱ <?= number_format($totalPrice, 2); ?>
                                </p>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
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
                            <div class="d-flex justify-content-center">
                                <a href="payment.php" style="color: #2C1A11;"><button class="btn buttonpay">Pay Now</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
document.querySelectorAll('.minus-btn').forEach(button => {
    button.addEventListener('click', function() {
        const input = this.nextElementSibling;
        let value = parseInt(input.value) || parseInt(input.min);
        if (value > parseInt(input.min)) {
            value--;
            input.value = value;
            updateCartQuantity(input.id.split('-')[1]);
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
            updateCartQuantity(input.id.split('-')[1]);
        }
    });
});

function updateCartQuantity(cartId) {
    var quantity = document.getElementById("quantity-" + cartId).value;
    document.getElementById("cartquantity-" + cartId).value = quantity;
}

</script>
</body>
</html>
