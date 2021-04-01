<?php

include_once '../utils/database.php';

class AgendaModel extends Database {
    function create($idUser) {
        $data = false;

        $dateV1 = date('Y-m-d', strtotime('+1 week'));
        $dateV2 = date('Y-m-d', strtotime('+1 month ', strtotime($dateV1)));

        $sql_query = 'INSERT INTO agenda VALUES(?,?,?)';
        $statement = parent::get_connection()->prepare($sql_query);
        $statement->bind_param('sdd', $idUser, $dateV1, $dateV2);

        if($statement->execute()){
            $data = true;
        }

        $statement->close();
        return $data; 
    }

    function get_by_ci(){
       
    }

    function delete_by_ci(){
        
    }
}

?>