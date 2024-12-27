<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <style>
        .material-symbols-outlined {
            font-variation-settings:
            'FILL' 0,
            'wght' 400,
            'GRAD' 0,
            'opsz' 24
        }
    </style>
    <link rel="stylesheet" href="/css/style.css">
    
    <script src="/js/main.js"></script>


    
    <!-- --------------------------------------------------- all component stylesheet -->
    <?php
        // Set the root folder path
        $rootFolder = __DIR__.'/css/components'; // Replace with your actual folder path

        // Get all .js files from the folder
        $cssFiles = glob($rootFolder . '/*.css');

        // Combine all JS files content
        $combinedCss = '';
        foreach ($cssFiles as $file) {
            $combinedCss .= file_get_contents($file) . "\n";
        }

        // Output the combined JS content inside a <script> tag
        echo "<style>\n" . $combinedCss . "\n</style>\n";
    ?>
     
</head>
<body>
     <!-- --------------------------------------------------- all component script -->
    <?php
        // Set the root folder path
        $rootFolder = __DIR__.'/js/components'; // Replace with your actual folder path
        
        // Get all .js files from the folder
        $jsFiles = glob($rootFolder . '/*.js');
        
        // Combine all JS files content
        $combinedJs = '';
        foreach ($jsFiles as $file) {
            $combinedJs .= file_get_contents($file) . "\n";
        }
        ?>
        <script>
            window.addEventListener("load", () => {
            <?php echo $combinedJs; ?>
        });

        </script>
        <?php
            
           require __DIR__.'/../vendor/autoload.php';
            
            // .env from root directory
            $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../')->load(); 
            // require_once __DIR__.'/../api/db/db.php';
            require __DIR__ . '/../api/global.php';
            require_once __DIR__."/../api/middlewares/auth.php";
            require __DIR__ . '/../router/web.php';
        ?>
    
</body>
</html>