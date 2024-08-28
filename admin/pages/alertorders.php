<?php
if (isset($_SESSION['alertcus'])) {
    echo '<div class="alert alert-dark alert-dismissible fade show" role="alert">';
    echo $_SESSION['alertcus'];
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
    unset($_SESSION['alertcus']); 
}
?>