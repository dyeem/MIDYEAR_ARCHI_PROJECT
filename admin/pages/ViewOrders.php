<?php
    include '../connect.php';
    require 'PHPMailer-master/src/Exception.php';
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    if (isset($_POST['acceptbtn'])) {
        $order_id = $_POST['order_id'];
        $customer_id = $_SESSION['customer_id'];
        $first_name = $_POST['firtname'];
        $last_name = $_POST['lastname'];
        $product_name = $_POST['product_name'];
        $quantity = $_POST['quantity'];
        $payment_method = $_POST['payment_method'];
        $phone = $_POST['phone'];
        $subtotal = $_POST['subtotal'];
        $zipcode = $_POST['zipcode'];
        $address1 = $_POST['address1'];
        $address2 = $_POST['address2'];

        $insertQuery = "
        INSERT INTO transaction (customer_id, product_name, quantity, subtotal, payment_method, first_name, last_name, phone, zipcode, address1, address2, transaction_date)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ";

        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param('isidsssssss', 
            $customer_id, 
            $product_name, 
            $quantity, 
            $subtotal, 
            $payment_method, 
            $first_name, 
            $last_name, 
            $phone, 
            $zipcode, 
            $address1, 
            $address2
        );

        if ($stmt->execute()) {
            $_SESSION['alertorders.php'] = "Order Approval Success";

            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'dyeemraker17@gmail.com';
                $mail->Password = 'eazoryzxhbpuywhb';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('dyeemraker17@gmail.com', 'CoffeeHub');
                $mail->addAddress($_SESSION["customeremail"]);

                $mail->isHTML(true);
                $mail->Subject = 'Order Confirmation';
                $mail->Body    = "
                    <h1>Your Order Has Been Approved!</h1>
                    <p>Your order has been successfully approved and is now being prepared for shipment. 
                    We will notify you once it's on its way. 
                    Thank you for choosing us! ❤️</p>

                    <p>Happy Palpitation!</p>
                    <p>Here are the details:</p>
                    <p>Products: $product_name</p>
                    <p>Total Amount: ₱" . number_format($subtotal, 2) . "</p>
                    <p>Mode of Payments:  $payment_method </p>
                    
                    <p>Very Demure, Very Cutesy. </p>
                ";
                $mail->send();

                $query = "
                    SELECT product_id, product_quantity
                    FROM cart_tbl
                    WHERE customer_id = ?
                ";

                $stmt = $conn->prepare($query);
                $stmt->bind_param('i', $customer_id);
                $stmt->execute();
                $result = $stmt->get_result();

                while ($item = $result->fetch_assoc()) {
                    $updateQuery = "UPDATE product_tbl SET stock = stock - ? WHERE id = ?";
                    $updateStmt = $conn->prepare($updateQuery);
                    $updateStmt->bind_param('ii', $item['product_quantity'], $item['product_id']);
                    $updateStmt->execute();
                }

                $deleteQuery = "DELETE FROM orders_tbl WHERE id = ?";
                $deleteStmt = $conn->prepare($deleteQuery);
                $deleteStmt->bind_param('i', $order_id);
                $deleteStmt->execute();

                $clearCartQuery = "DELETE FROM cart_tbl WHERE customer_id = ?";
                $clearCartStmt = $conn->prepare($clearCartQuery);
                $clearCartStmt->bind_param('i', $customer_id);
                $clearCartStmt->execute();

                exit;
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
        } else {
            $_SESSION['alertorders.php'] = "Order Approval Failed";
        }
    } elseif (isset($_POST['declinebtn'])) {
        $order_id = $_POST['order_id'];
        $customer_id = $_SESSION['customer_id'];
    
        $query = "
            SELECT product_name, subtotal, payment_method
            FROM orders_tbl
            WHERE customer_id = ?
        ";
    
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $customer_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $order = $result->fetch_assoc();
    
        if ($order) {
            $productNamesString = $order['product_name'];
            $totalAmount = $order['subtotal'];
            $paymentMethod = $order['payment_method'];
    
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'dyeemraker17@gmail.com';
                $mail->Password = 'eazoryzxhbpuywhb';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
    
                $mail->setFrom('dyeemraker17@gmail.com', 'CoffeeHub');
                $mail->addAddress($_SESSION["customeremail"]);
    
                $mail->isHTML(true);
                $mail->Subject = 'Order Cancelled';
                $mail->Body    = "
                    <h1>Your Order Has Been Cancelled</h1>
                    <p>We regret to inform you that your order has been cancelled.</p>
                    
                    <p>If you have any questions or would like to place a new order, please don't hesitate to contact us. We appreciate your understanding.</p>
                
                    <p>Here are the details of the cancelled order:</p>
                    <p>Product(s): $productNamesString</p>
                    <p>Total Amount: ₱" . number_format($totalAmount, 2) . "</p>
                    <p>Payment Method: $paymentMethod</p>
                    
                    <p>Thank you for your interest in our products. We hope to serve you again in the future.</p>
                
                    <p>Best Regards,<br> The CoffeeHub Team</p>
                ";
                
                $mail->send();
    
                $deleteOrderQuery = "DELETE FROM orders_tbl WHERE id = ?";
                $deleteOrderStmt = $conn->prepare($deleteOrderQuery);
                $deleteOrderStmt->bind_param('i', $order_id);
                $deleteOrderStmt->execute();
    
                header("location: ../admin.php");
                exit;
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
        } else {
            $_SESSION['alertorders.php'] = "Order Decline Failed";
        }
    }
    
