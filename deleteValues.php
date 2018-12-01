<?php
    require_once("db_con.php");
    
    function deleteCategory($entry_name ,$con){

        $sql = sprintf("DELETE FROM categories WHERE categoryName='%s';",
                $con->real_escape_string($entry_name));
    }
?>