<!DOCTYPE HTML>
<!--
	Projection by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<?php
	require_once("insertValuesTest.php");
	require_once("showBudgetHTML.php");
	require_once("dataAlterations.php");
	require_once("header.php");
	session_start();
	
	if(isset($_POST['catSubmit'])){
		$message = addValues($_POST['newCatName'], $_POST['catSubmit']);
		unset($_POST['catSubmit']);
	}
	else if(isset($_POST['delete_cat'])){
		$message = deleteCategory($_POST['drop1']);
		unset($_POST['delete_cat']);
	}
	else if(isset($_POST['addPlan'])){
		$message = addValues($_POST['planName'], $_POST['addPlan']);
		if(isset($_POST['defaultPlan'])){
			//change the default plan in account settings
		}
	//	$val1 = $_POST['addPlan'];
		unset($_POST['addPlan']);
	}
	else if(isset($_POST['addBudget'])){
		$message = addBudget($_POST['addLimit'], $_POST['drop2']);
		//$val1 = $_POST['drop2'];
		unset($_POST['addBudget']);
	}
/*	else if(isset($_POST['open_change_name'])){
		$val1 = $_POST['drop'];
		unset($_POST['open_change_name']);
	}
	else if(isset($_POST['changeNameSubmit'])){
		/*$message = changeCategoryName($_POST['categoryName'], $_POST['editCatName']);
		$val2 = $_POST['editCatName'];
		unset($_POST['changeNameSubmit']);
	}*/
	else if(isset($_POST['close'])){
		$message = " ";
		header("Refresh:0");
		unset($_POST['close']);
	}
	else{
		$message = " ";
	}
	
	function showMessage($str){
		echo $str;
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
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
		
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/skel.min.js"></script>
		<script src="assets/js/util.js"></script>
		<script src="assets/js/main.js"></script>
		
		<script src="jquery-popup-overlay-gh-pages/bower.json"></script>
		<script src="jquery-popup-overlay-gh-pages/package.json"></script>
		<script src="jquery-popup-overlay-gh-pages/index.js"></script>
		<script src="jquery-popup-overlay-gh-pages/jquery.popupoverlay.js"></script>
		
	</head>
	<body class="subpage">

		<!-- Header -->
			<?php setHeader();?>

		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="inner">
					<header class="align-center">
						<h2>Default Plan</h2>
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
														<input type="submit" id="add" name="catSubmit" onclick="return errorCheck(this);" value="Add Category">
														<button name="close" class="category_close">Close</button>
												</footer>
											</form>
										</section>
								  	</div>
						    	</li>
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
											<form id="dropdown" method="post" action="budget.php">
												<div id="inputs">
													<div class="in">
														<?php echo categoryDropdown(1); ?>
													</div>
												</div>
													<footer class="align-center">
													<input type="submit" id="delete" name="delete_cat" onclick="return errorCheck(this);" value="Delete Category">
											</form>
													<input type="submit" id="open_change_name" name="open_change_name" class="change_name_open" value="Change Category Name">
														<div id="change_name">
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
																	<h2 class="popup">Change Category Name</h2>
																</header>
																	<form method="post" action="budget.php">
																		<div id="inputs">
																			<div class="in">
																				<input type="text" name="editCatName" id="editCatName" placeholder="New Category Name" />
																			</div>
																		</div>
																		<footer class="align-center">
																				<input type="submit" id="changeName" name="changeNameSubmit" onclick="return errorCheck(this);" value="Change Category Name">
																				<button name="close" class="change_name_close">Close</button>
																		</footer>
																	</form>
															</section>
												  		</div>
												<button name="close" id="close_edit_cat" class="edit_close">Close</button>
											</footer>
										</section>
								  	</div>
						    	</li>
							</ul>
							<div><?php showMessage($message); ?>
								<script>
									setTimeout(function(){
										document.getElementById('message').style.display = 'none';
									}, 4000);	
								</script>
							</div>
					</header>
					<div class="table-wrapper">
						<?php
							showTable();
						?>
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
										<form method="post" action="budget.php">
											<div id="inputs">
												<div class="in">
													<input type="text" id="planName" name="planName" placeholder="Plan Name" />
												</div>
												<div class="in">
													<input type="checkbox" id="defaultPlan" name="defaultPlan">
													<label for="demo-copy">Make this my default plan</label>
												</div>
											</div>
											<footer class="align-center">
												<input type="submit" id="addPlan" name="addPlan" onclick="return errorCheck(this);" value="Add Plan">
												<button class="plan_close">Close</button>
											</footer>
										</form>
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
										<form method="post" action="budget.php">
											<div id="inputs">
												<div class="in">
													<?php echo categoryDropdown(2); ?>
												</div>
												<div class="in">
													<input type="text" name="addLimit" id="addLimit" placeholder="Budget Limit(in $)" />
												</div>
											</div>
											<footer class="align-center">
												<input type="submit" id="addBudget" name="addBudget" onclick="return errorCheck(this);" value="Add Budget">
												<button class="budget_close">Close</button>
											</footer>
										</form>
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
		      $('#edit').popup({
		      });
		    });
		    
		    $(document).ready(function() {
		      // Initialize the plugin
		      $('#change_name').popup({
		      });
		    });
  		</script>
  			
  		<script>
  			function errorCheck(elem){
			    if(document.getElementById("newCatName").value == "" && elem.id == 'add'){
			        alert("Complete all inputs or press cancel!");
			        return false;
			    }
			    else if(document.getElementById("drop1").value == "Select1" && elem.id == 'delete'){
			        alert("You must first select a category!");
			        return false;
			    }
			    else if(document.getElementById("editCatName").value == "" && elem.id == 'changeName'){
			    	alert("Complete all inputs or press cancel!");
			        return false;
			    }
				else if(document.getElementById("planName").value == "" && elem.id == 'addPlan'){
			    	alert("Complete all inputs or press cancel!");
			        return false;
			    }
			    else if((document.getElementById("addLimit").value == "" || 
			    		document.getElementById("drop2").value == "Select") &&
			    		elem.id == 'addBudget'){
			    	alert("Complete all inputs or press cancel!");
			    	return false;
			    }
			    else{
			    	return true;
  				}
  			}
  		</script>
	</body>
</html>