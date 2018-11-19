<?php
    function add_transaction($connection)
    {
                   $sql = sprintf("INSERT INTO `transactions`(`userID`, `transaction_date`, `description`, `source`, `amount`) VALUES (1, '%s','%s','%s','%s')",
                               $connection->real_escape_string($_POST["date"]),
                               $connection->real_escape_string($_POST["name"]),
                               $connection->real_escape_string($_POST["source"]),
                               $connection->real_escape_string($_POST["amount"]));
                    
                    // execute query
                    $result = $connection->query($sql) or die(mysqli_error($connection));  
        
                    if ($result === false)
                        die("Could not query database");
    }
    
    function get_transactions($connection)
    {
        $sql = sprintf("SELECT transactionID, transaction_date, description, category, source, amount FROM transactions where userID = 1");
        $result = $connection->query($sql) or die(mysqli_error($connection));           
        $transactions = array();
        while ($row = $result->fetch_assoc())
        {
            $currObj = array($row['transactionID'], $row['transaction_date'], $row['description'], $row['category'], $row['source'], $row['amount']);
            array_push($transactions, $currObj);
        }
        return $transactions;
    }
?>
