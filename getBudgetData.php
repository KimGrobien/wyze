<?php
    require_once("db_con.php");
    session_start();
    
    $userID = $_SESSION["username"];
    
    
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
    
    function getCategoryID($userID){
        $con = connect_to_db();
        
        $sql = sprintf("SELECT categoryID FROM categories WHERE categoryName = '%s'",
            $con->real_escape_string($cat_name)
            );
            
        $result = $con->query($sql) or die(mysqli_error($con));
        
        $row = $result->fetch_assoc();
        $value = $row['categoryID'];
        
        return $value;
    }
    
    function getPlanID($userID){
        $sql = sprintf("SELECT planID FROM accountsettings WHERE userID = '%s'",
            $con->real_escape_string($userID)
            );
            
        $result = $con->query($sql) or die(mysqli_error($con));
        
        $value = $result->fetch_assoc();
        
        return $value;
    }
    
    function getLatestBudgetID($con){
        
       $sql = sprintf("SELECT budgetID FROM budget ORDER BY budgetID DESC LIMIT 1",
            $con->real_escape_string("")
            ); 
    
        $result = $con->query($sql) or die(mysqli_error($con));    
        $row = $result->fetch_assoc();
        $value = $row['budgetID'];
        
        return $value;
    }
    
    function getBudgetID($planID){
        $sql = sprintf("SELECT budgetID FROM budget WHERE planID = '%s'",
            $con->real_escape_string($planID)
            ); 
    
        $result = $con->query($sql) or die(mysqli_error($con));    
        $rows = $result->fetch_assoc();
        
        return $rows;
    }
    
    function getCategories(){
        $con = connect_to_db();
        
        $planID = getPlanID($userID);
        $budgetIDrows = getBudgetID($planID);
        
        foreach($budgetIDrows as $keys => $value){
            //cycle through the rows of budget IDs and get the category IDs
        }
    }
    
    function getBudgets(){
        $userID = getUserID();
        
        
    }
    
    function getTableData(){
        $userID = getUserID();
        $planID = getPlanID($userID);
        
    }
?>