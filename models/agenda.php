<?php

include_once '../utils/database.php';

class AgendaModel extends Database {
    function create($idUser) {
        $dateV1 = date('Y-m-d', strtotime('+1 weeks'));
        $dateV2 = date('Y-m-d', strtotime('+1 month ', strtotime($dateV1)));

        $sql_query = 'INSERT INTO agenda (idUsuario, fechaV1, fechaV2) VALUES(?,?,?)';
        $statement = parent::get_connection()->prepare($sql_query);
        $statement->bind_param('sss', $idUser, $dateV1, $dateV2);
        $statement->execute();
        $statement->close();
        return true; 
    }

    function get_by_ci($ci){
        $sql_query = 'SELECT idUsuario, fechaV1, fechaV2 FROM agenda WHERE idUsuario='. $ci;
        $data = parent::get_data($sql_query);
        parent::close_connection();
        return $data; 
    }

    function delete_by_ci(){
        
    }
}

?>