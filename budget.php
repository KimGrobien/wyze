<!DOCTYPE HTML>
<!--
	Projection by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<?php
	require_once("insertValuesTest.php");

	$message = "";
	
	if(isset($_POST['catSubmit'])){
		$message = addValues($_POST['newCatName']);
	}
?>

<html>
	<head>
		<title>Budget</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" href="assets/css/main.css"/>
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
						<h2>Default Plan</h2>
						<!--<p>Aliquam erat volutpat nam dui </p> -->
					        <ul class="actions">
					        	<li><button class="category_open">Add Category</button>
						    		<div id="category">
						    			<head>
											<link rel="stylesheet" href="assets/css/main.css" />
											<link rel="stylesheet" href="assets/css/popupWindow.css" />
									    </head>
								        <header id="header">
										    <div class="inner">
								                <a href="home.php" class="logo"><strong>WYZE</strong></a>
								            </div>
										</header>
										<section class="wrapper">
											<header class="align-center">
												<h2 class="popup">Add New Category</h2>
											</header>
											<form method="post" action="budget.php">
												<div id="inputs">
													<div class="in">
														<input type="text" name="newCatName" id="newCatName" placeholder="Category Name" />
													</div>
												</div>
											<footer class="align-center">
													<input type="submit" name="catSubmit" onclick="return errorCheck();" value="Add Category">
													<button class="category_close">Close</button>
												</form>
											</footer>
										</section>
								  	</div>
						    	</li>
				<!--	        	<li><button class="subcategory_open">Add Subcategory</button>
						    		<div id="subcategory">
						    			<head>
											<link rel="stylesheet" href="assets/css/main.css" />
											<link rel="stylesheet" href="assets/css/popupWindow.css" />
									    </head>
								        <header id="header">
										    <div class="inner">
								                <a href="home.php" class="logo"><strong>WYZE</strong></a>
								            </div>
										</header>
										<section class="wrapper">
											<header class="align-center">
												<h2 class="popup">Add New Subcategory</h2>
											</header>
											<form method="post" action="">
												<div id="inputs">
													<div class="in">
														<div class="select-wrapper">
															<select name="demo-category" id="demo-category">
																<option value="">- Category -</option>
																<option value="1">Food and Dining</option>
																<option value="1">Gas and Fuel</option>
																<option value="1">Shopping</option>
																<option value="1">Electric</option>
															</select>
														</div>
													</div>
													<div class="in">
														<input type="text" name="demo-name" id="demo-name" value="" placeholder="Subcategory Name" />
													</div>
												</div>
											</form>
											<footer class="align-center">
												<input type="submit" class="subcategory_close" value="Add Subcategory">
												<button class="subcategory_close">Close</button>
											</footer>
										</section>
								  	</div>
						    	</li>  -->
								<li><button class="edit_open">Edit Categories</button>
						    		<div id="edit">
						    			<head>
											<link rel="stylesheet" href="assets/css/main.css" />
											<link rel="stylesheet" href="assets/css/popupWindow.css" />
									    </head>
								        <header id="header">
										    <div class="inner">
								                <a href="home.php" class="logo"><strong>WYZE</strong></a>
								            </div>
										</header>
										<section class="wrapper">
											<header class="align-center">
												<h2 class="popup">Edit Categories</h2>
											</header>
											<form method="post" action="">
												<div id="inputs">
													<div class="in">
														<div class="select-wrapper">
															<select name="demo-category" id="demo-category">
																<option value="">- Category -</option>
																<option value="1">Food and Dining</option>
																<option value="1">Gas and Fuel</option>
																<option value="1">Shopping</option>
																<option value="1">Electric</option>
															</select>
														</div>
													</div>
												</div>
											</form>
											<footer class="align-center">
												<input type="submit" class="edit_close" value="Delete Category">
												<input type="submit" class="edit_close" value="Change Category Name">
											<!--	<input type="submit" class="edit_close" value="Edit Subcategory"> -->
												<button class="edit_close">Close</button>
											</footer>
										</section>
								  	</div>
						    	</li>
							</ul>
							<div><?php echo $message; ?></div>
					</header>
					<div class="table-wrapper">
						<table class="alt2">
							<tbody>
								<tr>
									<td class= "tot"><strong>Total</strong></td>
									<td>
									   	<div class="progress">
	                                      <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">$300 of $600</div>
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
					</div>
					<footer class="align-center">
					    <ul class="actions">
					    	<li><button class="plan_open">Add New Plan</button>
					    		<div id="plan">
					    			<head>
										<link rel="stylesheet" href="assets/css/main.css" />
										<link rel="stylesheet" href="assets/css/popupWindow.css" />
								    </head>
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
													<input type="checkbox" id="demo-copy" name="demo-copy">
													<label for="demo-copy">Make this my default plan</label>
												</div>
											</div>
										</form>
										<footer class="align-center">
											<input type="submit" class="plan_close" value="Add Plan">
											<button class="plan_close">Close</button>
										</footer>
									</section>
							  	</div>
					    	</li>
					    	
					    	<li><button class="budget_open">Add Budget</button>
					    		<div id="budget">
					    			<head>
										<link rel="stylesheet" href="assets/css/main.css" />
										<link rel="stylesheet" href="assets/css/popupWindow.css" />
								    </head>
							        <header id="header">
									    <div class="inner">
							                <a href="home.php" class="logo"><strong>WYZE</strong></a>
							            </div>
									</header>
									<section class="wrapper">
										<header class="align-center">
											<h2 class="popup">Add New Budget</h2>
										</header>
										<form method="post" action="">
											<div id="inputs">
												<div class="in">
													<div class="select-wrapper">
														<select name="demo-category" id="demo-category">
															<option value="">- Category -</option>
															<option value="1">Food and Dining</option>
															<option value="1">Gas and Fuel</option>
															<option value="1">Shopping</option>
															<option value="1">Electric</option>
														</select>
													</div>
												</div>
												<div class="in">
													<input type="text" name="demo-name" id="demo-name" value="" placeholder="Budget Limit(in $)" />
												</div>
											</div>
										</form>
										<footer class="align-center">
											<input type="submit" class="budget_close" value="Add Budget">
											<button class="budget_close">Close</button>
										</footer>
									</section>
							  	</div>
					    	</li>
					        <!--<li><a href="#" class="button special">Add Budget</a></li>-->
					        <li><a href="transactions.php" class="button">Add Transactions</a></li>
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
			      $('#plan').popup({
			      });
			    });
			    
			    $(document).ready(function() {
			      // Initialize the plugin
			      $('#budget').popup({
			      });
			    });
			    
			    $(document).ready(function() {
			      // Initialize the plugin
			      $('#category').popup({
			      });
			    });
			    
			    $(document).ready(function() {
			      // Initialize the plugin
			      $('#subcategory').popup({
			      });
			    });
			    
			    $(document).ready(function() {
			      // Initialize the plugin
			      $('#edit').popup({
			      });
			    });
			    
			   
  			</script>
  			<script>
  				function errorCheck(){
				    if(document.getElementById("newCatName").value == ""){
				        alert("Complete all inputs or press cancel!");
				        return false;
				    }
				    else if(!document.getElementById("newCatName").value == ""){
				    	alert("Success!");
				    	return true;
  					}
  				}
  			</script>
	</body>
</html>