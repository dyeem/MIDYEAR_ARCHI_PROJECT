<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="css/contactus.css">
</head>
<body>
    <div class="container-fluid">
        <!-- HEADER -->
        <div class="row g-0 mb-5" id="ultraheader">
            <div class="col-3 g-0" >
                <nav class="navbar">
                    <a href="homepagelst.php"><img src="images/logo.png" alt="" class="logo"></a>
                </nav>
                <div >
                    <p class="brand-title">Coffee Hub </p>
                </div>
            </div>
        </div>
        <!-- MAIN CONTENT -->
        <div class="container">
            <div class="row">
                <!-- LEFT -->
                <div class="col-lg-5 col-md-12 col-sm-12 left d-flex align-items-center justify-content-center">
                    <form action="" method="post " autocomplete="off">
                        <div class="container ">
                            <div class="row mb-3">
                                <div class="col" >
                                    <label for="firstname" class="form-label">
                                        FIRST NAME*
                                    </label>
                                    <input type="text" class="form-control" id="firstname" placeholder="First name" aria-label="First name">
                                </div>
                                <div class="col">
                                    <label for="lastname" class="form-label">
                                        LAST NAME*
                                    </label>
                                    <input type="text" class="form-control" id="lastname" placeholder="Last name" aria-label="Last name">
                                </div>
                                </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                   EMAIL*
                                </label>
                                <input type="text" class="form-control" id="email" placeholder="Email Address">
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">
                                   MESSAGE*
                                </label>
                                <input type="text" class="form-control" id="message" placeholder="Message">
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">
                                    ADDITIONAL DETAILS
                                </label>
                                <textarea class="form-control" id="text-area" rows="3">
                                </textarea>
                            </div>
                            <div class="mb-3 d-flex justify-content-center align-items-center">
                                <button class="btn btn-secondary" type="submit" name="sendmessage">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- RIGHT -->
                <div class="col-lg-7 right">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="big">How Can We Help You?</p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-lg-12">
                                <p class="small">Please Select a topic below related to your inquiry. If you don't find what you need, fill out our contact form.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                1. What flavors of coffee products do you offer?
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                We offer a range of coffee flavors, from rich dark roasts and balanced medium roasts to light roasts. For those who prefer a sweeter cup, we also have options like vanilla, hazelnut, and caramel.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                2. How do I place an Order on your Website?
                                            </button>
                                        </h2>
                                        <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                To place an order, simply browse our selection, add your desired items to the cart, and proceed to checkout. You can create an account for a faster checkout experience. Follow the prompts to enter your shipping and payment details, and then confirm your purchase.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                3. What Payment Methods do you Accept?
                                            </button>
                                        </h2>
                                        <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                We accept a variety of payment methods, including Cash on Delivery and Online Payment such as Debit cards, GCash, Paymaya, and bank transfers. All transactions are secure and encrypted for your safety.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsefour" aria-expanded="false" aria-controls="flush-collapsefour">
                                                4. Are there any discounts for bulk purchases or corporate orders?
                                            </button>
                                        </h2>
                                        <div id="flush-collapsefour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                Yes, we offer discounts for bulk purchases and corporate orders. Please contact our sales team at coffeehub@gmail.com for more information and to discuss your specific needs.
                                                </div>
                                            </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsefive" aria-expanded="false" aria-controls="flush-collapsefive">
                                                5. How do you ensure the quality and freshness of your coffee?
                                            </button>
                                        </h2>
                                        <div id="flush-collapsefive" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                We source our coffee beans from trusted farmers and roasters, ensuring that each batch meets our high standards for quality and flavor. Our packaging is designed to maintain freshness, and we ship orders promptly to ensure you receive the best-tasting coffee possible
                                            </div>
                                        </div>
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
    <?php include 'admin/pages/footer.php';?>
</html>