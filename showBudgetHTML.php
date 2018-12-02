<?php
    require_once("getBudgetData.php");
    
    function showTable($results){
    
		$table = "<table class='alt2'>\n";
		$table .= "<tbody>\n" . "<tr>\n" . "<td class= 'tot'><strong>Total</strong></td>\n";
		$table .= "<td>\n" . "<div class='progress'>\n";
		
		$totalLimit = "";
		$totalSpent = "";
		$totalProgress = floatval(($totalSpent / $totalLimit) * 100);
		$totalProgressformatted = number_format($totalProgress);
		
		setlocale(LC_MONETARY,"en_US.UTF-8");
        
		
		$totalSpentStr = money_format("%n", $totalSpent);
		
		$table .= "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='" . $totalProgressformatted;
		$table .= "' aria-valuemin='0' aria-valuemax='100' style='width: " . $totalProgressformatted . "%'>%n" . money_format($table, $totalSpent);
		$table .= " of " . money_format("%n", $totalLimit); 
		$table .= "</div>";
		
		foreach($rows as $key=>$value){
		    
		}
		
    }
					
		/*			
					   	
                          
                      	</div>
					</td>
				</tr>
				<tr>
					<td class="catName"><a href="#"> <span class="glyphicon glyphicon-edit"></span></a>Food and Dining</td>
					<td>
				        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">$100 of $250</div>
                        </div>
					</td>
				</tr>
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