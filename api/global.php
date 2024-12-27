<?php
######################################################################## DATABASE CONNECTION #


######################################################################## JSON RESPONSE #
function jsonRes($data) {
    header("Content-Type: application/json"); 
    echo json_encode ($data);
}

######################################################################## REDIRECT TO ANOTHER PATH #
function redirect($path){
    header("Location: /$path");
    exit;
}
?>