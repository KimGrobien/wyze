<?php
    require_once("db_con.php");
    
    function getPlanLimit($con){
            $sql = sprintf("SELECT * FROM %s", $con->real_escape_string($table));
            
            $result = $con->query($sql) or die(mysqli_error($con));
        }
        
    function getCategoriesList($con){
        
        $sql = sprintf("SELECT DISTINCT categoryName FROM categories ORDER BY categoryName ASC;",
            $con->real_escape_string("")
            );
            
        $result = $con->query($sql) or die(mysqli_error($con));
        
        return $result;
    }
    
    function getCategoryID($cat_name){
        $sql = sprintf("SELECT categoryID FROM categories WHERE categoryName = '%s'",
            $con->real_escape_string($cat_name)
            );
            
        $result = $con->query($sql) or die(mysqli_error($con));
        
        $value = $results->fetch_assoc();
        
        return $value;
    }
?>