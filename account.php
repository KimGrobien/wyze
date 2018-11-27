<!DOCTYPE html>
<html>
   <head>
      <title>My Account</title>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <link rel="stylesheet" href="assets/css/main.css" />
   </head>
   <?php
	require_once("db_con.php");
	$connection = connect_to_db();
	
	function echoSQL($connection, $statement, $label) {
		$sql = sprintf($statement);
		$result = mysqli_query($connection, $sql);
		$row = mysqli_fetch_assoc($result);
		echo $row[$label];
	}
	
	if (isset($_POST['personalSave'])) {
		$fname = $_POST['fname']; $lname = $_POST['lname']; $email = $_POST['email']; $phone = $_POST['phone'];
		$pass1 = $_POST['password1']; $pass2 = $_POST['password2'];
		mysqli_query($connection, "update users set fname='$fname', lName='$lname', email='$email', numPhone='$phone' where id = 2");
		
		if ((isset($_POST['password1']) && isset($_POST['password2'])) && ($_POST['password1'] == $_POST['password2'])) {
			mysqli_query($connection, "update users set password='$pass1' where id = 2");
		}
	}
	
	if (isset($_POST['addAccount'])) { 
		if (isset($_POST['newType']) && isset($_POST['newAccName']) && isset($_POST['newBudget']) && isset($_POST['newLimit'])) {
			$accountType = $_POST['newType']; $accountName = $_POST['newAccName']; $budget = $_POST['newBudget']; $limit = $_POST['newLimit'];
			mysqli_query($connection, "insert into accountsettings(userID, accountName) values (2, '$accountName')");
			mysqli_query($connection, "insert into plan(userID, categoryID, budget, plan_limit) values (2, '$newType', '$budget', '$limit')");
			if (isset($_POST['newDefault'])) {
				mysqli_query($connection, "insert into plan(default_plan) values (1) where userID = 2");
			}
		}
	}
	
	?>
	
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
      <section id="three" class="wrapper">
         <div class="inner">
            <header class="align-center">
               <h2>My Account</h2>
               <p>Edit account options, linked data, and personal information.</p>
            </header>
			<form method="POST">
            <div class="row">
               
					<?php
						$result1 = mysqli_query($connection, "select * from accountsettings where userID = 2");
						$result2 = mysqli_query($connection, "select * from plan where userID = 2");
						while ($row1 = mysqli_fetch_array($result1)) {
							$count = 0;
							$row2 = mysqli_fetch_array($result2);
								$count = $count + 1;
								$categoryName = mysqli_query($connection, "select categoryName from categories where categoryID = " . $row2['categoryID']);
								$categoryString = mysqli_fetch_assoc($categoryName);
								echo '<div class="4u 12u$(medium)"><h3>' . $row1['accountName'] . '</h3>';
								echo '<div class="table-wrapper">
										<table>
											<thead>
												<caption>' . $categoryString["categoryName"] . '</caption>
												<tr>
													<th>Budget</th>
													<th>Limit</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>' . $row2['budget'] . '</td>
													<td>' . $row2['plan_limit'] . '</td>
												</tr>
											</tbody>
										</table>
									</div>
									<input type="submit" name="editAcct' . $count . '" value="Edit" class="button special"></div>';
						}
					?>
               <div class="4u$ 12u$(medium)">
                  <h3>Add a new account</h3>
                  <select name="newType">
                     <option value="">- Account Type -</option>
                     <option value="1"><?php echoSQL($connection, "select categoryName from categories where categoryID = 1", "categoryName");?></option>
                     <option value="2"><?php echoSQL($connection, "select categoryName from categories where categoryID = 2", "categoryName");?></option>
                     <option value="3"><?php echoSQL($connection, "select categoryName from categories where categoryID = 3", "categoryName");?></option>
                     <option value="4"><?php echoSQL($connection, "select categoryName from categories where categoryID = 4", "categoryName");?></option>
                  </select>
                  <br />
                  <input name="newAccName" placeholder="Account name" type="text"><br />
                  <input name="newBudget" placeholder="Budget" type="text"><br />
                  <input name="newLimit" placeholder="Budget limit" type="text"><br />
                  <div class="6u$(small)">
                     <input name="newDefault" id="newDefault" type="checkbox"><label for="newDefault">Default account</label>
                  </div>
                  <input type="submit" name="addAccount" value="Add account" class="button special">
               </div>
            </div>
			<br />
			<h3>Personal information</h3>
			<div class="row">
				<div class="6u 12u$(medium)">
				  <input name="fname" value="<?php echoSQL($connection, "select fname from users where id = 2", "fname");?>" placeholder="First name" type="text"><br />
                  <input name="lname" value="<?php echoSQL($connection, "select lname from users where id = 2", "lname");?>" placeholder="Last name" type="text"><br />
				  <input name="password1" placeholder="New password" type="password"><br />
				  <input name="password2" placeholder="Repeat new password" type="password"><br />
                  <input name="email" value="<?php echoSQL($connection, "select email from users where id = 2", "email");?>" placeholder="Email" type="text"><br />
                  <input name="phone" value="<?php echoSQL($connection, "select numPhone from users where id = 2", "numPhone");?>" placeholder="Phone number" type="text"><br />
				  <input id="optin" name="opt-check" type="checkbox"><label for="optin">Opt-in to monthly emails?</label>
				</div>
				<div class="6u$ 12u$(medium)">
					<input name="personalSave" type="submit" value="Save changes" class="button special">
				</div>
			</div>
         </div>
		 </form>
      </section>
   </body>
</html>