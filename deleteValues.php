<?php
    require_once("db_con.php");
    
    function deleteCategory($entry_name){
        $con = connect_to_db();
        
        $sql = sprintf("DELETE FROM categories WHERE categoryName='%s';",
                $con->real_escape_string($entry_name));
                
        if($con->query($sql) === TRUE){
            $result = "<div class='success'>Category was successfully deleted!</div>";
        }
        else{
            $result = "Error deleting values: " . $con->error . "<br>";
        }
        
        return $result;
    }
?>