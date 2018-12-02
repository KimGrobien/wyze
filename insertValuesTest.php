<?php
    require_once("dataAlterations.php");
    require_once("db_con.php");
    
    function addValues($name, $sub_type){
        $connection = connect_to_db();
        
        if($sub_type == "Add Category"){
            $message = addCategory("categories", $name, $connection);
        }
        else if($sub_type == "Add Plan"){
            $message = addPlan("plan", $name, $connection);
        }
        
        return $message;
    }
?>