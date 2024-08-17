<?php 
session_start();
include '../../connect.php';

if (isset($_POST['addproduct'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $image = $_FILES['file']['name']; 

    $target = '../admin/movedimages/' . basename($image);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {

        // Prepare the SQL statement with placeholders
        $stmt = $conn->prepare("INSERT INTO product_tbl (name, image, price, stock) VALUES (?, ?, ?, ?)");
        
        // Bind parameters to the prepared statement
        $stmt->bind_param("ssdd", $name, $image, $price, $stock);

        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['alert'] = "Upload Success";
            header("Location: /MIDYEAR_ARCHI_PROJECT/admin/admin.php");
            exit(0);
            
        } else {
            $_SESSION['alert'] = "Upload not Success";
            header("Location: /MIDYEAR_ARCHI_PROJECT/admin/admin.php");
            exit(0);
        }

    } else {
        $_SESSION['alert'] = "FAILED";
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
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<div class="row d-flex align-items-center justify-content-center min-vh-100 ">
        <div class="col-4 ">
            <div class="container box-area mt-5">
                <?php
                    if(isset($_GET['id'])){
                        $prod_id = mysqli_real_escape_string($conn,$_GET['id']);
                        $query = "SELECT * FROM product_tbl WHERE id = '$prod_id'";
                        $run = mysqli_query($conn, $query);

                        if(mysqli_num_rows($run) > 0){
                            $product = mysqli_fetch_array($run);
                            ?>

                            <form action="" class="form" method="post" autocomplete="off" enctype="multipart/form-data">

                                <div class="d-flex flex-column align-items-center justify-content-center text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g class="nc-icon-wrapper" fill="#1b1c1d" stroke-linejoin="round" stroke-linecap="round"><path d="M19,9H7c-2.209,0-4,1.791-4,4v28c0,2.209,1.791,4,4,4h28c2.209,0,4-1.791,4-4v-12" fill="none" stroke="#1b1c1d" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"></path><line data-cap="butt" data-color="color-2" x1="33" y1="8" x2="40" y2="15" fill="none" stroke="#1b1c1d" stroke-miterlimit="10" stroke-width="2"></line><polygon data-color="color-2" points="23 32 13 35 16 25 38 3 45 10 23 32" fill="none" stroke="#1b1c1d" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"></polygon></g></svg>
                                    <h4>Edit a Product</h4>
                                </div>
                                <input type="hidden" class="form-control form-control-md mb-2" name="id" value="<?= $product['id']?>" id="id">
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control form-control-md" placeholder="Product Image" name="image" value="<?= $target. $product['image'];?>" required autocomplete="off">
                                </div>
                                <div class="input-group mb-3 d-flex">
                                    <input type="text" class="form-control form-control-md " style="margin-right: 10px" placeholder="Product Name" name="name" value="<?= $product['name'];?>" required autocomplete="off">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control form-control-md" placeholder="price" name="price" value="<?= $product['price'];?>" required autocomplete="off">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control form-control-md" placeholder="stock" name="stock" value="<?= $product['stock'];?>" required autocomplete="off">
                                </div>
                                <div class="d-flex justify-content-center">
                                    <a href="../admin.php" type="button" class="btn btn-lg mt-3 btn-danger" id="leftbtn">Cancel</a>
                                    <button type="submit" class="btn btn-lg mt-3 btn-success" name="editproduct" id="rightbtn">Done</button>
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
</body>
</html>