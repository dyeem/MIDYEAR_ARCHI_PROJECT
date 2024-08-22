<?php
if (isset($_SESSION['alertproduct'])) {
    echo '<div class="alert alert-dark alert-dismissible fade show" role="alert">';
    echo $_SESSION['alertproduct'];
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
    unset($_SESSION['alertproduct']); // Clear the alert after displaying
}
?>