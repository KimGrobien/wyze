<?php
    require_once("db_con.php");
    require_once("getBudgetData.php");
    
    function deleteCategory($entry_name){
        $con = connect_to_db();
        
        $sql = sprintf("DELETE FROM categories WHERE categoryName='%s';",
                $con->real_escape_string($entry_name));
                
        if($con->query($sql) === TRUE){
            $result = "<div class='success'><p id='message'>Category was successfully deleted!</p></div>";
        }
        else{
            $result = "Error deleting values: " . $con->error . "<br>";
        }
        
        return $result;
    }
    
    function changeCategoryName($old_name, $new_name){
        $con = connect_to_db();
        
        $catID = getCategoryID($old_name);
        
        $sql = sprintf("UPDATE categories SET categoryName = '%s' WHERE categoryID='%s';",
                $con->real_escape_string($new_name),
                $con->real_escape_string($catID)
                );
            
        if($con->query($sql) === TRUE){
            $result = "<div class='success'><p id='message'>'Category name was changed successfully!'</p></div>";
        }
        else{
            $result = "Error inserting values: " . $con->error . "<br>";
        }
        
        return $result;
    }
    
    function addCategory($table, $cat_name, $con){
       
        $sql = sprintf("INSERT INTO %s (categoryName) VALUES ('%s')", 
            $con->real_escape_string($table),
            $con->real_escape_string($cat_name)
            );
        
        if($con->query($sql) === TRUE){
            $result = "<div class='success'><p id='message'>Category was added successfully!</p></div>";
        }
        else{
            $result = "Error inserting values: " . $con->error . "<br>";
        }
        
        return $result;
    }
    
    function addPlan($table, $plan_name, $con){
        $sql = sprintf("INSERT INTO %s (planName) VALUES ('%s')", 
            $con->real_escape_string($table),
            $con->real_escape_string($plan_name)
            );
            
        if($con->query($sql) === TRUE){
            $result = "<div class='success'><p id='message'>Plan was added successfully!</p></div>";
        }
        else{
            $result = "Error inserting values: " . $con->error . "<br>";
        }
        
        return $result;
    }
    
    function changeDefault(){
        
    }
    
    function addBudget($limit, $cat_name){
        $con = connect_to_db();
        //$userID = getUserID();
        //$planID = getPlanID($userID);
        
        $sql = sprintf("INSERT INTO budget (budgetLimit, planID) VALUES (%i, '%s')", 
            $con->real_escape_string($limit),
            $con->real_escape_string($planID)
            );
            
        $catID = getCategoryID($cat_name, $con);
        $budgetID = getLatestBudgetID($con);
            
        $sql2 = sprintf("INSERT INTO categories (budgetID) VALUES ('%s') WHERE categoryID = '%s'", 
            $con->real_escape_string($budgetID['budgetID']),
            $con->real_escape_string($catID['categoryID'])
            );    
            
        if($con->query($sql) === TRUE && $con->query($sql2) === TRUE){
            $result = "<div class='success'><p id='message'>Budget was added successfully!</p></div>";
        }
        else{
            $result = "Error inserting values: " . $con->error . "<br>";
        }
        
    }
?>