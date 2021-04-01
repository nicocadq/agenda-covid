<?php

include_once '../models/user.php';
include_once '../models/agenda.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch($method){
    case 'GET': 
        get();
        break;
    case 'POST':
        post();
        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Unabled method.'], JSON_PRETTY_PRINT);
        break;
}

function get() {
    $user = new UserModel();

    if(isset($_GET['ci'])) {
        $ci_param = $_GET['ci'];

        $is_valid = $user->get_ci($ci_param);

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
    $user = new UserModel();
    $agenda = new AgendaModel();

    $tel = isset($_POST['tel']) ? $_POST['tel'] : null;
    
    if($tel){
        $ci = $_GET['ci'];

        $added = $user->add_telephone($ci, $tel);
        $created = $agenda->create($ci);

        if($added && $created){
            http_response_code(200);
            echo json_encode(true, JSON_PRETTY_PRINT);
        } else {
            http_response_code(400);
            echo json_encode(
                [ 'error' => 'Invalid CI or Tel'], 
                JSON_PRETTY_PRINT
            );
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Missing Tel param'], JSON_PRETTY_PRINT);
    }
}

?>