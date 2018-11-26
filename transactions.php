<?php
	require_once('db_con.php');
	require_once('transactions_operations.php');
    
    $connection = connect_to_db();
    
    if (isset($_POST['add'])){
    	add_transaction($connection);
    }
    
    $transactions = get_transactions($connection);   
    
    $sql = sprintf("SELECT * FROM categories where userID = 1");
     $result = $connection->query($sql) or die(mysqli_error($connection));           
    
        //Add each category to associative categories array
        while ($row = $result->fetch_assoc())
        {
           $categories[$row["categoryName"]] = $row["categoryName"];
        }
        
?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script type="text/javascript">
/* global $ */ 
	//Passing db read categories from php to be used in js
	var dbcategories = '<?php echo json_encode($categories); ?>';
	var transactions = '<?php echo json_encode($transactions); ?>';
	transactions = JSON.parse(transactions);
	//alert(JSON.parse(transactions));
	function deleteFromDB(id) {
        $.ajax({
	        url: 'transactions_operations.php',
	        type: 'POST',
	        data: {deleteID:id},
	        success: function(data) {
	            console.log(data); // Inspect this in your console
	        }
    	});  
	}
	function updateInDB(updateID, updateColumn, updateValue) {
		 $.ajax({
	        url: 'transactions_operations.php',
	        type: 'POST',
	        data: {updateID:updateID, updateColumn: updateColumn, updateValue: updateValue},
	        success: function(data) {
	            console.log(data); // Inspect this in your console
	        }
    	});  
	}
	function addImportedDataToDB(data){
		$.ajax({
	        url: 'transactions_operations.php',
	        type: 'POST',
	        data: {importedData: data},
	        success: function(data) {
	            console.log(data); // Inspect this in your console
	        }
    	}); 
	}
</script>

<html>
	<head>
		<title>Transactions</title>
		<link rel="stylesheet" href="assets/css/main.css" /> <!--Template-->
		<link rel="stylesheet" href="assets/css/transactions.css"/>
		<link href="https://unpkg.com/tabulator-tables@4.0.4/dist/css/tabulator.min.css" rel="stylesheet">
		<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
		<script src="assets/js/transactions.js"></script>
		<script type="text/javascript" src="https://unpkg.com/tabulator-tables@4.0.4/dist/js/tabulator.min.js"></script>
		<script type="text/javascript" src="assets/js/moment.js"></script>
	</head>
	<body onload="addTable()" class="subpage">
		<header id="header">
	      <div class="inner">
	        <a href="home.php" class="logo"><strong>Wyze</strong></a>
	        <nav id="nav">
	          <a href="home.php">Home</a>
	          <a href="transactions.php">Transactions</a>
	          <a href="budget.php">Budget</a>
	          <a href="account.php">My Account</a>
	        </nav>
	        <a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
	      </div>
		</header>
		<div id="addOptions">
			<div id="importDiv">
				<h3>Import Transactions</h3>
				<p>Supported File Types: csv, xlsx</p>
				<a href="javascript:fakeClick()" class="button special">Import Transactions</a>
				<!--Hidden file input for above link to trigger-->
				<input type="file" id="inFile" hidden="true" onchange="readFile(this)">
			</div>
			<div id="addDiv">
				<form id="test" action="<?= $_SERVER["PHP_SELF"]; ?>" method="post">
					<input type="text" name="date" placeholder="Date" id="inDate"/>
					<input type="text" name="name" placeholder="Name" id="inName"/>
					<input type="text" name="source" placeholder="Source" id="inSource"/>
					<input type="text" name="amount" placeholder="Amount" id="inAmount"/>
					<input name="add" type="submit" id="addButton" class="button special" onclick="javascript:addTransaction()" value="Add">
				</form>
			</div>
		</div>
		<div id="tableDiv"></div>
	</body>
</html>
