<?php

include_once '../models/agenda.php';
include_once '../models/user.php';

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

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
    $agenda = new AgendaModel();

    if(isset($_GET['ci'])) {
        $ci_param = $_GET['ci'];

        $dates = $agenda->get_by_ci($ci_param);

        if($dates){
            http_response_code(200);
            echo json_encode([ 
                'idUser' => $dates[0]['idUsuario'],
                'dateV1' => $dates[0]['fechaV1'],
                'dateV2' => $dates[0]['fechaV2'],
            ], JSON_PRETTY_PRINT);
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
    $agenda = new AgendaModel();
    $user = new UserModel();

    if(isset($_GET['ci'])) {
        $ci_param = $_GET['ci'];

        $dates = $agenda->get_by_ci($ci_param);
        $first_date = strtotime($dates[0]['fechaV1']);

        $current_date = strtotime(date('Y-m-d'));

        if($dates){
            if($first_date > $current_date){
                $deleted = $user->delete_by_ci($ci_param);
                
                if($deleted){
                    http_response_code(200);
                    echo json_encode(true, JSON_PRETTY_PRINT);
                }
            }else {
                http_response_code(400);
                echo json_encode([ 'error' => 'current:' .$current_date. ' first:'. $first_date] , JSON_PRETTY_PRINT);
            }
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

?>