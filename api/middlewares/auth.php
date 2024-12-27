<?php
require_once __DIR__."/../global.php";


use Firebase\JWT\JWT;
use Firebase\JWT\Key;
######################################################################## CHECK AUTH #
function checkAuth(){
    if(!isset($_COOKIE['token']))redirect('auth');

    $token = $_COOKIE['token'];
    $data = verifyToken($token);
    

}
######################################################################## VERIFY TOKEN #
function verifyToken($token){
    $key =  $_ENV['JWT_SECRET'];
    $decoded = JWT::decode($token, $key, ['RS256']);
    return $decoded;
}
######################################################################## GENERATE TOKEN #
function generateToken($data){
    $key =  $_ENV['JWT_SECRET'];
    $token = JWT::encode($data, $key);
    return $token;
}

?>