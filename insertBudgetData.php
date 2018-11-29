<?php
    require_once("db_con.php");

    function addCategory($table, $cat_name, $con){
       
        $sql = sprintf("INSERT INTO %s (categoryName) VALUES ('%s')", 
            $con->real_escape_string($table),
            $con->real_escape_string($cat_name)
            );
        
        if($con->query($sql) === TRUE){
            $result = "<div class='success'>Values were inserted into table successfully!</div>";
        }
        else{
            $result = "Error inserting values: " . $con->error . "<br>";
        }
        
        return $result;
    }
?>