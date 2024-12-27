<?php
require_once __DIR__.'/db/db.php';
// $user= $DB->query("SELECT password FROM users");// WHERE username='$_POST[username]'");

// if($user->num_rows==0){
//     jsonRes('{"error":"User not found"}');
// }
// $user=$user->fetch_assoc();
// if($user['password']!=$_POST['password']){
//     jsonRes('{"error":"Password is incorrect"}');
// }

// echo json_encode(["error" => "User not found"]);

echo json_encode(["error" => "User not found"]);
?>