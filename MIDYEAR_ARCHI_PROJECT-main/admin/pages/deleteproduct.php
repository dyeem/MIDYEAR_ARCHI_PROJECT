<?php
include '../connect.php';

if (isset($_POST['deleteproduct'])) {
    $product_id = $_POST['product_id'];

    $stmt = $conn->prepare("DELETE FROM product_tbl WHERE id = ?");
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        $_SESSION['alertproduct'] = "Product deleted successfully!";
    } else {
        $_SESSION['alertproduct'] = "Failed to delete the product!";
    }

    header("Location: ManageProduct.php");
    exit();
}
?>
