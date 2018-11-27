<?php
require_once("db_con.php");
$connection = connect_to_db();

    
    $sql = sprintf("SELECT * FROM categories where userID = 1");
    $result = $connection->query($sql) or die(mysqli_error($connection));
    //get array of catagory names
    //get array of total transactions for each catagory
    //get deafault plan
?>
<html>
	<head>
		<title>Homepage</title>
		<link rel="stylesheet" href="assets/css/main.css" /> <!--Template-->
		<link rel="stylesheet" href="css_files/homepage.css"/>
		
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script>
  	
  	var catagoryNames; //use the above array to create this js array
  	var totalTransactionsForCatagory; //use above array to populate this array
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
									<h4>Account Plans</h4>
									<div class="table-wrapper">
										<table>
											<thead>
												<tr>
													<th>Plan Name</th>
													<th>Goal</th>
												</tr>
											</thead>
											<tbody>
												<tr>
												  <td id="plan">PlanName</td>
												  <td id="spent">PlanData</td>
												</tr>
											</tbody>
											<tfoot>
												
											</tfoot>
										</table>
									</div>

				</div>
				<div class="row">
				<section class="6u 12u$(medium)">
				<div class="container">
					<h3>Current Spending</h3>
				<canvas id="accountChart" width="500"  height="500">
				
				<script>
					let myChart = document.getElementById('accountChart').getContext('2d');
				
					let pieChart = new Chart(myChart, {
						type:'pie',
						data:{
							labels:[/*CatagoryNames*/],
							datasets:[{
								label:'Spent',
								data:[
									/*
									CatagoryAmounts
									*/
									],
								backgroundColor: [
									'rgba(108,192,145,.6)',
									'rgba(122,198,156,.6)',
									'rgba(218,239,227,.6)',
									'rgba(196,215,204,.6)',
									'rgba(86,154,116,.6)',
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
					<h3>Budget Goals</h3>
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
				<div class="row">
				<section class="3u 6u(medium) 12u$(small)">
					<h3>Questionaire</h3><p>Were you interested in taking the questionare to see how best WYZE can help you?</p>
					<h><a href="questionare.php">YES</a></h3>
				</section>
				<section class="3u 6u(medium) 12u$(small)">
					<h3>Recent Financial Articles</h3>
					<ul class="alt">
						<li><a href="https://finance.yahoo.com/news/dow-drops-200-points-treasury-yields-move-higher-141746422.php">Stock Market News</a></li>
						<li><a href="https://www.bloomberg.com/news/articles/2018-06-21/america-s-millennials-are-waking-up-to-a-grim-financial-future">Our Future</a></li>
						<li><a href="https://www.washingtonpost.com/business/millennials-get-plenty-of-financial-advice--most-of-it-is-wrong/2018/05/18/575247ec-5a10-11e8-8836-a4a123c359ab_story.php?noredirect=on">Improvement as a MILLENNIAL</a></li>
					</ul>
				</section>
			</div>
			</div>
				</section>
			
			</section>
			</div>
			
		
	</body>
</html>

<!--Homepage 

Financial overview 

Amount in accounts 

Current budget tracking 

Total remaining fund allotment in comparison to remaining monthly time(in days)  

Overview of amount spent in categories in comparison to amount remaining for the month. 

Bar graph: income vs. expense in comparison to previous months 

Tutorials - More included as a member, Videos 

Informative articles - links

Definitions

Financial Questionnaire - link
-->
