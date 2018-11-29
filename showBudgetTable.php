<?php

    function show_table($table, $con){
        $sql = sprintf("SELECT * FROM %s", $con->real_escape_string($table));
        
        $result = $con->query($sql) or die(mysqli_error($con));
        
        echo results_to_table($result);
    }
    
    function getPlanLimit($con){
        $sql = sprintf("SELECT * FROM %s", $con->real_escape_string($table));
        
        $result = $con->query($sql) or die(mysqli_error($con));
    }
    
    function resultsToTable($results, $con){
        $table = "<table>\n";
        $i = 0;
        
        if($i == 0){
            $table .= "<tr>\n";
            
            
        }
        
        while($row = $results->fetch_assoc()){
            if($i == 0){
                $table .= "<tr>\n";
                
                foreach($row as $key => $value){
                    $table .= "<th>\n" . $key . "</th>\n";
                }
                
                $table .= "</tr>\n";
                $i = 1;
            }
            
            $table .= "<tr>\n";
                
            foreach($row as $key => $value){
                $table .= "<td>\n" . $value . "</td>\n";
            }
            
            $table .= "</tr>\n";
            $i = 1;
        }
        
        $table .= "</table>\n";
        
        return $table;
    }
?>