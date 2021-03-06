<?php
    require_once("getBudgetData.php");
    
    function showTable(){
    
		$table = "<table class='alt2'>\n";
		$table .= "<tbody>\n" . "<tr>\n" . "<td class= 'tot'><strong>Total</strong></td>\n";
		$table .= "<td>\n" . "<div class='progress'>\n";
		
		$totalLimit = getPlanLimit();
	//	echo $totalLimit . "\n";
		$totalSpent = getTotal();
	//	echo $totalSpent . "\n";
		$totalProgress = floatval(($totalSpent / $totalLimit) * 100);
	//	echo $totalProgress . "\n";
		$totalProgressformatted = number_format($totalProgress);
	//	echo $totalProgressformatted . "\n";
		
		
		setlocale(LC_MONETARY,"en_US.UTF-8");
		
		$totalSpentStr = money_format("%n", $totalSpent);
	//	echo $totalSpentStr . "\n";
		
		$table .= "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='" . $totalProgressformatted;
		$table .= "' aria-valuemin='0' aria-valuemax='100' style='width: " . $totalProgressformatted . "%'>$" . $totalSpent;
		$table .= " of $" . $totalLimit; 
		$table .= "</div>\n </div>\n </td>\n </tr>";
		
		$budgetsArr = getBudgets();
	
        for($i = 0; $i < (count($budgetsArr) - 1); $i++){
    		while($row = $budgetsArr[$i]->fetch_assoc()){
                
                $name = $row['cName'];
                $spent = $row['aSum'];
                $limit = $row['budgetLimit'];
                
                $spentProgress = floatval(($spent / $limit) * 100);
                
                //echo $value . "\n";
              //  echo $value2 . "\n";
              //  echo $value3 . "\n";
                
                //foreach($row as $key => $value){
                   // echo $value . "\n";
                    $table .= "<tr>\n" . "<td class='catName'><a href='#'><span class='glyphicon glyphicon-edit'></span></a>" . $name . "</td>\n" . "<td>";
                    $table .= "<div class='progress'>\n";
                    $table .= "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='" . $spentProgress . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $spentProgress . "%'>$" . $spent . " of $" . $limit . "</div>\n";
                    $table .= "</div>\n" . "</td>\n" . "</tr>\n";    
                    
                //}
            }
        }
        
        $table .= "</tbody>\n" . "</table>\n";
        
		echo $table;
    }
		/*			
					   	
                          
                      
				
				        
					
				
				<tr>
					<td class="catName"><a href="#"> <span class="glyphicon glyphicon-edit"></span></a>Gas and Fuel</td>
					<td>
					    <div class="progress">
                          <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%">$30 of $100</div>
                        </div>
					</td>
				</tr>
				<tr>
					<td class="catName"><a href="#"> <span class="glyphicon glyphicon-edit"></span></a>Shopping</td>
					<td>
					    <div class="progress">
                          <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 25%">$20 of $100</div>
                        </div>
					</td>
				</tr>
				<tr>
					<td class="catName"><a href="#"><span class="glyphicon glyphicon-edit"></span></a>Electric</td>
					<td>
					    <div class="progress">
                          <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">$150 of $150</div>
                        </div>
                    </td>
				</tr>
			</tbody>
		</table>
    }*/
 /*   function show_table($table, $con){
        $sql = sprintf("SELECT * FROM %s", $con->real_escape_string($table));
        
        $result = $con->query($sql) or die(mysqli_error($con));
        
        echo results_to_table($result);
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
    */
    
    function categoryDropdown($n){
        $con = connect_to_db();
        
        $results = getCategoriesList($con);
        
        $list = "<div class='select-wrapper'>\n";
        $list .= "<select name='drop" . $n . "' id='drop" . $n . "'>\n";
        $list .= "<option value='Select" . $n . "'>- Category -</option>";
        
        while($cats = $results->fetch_assoc()){
            foreach($cats as $key => $value){
                    $list .= "<option value='" . $value . "'>" . $value . "</option>\n";
            }
        }
        
        $list .= "</select>\n";
        $list .= "</div>\n";
        
        return $list;
    }
?>