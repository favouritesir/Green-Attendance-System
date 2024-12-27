<?php
try {
    ######################################################################## MAKE ROUTER
    require_once __DIR__."/../vendor/autoload.php";
    $router = new AltoRouter();
    
    ######################################################################## SETUP ROUTES
    $router->map('GET', '/', function() {
        require __DIR__. '/../views/home.php';
    });
    
    $router->map('GET', '/auth', function() {
        require __DIR__. '/../views/auth.php';
    });

    ######################################################################## API SUBROUTES (API ROUTES)
    require __DIR__ . '/../api/router.php';    
    ######################################################################## MATCH THE ROUTE
    $match = $router->match();
    
    ######################################################################## IF NO MATCH, SHOW 404
    if ($match) {
        if (is_callable($match['target'])) {
            call_user_func_array($match['target'], $match['params']);
        }
    } else {
        // echo '404 - পেজ পাওয়া যায়নি';
        http_response_code(404);
        require __DIR__. '/../views/errors/404.php';
        exit;
    }
}
    ######################################################################## IF ANYTHING ELSE, SHOW 500
    catch (Exception $e) {
        http_response_code(500);
        require __DIR__. '/views/errors/500.php';
        exit;
    }

    ######################################################################## END OF SCRIPT
?>