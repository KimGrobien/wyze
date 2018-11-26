<?php
    require_once('db_con.php');
    if (isset($_POST['importedData'])){
        $connection = connect_to_db();
        $first = true;
        foreach ($_POST['importedData'] as $value) {
            if ($first){
                $sql = "INSERT INTO `transactions`(`userID`, `date`, `description`, `source`, `amount`) VALUES ";
                 $first = false;
            } else {
                $sql = $sql . sprintf("(1, '%s','%s','%s','%s'),",$value[0],"test source",$value[2],$value[3]);//$value[1] holds source which is unkown from data
            }
        }
        $sql = substr($sql, 0, -1);//Remove trailing comma
        $result = $connection->query($sql) or die(mysqli_error($connection));
        if ($result === false)
            die("Could not query database");
    }
    //For deleting, ajax call posts to deleteID
    if (isset($_POST['deleteID'])) {
        $connection = connect_to_db();
        $sql = sprintf("DELETE FROM transactions WHERE transactionID = %d", $_POST['deleteID']);
        $result = $connection->query($sql) or die(mysqli_error($connection));
        if ($result === false)
            die("Could not query database");
    }
    if (isset($_POST['updateID'])) {
       $connection = connect_to_db();
        $sql = sprintf("UPDATE transactions SET %s='%s' WHERE transactionID = %d", 
                    $connection->real_escape_string($_POST["updateColumn"]),
                    $connection->real_escape_string($_POST["updateValue"]),
                    $_POST['updateID']);
        echo "$sql";
        $result = $connection->query($sql) or die(mysqli_error($connection));
        if ($result === false)
            die("Could not query database");
    }
    function add_transaction($connection)
    {
                if(($_POST['date'] != "") && ($_POST['name'] != "") && ($_POST['amount'] != "")){
                   $sql = sprintf("INSERT INTO `transactions`(`userID`, `date`, `description`, `source`, `amount`) VALUES (1, '%s','%s','%s','%s')",
                               $connection->real_escape_string($_POST["date"]),
                               $connection->real_escape_string($_POST["name"]),
                               $connection->real_escape_string($_POST["source"]),
                               $connection->real_escape_string($_POST["amount"]));
                    
                    // execute query
                    $result = $connection->query($sql) or die(mysqli_error($connection));  
        
                    if ($result === false)
                        die("Could not query database");
                }
    }
    
    function get_transactions($connection)
    {
        $sql = sprintf("SELECT transactionID, date, description, category, source, amount FROM transactions where userID = 1");
        $result = $connection->query($sql) or die(mysqli_error($connection));           
        $transactions = array();
        while ($row = $result->fetch_assoc())
        {
            $currObj = array($row['transactionID'], $row['date'], $row['description'], $row['category'], $row['source'], $row['amount']);
            array_push($transactions, $currObj);
        }
        return $transactions;
    }
?>
