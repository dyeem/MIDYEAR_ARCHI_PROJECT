<?php
    $conn = new mysqli("localhost", "root", "", "coffeeecommerce");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