?>


<div class="container-fluid" id="bodymanageproduct">
    <div class="row no-gutters">
        <!-- 1st floor -->
        <div class="col-12">
            <div class="row" id="header">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <img src="../images/logo.png" alt="test" id="logo"><h4 class="brand-name">Coffee Hub</h4>
                </div>
            </div>
        </div>
    </div>
    <!-- 2nd floor -->
    <div class="row no-gutters mb-4" id="ultraheader">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 48 48"><g class="nc-icon-wrapper" fill="#543310" stroke-linejoin="round" stroke-linecap="round"><circle data-color="color-2" cx="24" cy="24" r="7" fill="none" stroke="#543310" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"></circle> <path d="M46,27V21L39.6,20.466a15.89,15.89,0,0,0-2.072-4.991l4.155-4.91L37.435,6.322l-4.91,4.155A15.876,15.876,0,0,0,27.534,8.4L27,2H21l-.534,6.4a15.89,15.89,0,0,0-4.991,2.072l-4.91-4.155L6.322,10.565l4.155,4.91A15.876,15.876,0,0,0,8.4,20.466L2,21v6l6.4.534a15.89,15.89,0,0,0,2.072,4.991l-4.155,4.91,4.243,4.243,4.91-4.155A15.876,15.876,0,0,0,20.466,39.6L21,46h6l.534-6.405a15.89,15.89,0,0,0,4.991-2.072l4.91,4.155,4.243-4.243-4.155-4.91A15.876,15.876,0,0,0,39.6,27.534Z" fill="none" stroke="#543310" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"></path></g></svg>
                    <p class="headertitle "> Orders</p>
                </div>
            </div>
            <?php include 'alertorders.php'; ?>
        </div>
    </div>
    
    <div class="row no-gutters">
        <div class="col-12">
            <div class="container">
                <table class="table table-bordered table-light table-hover">
                    <thead class="table">
                        <tr class="text-center">
                            <th>Name</th>
                            <th>Products</th>
                            <th>Payment Method</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                            $query = "SELECT * FROM orders_tbl";
                            $run = mysqli_query($conn, $query);
                            
                            if (mysqli_num_rows($run) > 0){
                                foreach($run as $orders){
                        ?>
                                <form action="" method="post">
                                    
                                    <input type="hidden" name="order_id" value="<?= $orders['id'];?>">
                                    <input type="hidden" name="customer_id" value="<?=$orders['customer_id'];?>">
                                    <input type="hidden" name="firtname" value="<?= $orders['first_name'];?>">
                                    <input type="hidden" name="lastname" value="<?= $orders['last_name'];?>">
                                    <input type="hidden" name="product_name" value="<?= $orders['product_name'];?>">
                                    <input type="hidden" name="quantity" value="<?= $orders['quantity'];?>">
                                    <input type="hidden" name="payment_method" value="<?= $orders['payment_method'];?>">
                                    <input type="hidden" name="phone" value="<?= $orders['phone'];?>">
                                    <input type="hidden" name="subtotal" value="<?= $orders['subtotal'];?>">
                                    <input type="hidden" name="zipcode" value="<?= $orders['zipcode'];?>">
                                    <input type="hidden" name="address1" value="<?= $orders['address1'];?>">
                                    <input type="hidden" name="address2" value="<?= $orders['address2'];?>">
                                    <input type="hidden" name="date" value="<?= $orders['transaction_date'];?>">
                                    
                                    <tr class="text-center">
                                        <td><?= $orders ['first_name'] . " " . $orders['last_name']; ?></td>
                                        <td><?= $orders ['product_name']; ?></td>
                                        <td><?= $orders ['payment_method']; ?></td>
                                        <td><?= $orders ['quantity']; ?></td>
                                        <td><?= $orders ['subtotal']; ?></td>
                                        <td>
                                            <button type="submit" name="acceptbtn"  class="btn btn-success m-1">Accept</button>
                                            <button type="submit" name="declinebtn" class="btn btn-danger m-1" >Decline</button>
                                        </td>
                                    </tr>
                                </form>
                        <?php
                                }
                            }else{
                                echo '<h5> No Records of Orders Yet </h5>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

