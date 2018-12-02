<?php
    function connect_to_db()
    {
        define("USER", "test2");
        define("PASS", "test2");
        define("DB", "wyze");
    
        // connect to database
        $connection = new mysqli('localhost', USER, PASS, DB);
    
        if ($connection->connect_error) {
            die('Connect Error (' . $connection->connect_errno . ') '
                . $connection->connect_error);
        }
        
        return $connection;   
    }
?>
