<?php

include_once '../models/user.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch($method){
    case 'GET': 
        get();
        break;
    case 'POST':
        post();
    default:
        http_response_code(404);
        echo 'Unabled method.';
        break;
}

function get() {
    $model = new UserModel();

    if(isset($_GET['ci'])) {
        $ci_param = $_GET['ci'];

        $is_valid = $model->get_ci($ci_param);

        if($is_valid){
            http_response_code(200);
            echo json_encode(
                true, 
                JSON_PRETTY_PRINT
            );
        }else {
            http_response_code(404);
            echo json_encode(
                [ 'error' => 'Invalid CI'], 
                JSON_PRETTY_PRINT
            );
        }        

        
    } else {                    
        http_response_code(400);
        echo json_encode([ 'error' => 'Missing CI param'] , JSON_PRETTY_PRINT);
    }
}

function post(){
    echo json_encode("esto es un post", JSON_PRETTY_PRINT);
}


?>