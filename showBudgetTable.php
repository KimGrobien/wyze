<?php

    function show_table($table, $con){
        $con = connect_to_db("cs372", "", "hw12");
        
        $sql = sprintf("SELECT * FROM %s", $con->real_escape_string($table));
        
        $result = $con->query($sql) or die(mysqli_error($con));
        
        echo results_to_table($result);
    }
    
    function resultsToTable($results){
        $table = "<table>\n";
        $i = 0;
        
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