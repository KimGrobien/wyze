<?php
    session_start();
    require_once("db_con.php");
    function setHeader(){
        $connection = connect_to_db();
        $sql = sprintf("SELECT * FROM users where id = %d", $_SESSION["username"]);
        $result = $connection->query($sql) or die(mysqli_error($connection));
        $row = $result->fetch_assoc();          
              
                  
        echo('<header id="header">
	         <div class="inner">
            <a href="home.php" class="logo"><strong>Wyze</strong></a>');
	            
        echo('<nav id="nav">
               
                <a href="home.php">Home</a>
                <a href="transactions.php">Transactions</a>
                <a href="budget.php">Budget</a>
                <a href="account.php">My Account</a>
                <strong> Hello, ' . $row["fname"] . '!</strong>
                <a href="logout.php">Log out</a>
	        </nav>
	        <a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
	      </div>
		</header>');
        
    }
?>