<?php
if (isset($_SESSION['alertadmin'])) {
    echo '<div class="alert alert-dark alert-dismissible fade show" role="alert">';
    echo $_SESSION['alertadmin'];
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
    unset($_SESSION['alertadmin']); // Clear the alert after displaying
}
?>