<?php
    require_once("insertBudgetData.php");
    require_once("db_con.php");
    
    function addValues($cat_name){
        $connection = connect_to_db();
        $message = addCategory("categories", $cat_name, $connection);
        
        return $message;
    }
?>