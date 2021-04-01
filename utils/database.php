<?php

class Database {
    private $server = 'localhost';
    private $user = 'root';
    private $password = '';
    private $database = 'agenda_covid';
    private $connection = false;

    function __construct() {
        $this->connection = new mysqli($this->server, $this->user, $this->password, $this->database) 
        or  die('Could not connect to server. Connection failed:'. $this->connection->error);
    
    }

    public function get_connection() {
        return $this->connection;
    }
    
    public function close_connection(){
        if($this->connection != false){
           $this->connection->close();
        }
    
        $this->connection = false;
    }

    public function get_data($query){
        $restults = $this->connection->query($query);
        $formatted_results = [];

        foreach($restults as $result){
            $formatted_results[] = $result;
        }

        return $formatted_results;
    }

    public function update_data($query){
        $restults = $this->connection->query($query);
        return $this->connection->affected_rows;
    }

    public function insert_data($query){
        $results = $this->connection->query($query);
        $rows = $this->connection->affected_rows;

        if($rows == 0){
            return 0;
        }
        return $this->connection->insert_id;
    }
}

?>