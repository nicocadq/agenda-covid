<?php

include_once '../utils/database.php';

class GroupModel extends Database {
    function get_count_by_group() {
        $sql_query = '
            SELECT usuario.idGrupo, grupo.nombre, COUNT(*) 
            FROM usuario INNER JOIN grupo 
            ON usuario.idGrupo=grupo.idGrupo 
            GROUP BY usuario.idGrupo
        ';
        $data = parent::get_data($sql_query);
        parent::close_connection();
        return $data; 
    }

    function get_count_by_age() {
        $sql_query = '
            SELECT usuario.idGrupo, grupo.nombre, COUNT(*) 
            FROM usuario INNER JOIN grupo 
            ON usuario.idGrupo=grupo.idGrupo 
            GROUP BY usuario.idGrupo
        ';
        $data = parent::get_data($sql_query);
        parent::close_connection();
        return $data; 
    }
}

?>