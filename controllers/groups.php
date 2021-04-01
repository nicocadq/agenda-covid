<?php

include_once '../models/group.php';

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
    $model = new GroupModel();

    $action = $_GET['action'] ?? null;

    if($action == 'groups') {
        $groups_from_db = $model->get_count_by_group();
        $groups = [];
        
        foreach($groups_from_db as $group){
            $groups[] = [
                'idGroup' => $group['idGrupo'],
                'name' => $group['nombre'],
                'count' => $group['COUNT(*)'],
            ];
        }

        http_response_code(200);
        echo json_encode($groups, JSON_PRETTY_PRINT);
    } elseif($action == 'ages') {
        http_response_code(200);
        echo json_encode("no", JSON_PRETTY_PRINT);
    }else{
        http_response_code(404);
        echo json_encode(
            [ 'error' => 'Invalid action, avilable GROUPS and AGES'], 
            JSON_PRETTY_PRINT
        );
    }
}
?>