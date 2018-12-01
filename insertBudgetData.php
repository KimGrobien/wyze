<?php
    require_once("db_con.php");

    function addCategory($table, $cat_name, $con){
       
       $oldID = 0;
       $newID = 0;
       
       $id_key = "categoryID";
       $oldID = getLatestID($id_key, $table, $con);
       $newID = $oldID + 1;
       
        $sql = sprintf("INSERT INTO %s (%s, categoryName) VALUES ('%i', '%s')", 
            $con->real_escape_string($table),
            $con->real_escape_string($id_key),
            $con->real_escape_string($newID),
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