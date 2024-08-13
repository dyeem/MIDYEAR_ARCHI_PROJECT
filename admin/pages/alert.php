<?php
if (isset($_SESSION['alert'])) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
    echo $_SESSION['alert'];
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
    unset($_SESSION['alert']); // Clear the alert after displaying
}
?>