<?php

include_once '../models/group.php';

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

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
        $count_groups = [];
        
        foreach($groups_from_db as $group){
            $count_groups[] = [
                'idGroup' => $group['idGrupo'],
                'name' => $group['nombre'],
                'count' => $group['cantidad'],
            ];
        }

        http_response_code(200);
        echo json_encode($count_groups, JSON_PRETTY_PRINT);
    } elseif($action == 'ages') {
        $ages_from_db = $model->get_count_by_age();
        $count_ages = [];
        
        foreach($ages_from_db as $age){
            $count_ages[] = [
                'name' => $age['grupo'],
                'count' => $age['cantidad'],
            ];
        }

        http_response_code(200);
        echo json_encode($count_ages, JSON_PRETTY_PRINT);
    }else{
        http_response_code(404);
        echo json_encode(
            [ 'error' => 'Invalid action, avilable GROUPS and AGES'], 
            JSON_PRETTY_PRINT
        );
    }
}
?>