<?php
if (isset($_SESSION['alert_addtocart'])) {
    echo '<div class="alert alert-dark alert-dismissible fade show" role="alert">';
    echo $_SESSION['alert_addtocart'];
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
    unset($_SESSION['alert_addtocart']); // Clear the alert after displaying
}
?>