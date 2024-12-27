<?php
######################################################################## CHECK ACCESS #
function checkAccess($requiredRole) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $requiredRole) {
        header("Location: /"); 
        exit();
    }
}

?>