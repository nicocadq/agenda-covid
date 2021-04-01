<?php

include_once '../models/agenda.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch($method){
    case 'GET': 
        get();
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

// function post(){
//     $user = new UserModel();
//     $agenda = new AgendaModel();

//     $tel = isset($_POST['tel']) ? $_POST['tel'] : null;
    
//     if($tel){
//         $ci = $_GET['ci'];

//         $added = $user->add_telephone($ci, $tel);
//         $created = $agenda->create($ci);

//         if($added && $created){
//             http_response_code(200);
//             echo json_encode(true, JSON_PRETTY_PRINT);
//         } else {
//             http_response_code(400);
//             echo json_encode(
//                 [ 'error' => 'Invalid CI or Tel'], 
//                 JSON_PRETTY_PRINT
//             );
//         }
//     } else {
//         http_response_code(400);
//         echo json_encode(['error' => 'Missing Tel param'], JSON_PRETTY_PRINT);
//     }
// }

?>