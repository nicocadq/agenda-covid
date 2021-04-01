<?php

include_once '../models/group.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch($method){
    case 'GET': 
        get();
        break;
    case 'POST':
        post();
    default:
        echo 'Unabled method.';
        break;
}

function get() {
    $model = new GroupModel();

    if(isset($_GET['id'])) {
        echo json_encode(
            'TODO: handle GET /{id} ... currently receving:'. $_GET['id'], 
            JSON_PRETTY_PRINT
        );
    } else {                    
        $groups = $model->get_all();
        echo json_encode($groups, JSON_PRETTY_PRINT);
    }
}

function post(){
    echo json_encode("esto es un post", JSON_PRETTY_PRINT);
}


?>