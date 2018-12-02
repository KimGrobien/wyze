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
        
        $sql = sprintf("SELECT categoryID FROM categories WHERE userID = '%s'",
            $con->real_escape_string($userID)
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
        
        $row = $result->fetch_assoc();
        
        $value = $row['planID'];
        
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
        $i = 0;
        
        
        foreach($budgetIDrows as $key => $value){
            //cycle through the rows of budget IDs and get the category IDs
                $sql = sprintf("SELECT categoryID FROM categories WHERE budgetID = '%s'",
                $con->real_escape_string($value)
                ); 
                
                $result = $con->query($sql) or die(mysqli_error($con));
                
                $row = $result->fetch_assoc();
                $value = $result['categoryID'];
                
                $catIDarr[$i] = $value;
                $i += 1;
        }
        
        return $catIDarr;
    }
    
    function getTransactionTotals($catIDs){
        $catIDs = getCategories();
        
        $i = 0;
        foreach($catIDs as $val){
            $sql = sprintf("SELECT categoryName as cName, aSum FROM categories as c RIGHT JOIN (SELECT categoryID, FORMAT(SUM(amount), 2) as aSum FROM transactions WHERE categoryID = '%s' AND userID='%s') as a ON c.categoryID = a.categoryID",
                $con->real_escape_string($userID),
                $con->real_escape_string($val)
                );
                
            $result = $con->query($sql) or die(mysqli_error($con));
            $rows = $result->fetch_assoc();
            
            $amountArr[$i] = $rows;
            
            $val = 0;
        }
        
        return $amountArr;
    }
    
    function getTotal(){
        $aArr = getTransactionTotals();
        
        foreach($aArr as $val){
            $value += $val['aSum'];
        }
        return $value;
    }
    
    function getBudgets(){
        $userID = getUserID();
        
        
    }
    
    function getTableData(){
        $userID = getUserID();
        $planID = getPlanID($userID);
        
    }
?>