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
        
        $sql = sprintf("UPDATE categories SET categoryName = '%s' WHERE categoryID='%i';",
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
?>