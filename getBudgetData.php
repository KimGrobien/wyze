<?php
    require_once("db_con.php");
    session_start();
    
    $userID = $_SESSION["username"];
        
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
    
    function getPlanID(){
        $userID = $_SESSION["username"];
        $con = connect_to_db();
        
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
        $con = connect_to_db();
        
        $sql = sprintf("SELECT budgetID FROM budget WHERE planID = '%s'",
            $con->real_escape_string($planID)
            ); 
            
         $result = $con->query($sql) or die(mysqli_error($con));
        
        return $result;
    }
    
    function getCategories(){
        $con = connect_to_db();
        
        $planID = getPlanID();
        $result = getBudgetID($planID);

          while($row = $result->fetch_assoc()){
            foreach($row as $value){
                $sql = sprintf("SELECT categoryID FROM categories WHERE budgetID = '%s'",
                    $con->real_escape_string($value)
                );
                
                $res = $con->query($sql) or die(mysqli_error($con));
                $i = 0;
                while($r = $res->fetch_assoc()){
                    foreach($r as $k => $v){
                       $idArr[$i] = $v;
                       $i += 1;
                    }
                }
            }
          }
        return $idArr;
    }
    
    function getPlanLimit(){
        $con = connect_to_db();
        
        $planID = getPlanID();
        
        
        $sql = sprintf("SELECT FORMAT(SUM(budgetLimit), 2) as tLimit FROM budget WHERE planID = '%s'",
                $con->real_escape_string($planID)
                ); 
                
        $result = $con->query($sql) or die(mysqli_error($con));
                
        $row = $result->fetch_assoc();
        $value = $row['tLimit'];
        
        return $value;
    }
    
    function getTransactionTotals(){
        $con = connect_to_db();
       
        $catIDs = getCategories();
        $userID = $_SESSION["username"];
        
       // echo count($catIDs) . "\n";
        for($i = 0; $i <= count($catIDs); $i++){
            $sql = sprintf("SELECT categoryName as cName, aSum FROM categories as c RIGHT JOIN (SELECT categoryID, FORMAT(SUM(amount), 2) as aSum FROM transactions WHERE categoryID = '%s' AND userID='%s') as a ON c.categoryID = a.categoryID",
                $con->real_escape_string($catIDs[$i]),
                $con->real_escape_string($userID)
                );
                
            $result = $con->query($sql) or die(mysqli_error($con));
            
            $amountArr[$i] = $result;
        }
        
        return $amountArr;
    }
    
    function getTotal(){
       $aArr = getTransactionTotals();
        for($i = 0; $i < count($aArr); $i++){
            
            while($row = $aArr[$i]->fetch_assoc()){
                
                $value = $row['aSum']; 

                $val = $val + $value;

            }
        }
        return $val;
    }
    
    function getBudgets(){
        $con = connect_to_db();
        $catIDs = getCategories();
        $userID = $_SESSION["username"];
        
        /*while($r = $res->fetch_assoc()){
            foreach($r as $k => $v){
                echo $v;
            }
        }*/
        
        for($i = 0; $i <= count($catIDs); $i++){
            $sql = sprintf("SELECT cName, aSum, budgetLimit
                        FROM budget as bt
                        RIGHT JOIN (SELECT categoryName as cName, budgetID, aSum
                        			FROM categories as c
                        			RIGHT JOIN (SELECT categoryID as cID, FORMAT(SUM(amount), 2) as aSum
                                                FROM transactions
                                                WHERE categoryID = '%s' AND userID='%s') as a
                        			ON c.categoryID = a.cID) as b
                        ON bt.budgetID = b.budgetID;",
                $con->real_escape_string($catIDs[$i]),
                $con->real_escape_string($userID)
                );
        
            $results = $con->query($sql) or die(mysqli_error($con));
            $budgetsArr[$i] = $results;
        }
        
        $i = 0;
        
       /* for($i = 0; $i < count($budgetsArr); $i++){
        while($row = $budgetsArr[$i]->fetch_assoc()){
            
            //$value = $row['budgetLimit'];
           // echo $value . "\n";
            
            foreach($row as $key => $value){
               // echo $value . "\n";
            }
        }
        }*/
        
        return $budgetsArr;
    }
?>