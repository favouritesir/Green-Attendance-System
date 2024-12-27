<?php

    

    $router->map('GET', '/api', function() {
        echo 'API Home';
        // require ;
    });
    $router->map('GET', '/api/auth', function() {
        // header('Content-Type: application/json');
        // echo json_encode(["error" => "User not found"]);
        // exit();
        require __DIR__.'/auth.php';
    });
?>