<?php

include_once '../utils/database.php';

class GroupModel extends Database {
    function get_count_by_group() {
        $sql_query = '
            SELECT usuario.idGrupo, grupo.nombre, COUNT(*) as cantidad
            FROM usuario INNER JOIN grupo 
            ON usuario.idGrupo=grupo.idGrupo 
            GROUP BY usuario.idGrupo
        ';
        $data = parent::get_data($sql_query);
        parent::close_connection();
        return $data; 
    }

    function get_count_by_age() {
            $sql_query = "
            SELECT 
                CASE 
                    WHEN (TIMESTAMPDIFF(YEAR,fechaNacimiento,CURDATE()) BETWEEN 18 AND 30) THEN 'De 18 a 30'
                    WHEN (TIMESTAMPDIFF(YEAR,fechaNacimiento,CURDATE()) BETWEEN 31 AND 50) THEN 'De 31 a 50'
                    WHEN (TIMESTAMPDIFF(YEAR,fechaNacimiento,CURDATE()) BETWEEN 51 AND 65) THEN 'De 51 a 65'
                END as grupo,
            COUNT(*) as cantidad
            FROM usuario
            GROUP BY grupo";

        $data = parent::get_data($sql_query);
        parent::close_connection();
        return $data; 
    }
}

?>