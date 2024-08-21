<fo?php 
    session_start();
    include '../../connect.php'

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
        <div class="row body">
            <div class="container">
                <div class="col-lg-7" id="leftside">
                    <div class="row title">
                        <div class="col-lg-12" >
                            <div class="container" >
                                <div class="row" id="headertitle">
                                    <div class="col-md-9">
                                        <p class="titlepay"><i class="fa-solid fa-file-invoice-dollar"></i> PAYMENT FORM</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="fw-bold"> Order Subtotal (items): ₱ </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container" >
                            <div class="col-lg-9 " id="innerleft">
                                <div class="container  innerleft">
                                    <h5 class="lake pb-1">Shipping Address</h5>
                                    <p class="liit">Please Input Your Existing Address</p>
                                    <p class="liit pt-1">*Indicates required field</p>
                                </div>
                                <div class="container">
                                    <form action="" method="post">
                                        <div class="container" id="form">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="fname" class="form-label">FIRST NAME*</label>
                                                    <input type="text" class="form-control" id="fname" placeholder="">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="lname" class="form-label">LAST NAME*</label>
                                                    <input type="text" class="form-control" id="lname" placeholder="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="phone" class="form-label">PHONE NUMBER*</label>
                                                    <input type="text" class="form-control" id="phone" placeholder="">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="zipcode" class="form-label">ZIP CODE*</label>
                                                    <input type="text" class="form-control" id="zipcode" placeholder="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="add1" class="form-label">ADDRESS - PROVINCE, CITY, BARANGAY*</label>
                                                    <input type="text" class="form-control" id="add1" placeholder="">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="add2" class="form-label">ADDRESS - STREET NAME, BUILDING, HOUSE NO.*</label>
                                                    <input type="text" class="form-control" id="add2" placeholder="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class=" col-md-6 mb-3 d-flex justify-content-center">
                                                    <button class="" type="submit" name="submit" id="button">Continue To Payment</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 badgeq">

                </div>
            </div>
        </div>
    </div>
</body>
</html>