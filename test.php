<?php
require_once 'app/middlewares/index.php';

checkAccess('admin');

// Admin-specific routes and logic go here...
echo 'Welcome to Admin page';
?>