<!DOCTYPE HTML>
<!--
	Projection by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<?php


?>

<html>
	<head>
		<title>Budget</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="assets/css/budget.css"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	</head>
	<body class="subpage">

		<!-- Header -->
			<header id="header">
			    <div class="inner">
                    <a href="home.php" class="logo"><strong>WYZE</strong></a>
                    <nav id="nav">
                        <a href="home.php">Home</a>
                        <a href="transactions.php">Transactions</a>
                        <a href="budget.php">Budget</a>
                        <a href="account.php">My Account</a>
                    </nav>
                    <a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
                </div>
			</header>

		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="inner">
					<header class="align-center">
						<h2>Plan</h2>
						<!--<p>Aliquam erat volutpat nam dui </p> -->
					        <ul class="actions">
								<li><a href="#" class="button special">Add Category</a></li>
								<li><a href="#" class="button special">Add Subcategory</a></li>
								<li><a href="#" class="button special">Edit Categories</a></li>
							</ul>
					</header>
					<div class="table-wrapper">
						<table class="alt2">
							<tbody>
								<tr>
									<td><strong>Total</strong></td>
									<td>
									   <div class="progress">
                                          <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">$300 of $600</div>
                                        </div>
									</td>
									<td></td>
								</tr>
								<tr>
									<td>Food and Dining</td>
									<td>
									        <div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">$100 of $250</div>
                                            </div>
									</td>
									<td>
									    <a href="#"> <span class="glyphicon glyphicon-edit"></span></a>
									</td>
								</tr>
								<tr>
									<td>Gas and Fuel</td>
									<td>
									    <div class="progress">
                                          <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%">$30 of $100</div>
                                        </div>
									</td>
									<td>
									    <a href="#"> <span class="glyphicon glyphicon-edit"></span></a>
									</td>
								</tr>
								<tr>
									<td>Shopping</td>
									<td>
									    <div class="progress">
                                          <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 25%">$20 of $100</div>
                                        </div>
									</td>
									<td>
									    <a href="#"> <span class="glyphicon glyphicon-edit"></span></a>
									</td>
								</tr>
								<tr>
									<td>Electric</td>
									<td>
									    <div class="progress">
                                          <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">$150 of $150</div>
                                        
                                        </div>
                                    </td>
									<td>
									    <a href="#"> <span class="glyphicon glyphicon-edit"></span></a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<footer class="align-center">
					    <ul class="actions">
					    	<li><button class="my_popup_open">Add New Plan</button>
					    		<div id="my_popup">
					    			<head>
										<link rel="stylesheet" href="assets/css/main.css" />
										<link rel="stylesheet" href="assets/css/newPlan.css" />
								    </head>
								    <!--<body class="subpage">-->
								        <header id="header">
										    <div class="inner">
								                <a href="home.php" class="logo"><strong>WYZE</strong></a>
								            </div>
										</header>
										<section class="wrapper">
											<header class="align-center">
												<h2 class="popup">Add New Plan</h2>
											</header>
												<form method="post" action="">
													<div id="inputs">
														<div class="in">
															<input type="text" name="demo-name" id="demo-name" value="" placeholder="Plan Name" />
														</div>
														<div class="in">
															<input type="text" name="demo-name" id="demo-name" value="" placeholder="Plan Limit(in $)" />
														</div>
														<div class="in">
															<input type="checkbox" id="demo-copy" name="demo-copy">
															<label for="demo-copy">Make this my default plan</label>
														</div>
													</div>
												</form>
												<footer class="align-center">
													<input type="submit" class="my_popup_close" value="Add Plan">
													<button class="my_popup_close">Close</button>
												</footer>
										</section>
										
								   <!-- </body>-->
								
								    <!-- Add an optional button to close the popup -->
								    
							  	</div>
					    	</li>
					    	
					        <li><a href="#" class="button special">Add Budget</a></li>
					        <li><a href="transactions.php" class="button special">Add Transactions</a></li>
					    </ul>
					</footer>
				</div>
			</section>
		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			
			<script src="https://code.jquery.com/jquery-1.8.2.min.js"></script>
			<script src="https://cdn.rawgit.com/vast-engineering/jquery-popup-overlay/1.7.13/jquery.popupoverlay.js"></script>
			
			<script>
    			$(document).ready(function() {
			      // Initialize the plugin
			      $('#my_popup').popup({
			      });
			    });
  			</script>
			
	</body>
</html>