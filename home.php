<?php
	session_start();
	require_once("getBudgetData.php");
    //using session
	require_once("db_con.php");
	$connection = connect_to_db();

    //MAKE ALL SQL STATEMENTS DEPENDPENT ON UNIQUE USERID
    $sql = sprintf("SELECT C.categoryName FROM categories C where userID = %d group by categoryName order by categoryName ", $_SESSION["username"]);
    $result = $connection->query($sql) or die(mysqli_error($connection));
    //get array of catagory names
    while ($row = $result->fetch_assoc())
    {
       $categories[] = $row["categoryName"];
    }
    
    $sql2 = sprintf("SELECT categoryID, Format(SUM(amount),2) as total FROM transactions where userID = %d group by categoryID order by categoryID", $_SESSION["username"]);
    $result2 = $connection->query($sql2) or die(mysqli_error($connection));
    while ($row2 = $result2->fetch_assoc())
    {
       $transactions[] = $row2["total"];
    }
    //add all budgets out of PlanLimit
    $sql3 = sprintf("select sum(amount) from transactions where categoryID in (select categoryID from categories where budgetID in (select budgetID from budget where planID = (select planID from accountsettings where userID = %d)))", $_SESSION["username"]);
    echo "$sql3";
    $result3 = $connection->query($sql3) or die(mysqli_error($connection));
    while ($row3 = $result3->fetch_assoc())
    {
       echo $defaultPlanBudget = $row3["amountTotal"];
       echo $defaultPlanLimit = $row3["plan_limit"];
    }
   $percentageDefault = (100*($defaultPlanBudget / $defaultPlanLimit))+"%"  ;
?>
<html>
	<head>
		<title>Homepage</title>
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="css_files/homepage.css"/>
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
		<script type="text/javascript">
			var transactions = <?php echo json_encode($transactions); ?>;
			var categoryNames = <?php echo json_encode($categories); ?>;
				
			JSON.parse(totalTransactionsForCategory);
			JSON.parse(categoryNames);
  		</script>
	</head>
	<body class="subpage">
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
		<section id="main" class="wrapper">
			<div class="inner">
				<header class="align-center">
					<h2>Account Overview</h2>
				</header>
				<h4>Current Plan Total</h4>
					<div class="table-wrapper">
						<table>
							<tbody>
								<tr>
									<div class="progress">
                            			<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"  id="defaultBudget"></div>
                           			</div>
								</tr>
							</tbody>
						</table>
					</div>
					<script>
						var budgetPercentage = <?php echo json_encode($percentageDefault); ?>;
						var budgetText = '<?php echo ("$" . $defaultPlanBudget . " out of $" . $defaultPlanLimit)?>';
						document.getElementById("defaultBudget").innerHTML = budgetText;
						document.getElementById("defaultBudget").style.width = budgetPercentage+"%";
			
  						JSON.parse(budgetPercentage);
  						JSON.parse(budgetText);
					</script>
			</div>
			<div class="row">
				<section class="6u 12u$(medium)">
					<div class="container">
						<h3>Overall Current Spending</h3>
						<canvas id="accountChart" width="500"  height="500">
						<script>
							let myChart = document.getElementById('accountChart').getContext('2d');
						
							let pieChart = new Chart(myChart, {
								type:'pie',
								data:{
									labels: categoryNames,
									datasets:[{
										label:'Spent',
										data:transactions,
										backgroundColor: [
											'rgba(108,145,192,.6)',
											'rgba(192,108,145,.6)',
											'rgba(145,108,192,.6)',
											'rgba(196,215,204,.6)',
											'rgba(174,81,75,.6)',
											'rgba(rgb(119,174,75,.6)'
										],
										borderWidth:3,
										borderColor:'lightgrey'
									}]
								},
								options:{
									responsive: false
								},
								layout:{
									padding:{
										left:250,
										right:150,
										bottom:0,
										top:0
									}
								},
								legend:{
									display:true,
									position:'bottom'
								}
							});
						</script>
						</canvas>
					</div>
				</section>
				<section class="6u 12u$(medium)" >	
					<div class="row">
						<section class="3u 6u(medium) 12u$(small)">
							<h3>Budget Tips!</h3>
							<ul class="alt">
								<li>Spend Less on Food</li>
								<li>Turn off lights in rooms when not in them</li> 
							</ul>
						</section>
						<section class="3u 6u(medium) 12u$(small)">
							<h3>Member Exclusive Tutorials</h3>
							<ul class="alt">
								<li><a href="https://www.youtube.com/watch?v=r7xsyacbObQ">Stock Market 101</a></li>
								<li><a href="https://www.youtube.com/watch?v=E57KmpbNzLI">Investing in YOURSELF</a></li>
							</ul>
						</section>
					</div>
					<div class="row">
						<section class="3u 6u(medium) 12u$(small)">
							<h3>Recent Financial Articles</h3>
							<ul class="alt">
								<li><a href="https://finance.yahoo.com/news/dow-drops-200-points-treasury-yields-move-higher-141746422.php">Stock Market News</a></li>
								<li><a href="https://www.bloomberg.com/news/articles/2018-06-21/america-s-millennials-are-waking-up-to-a-grim-financial-future">Our Future</a></li>
								<li><a href="https://www.washingtonpost.com/business/millennials-get-plenty-of-financial-advice--most-of-it-is-wrong/2018/05/18/575247ec-5a10-11e8-8836-a4a123c359ab_story.php?noredirect=on">Improvement as a MILLENNIAL</a></li>
							</ul>
						</section>
					</div>
				</section>
			</div>
		</section>
	</body>
</html>
