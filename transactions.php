<?php
	require_once('db_con.php');
	require_once('transactions_operations.php');
	require_once('header.php');
    session_start();
    $connection = connect_to_db();
    
    if (isset($_POST['add'])){
    	add_transaction($connection);
    }
    $transactions = get_transactions($connection);   
    
    //Get categories - TODO dynamic userID
    $sql = sprintf("SELECT * FROM categories where userID = %d", $_SESSION["username"]);
    $result = $connection->query($sql) or die(mysqli_error($connection));           
    //Add each category to associative categories array
    while ($row = $result->fetch_assoc())
    {
       $categories[$row["categoryName"]] = $row["categoryName"];
    }
    //Get sources - TODO dynamic userID
    $sql = sprintf("SELECT * FROM sources where userID = %d", $_SESSION["username"]);
    $result = $connection->query($sql) or die(mysqli_error($connection));           
    //Add each category to associative categories array
    while ($row = $result->fetch_assoc())
    {
       $sources[$row["source"]] = $row["source"];
    }
        
?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script type="text/javascript">
/* global $ */ 
	//Passing db read categories from php to be used in js
	var dbcategories = '<?php echo json_encode($categories); ?>';
	var dbsources = '<?php echo json_encode($sources); ?>';
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
	function addImportedDataToDB(data, source){
		 document.getElementById("overlay").style.display = "block";//Loading bar with dimmed background
		$.ajax({
	        url: 'transactions_operations.php',
	        type: 'POST',
	        data: {importedData: data, source: source},
	        success: function(data) {
	           window.location.reload();
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
		
		<link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		
		<script src="assets/js/transactions.js"></script>
		<script type="text/javascript" src="https://unpkg.com/tabulator-tables@4.0.4/dist/js/tabulator.min.js"></script>
		<script type="text/javascript" src="assets/js/moment.js"></script>
	</head>
	<body onload="addTable()" class="subpage">
		<div id="overlay">
			<div>
	        	<img id="progress" alt="Please Wait" src="loading.gif">
	        	<br><br>
	      	</div>
		</div>
		<?php setHeader();?>
		<div id="addOptions">
			<div id="importDiv">
				<h3>Import Transactions</h3>
				<p>Supported File Types: csv, xlsx</p>
				<a href="javascript:fakeClick()" class="button special">Import Transactions</a>
				<!--Hidden file input for above link to trigger-->
				<input type="file" id="inFile" hidden="true" onchange="readFile(this)">
			</div>
			<div id="addDiv">
				<form action="<?= $_SERVER["PHP_SELF"]; ?>" method="post">
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
