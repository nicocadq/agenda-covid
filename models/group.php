<?php

include_once '../utils/database.php';

class GroupModel extends Database {
    function get_all() {
        $sql_query = 'SELECT * FROM grupo';
        $data = parent::get_data($sql_query);
        parent::close_connection();
        return $data; 
    }
}

?>