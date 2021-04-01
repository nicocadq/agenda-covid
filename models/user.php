<?php

include_once '../utils/database.php';

class UserModel extends Database {
    function get_ci($ci) {
        $data = false;

        $sql_query = 'SELECT idUsuario FROM usuario WHERE idUsuario=?';
        $statement = parent::get_connection()->prepare($sql_query);
        $statement->bind_param('s', $ci);

        if($statement->execute()){
            $statement->store_result();
            if($statement->num_rows == 1){
                $data = true;
            }
        }

        $statement->close();
        return $data; 
    }

    function add_telephone($ci, $tel){
        $data = false;
        
        $sql_query = 'UPDATE usuario SET telefono=? WHERE idUsuario=?';
        $statement = parent::get_connection()->prepare($sql_query);
        $statement->bind_param('is', $tel, $ci);

        if($statement->execute()){
            $statement->store_result();
            if($statement->affected_rows == 1){
                $data = true;
            }
        }

        $statement->close();
        return $data; 
    }
}

?>