<?php
    require_once(db_con.php);
    
    function getPlanLimit($con){
            $sql = sprintf("SELECT * FROM %s", $con->real_escape_string($table));
            
            $result = $con->query($sql) or die(mysqli_error($con));
        }
    
    function getLatestID($id_name, $table, $con){
        
        $sql = sprintf("SELECT * FROM %s WHERE %s=(SELECT MAX(%s) FROM %s);",
            $con->real_escape_string($table),
            $con->real_escape_string($id_name),
            $con->real_escape_string($id_name),
            $con->real_escape_string($table));
            
        $result = $con->query($sql) or die(mysqli_error($con));   
            
        $lastID = 0;
        $lastID = $result->fetch_assoc();
        
        return $lastID;
    }
?>