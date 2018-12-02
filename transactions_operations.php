<?php
    require_once('db_con.php');
    session_start();
    if (isset($_POST['importedData'])){
        $connection = connect_to_db();
        $first = true;
        foreach ($_POST['importedData'] as $value) {
            if ($first){
                $sql = "INSERT INTO `transactions`(`userID`, `date`, `description`, `source`, `amount`) VALUES ";
                 $first = false;
            } else {
                $sql = $sql . sprintf("(%d, '%s','%s','%s','%s'),",
                $_SESSION["username"],
                $value[0],
                $value[2],
                $connection->real_escape_string($_POST["source"]),//$value[1] holds source which is unkown from data, must be gotten from prompt
                $value[3]
                );
            }
        }
        $sql = substr($sql, 0, -1);//Remove trailing comma
        echo "$sql";
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
        echo $_POST["updateColumn"];
        if ($_POST["updateColumn"] == "category"){
            $connection = connect_to_db();
            $sql = sprintf("UPDATE transactions SET categoryID=(select categoryID from categories where categoryName='%s' and userID = %d) WHERE transactionID = %d", 
                    $connection->real_escape_string($_POST["updateValue"]),
                    $_SESSION["username"],
                     $_POST['updateID']);
            echo "$sql";
            $result = $connection->query($sql) or die(mysqli_error($connection));
            if ($result === false)
                die("Could not query database");
        }else{
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
    }
    function add_transaction($connection)
    {
        if(($_POST['date'] != "") && ($_POST['name'] != "") && ($_POST['amount'] != "")){
           $sql = sprintf("INSERT INTO `transactions`(`userID`, `date`, `description`, `source`, `amount`) VALUES (%d, '%s','%s','%s','%s')",
                        $_SESSION["username"],
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
        $sql = sprintf("SELECT t.transactionID, t.date, t.description, c.categoryName, t.source, t.amount FROM transactions t left join categories c on t.categoryID = c.categoryID where t.userID = %d", $_SESSION["username"]);
        $result = $connection->query($sql) or die(mysqli_error($connection));           
        $transactions = array();
        while ($row = $result->fetch_assoc())
        {
            $currObj = array($row['transactionID'], $row['date'], $row['description'], $row['categoryName'], $row['source'], $row['amount']);
            array_push($transactions, $currObj);
        }
        return $transactions;
    }
?>
