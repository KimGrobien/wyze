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
               <div class="4u 12u$(medium)">
                  <h3>Account 1</h3>
                  <div class="table-wrapper">
                     <table>
                        <thead>
                           <caption>Investment (bought a boat)</caption>
                           <tr>
                              <th>Attribute 1</th>
                              <th>Attribute 2</th>
                              <th>Attribute 3</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>one</td>
                              <td>two</td>
                              <td>three</td>
                           </tr>
                           <tr>
                              <td>one</td>
                              <td>two</td>
                              <td>three</td>
                           </tr>
                           <tr>
                              <td>one</td>
                              <td>two</td>
                              <td>three</td>
                           </tr>
                           <tr>
                              <td>one</td>
                              <td>two</td>
                              <td>three</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <a href="#" class="button special">Edit</a>
               </div>
               <div class="4u 12u$(medium)">
                  <h3>Account 2</h3>
                  <div class="table-wrapper">
                     <table>
                        <thead>
                           <caption>Loan (bought a big ass car)</caption>
                           <tr>
                              <th>Attribute 1</th>
                              <th>Attribute 2</th>
                              <th>Attribute 3</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>one</td>
                              <td>two</td>
                              <td>three</td>
                           </tr>
                           <tr>
                              <td>one</td>
                              <td>two</td>
                              <td>three</td>
                           </tr>
                           <tr>
                              <td>one</td>
                              <td>two</td>
                              <td>three</td>
                           </tr>
                           <tr>
                              <td>one</td>
                              <td>two</td>
                              <td>three</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <a href="#" class="button special">Edit</a>
               </div>
               <div class="4u$ 12u$(medium)">
                  <h3>Add a new account</h3>
                  <select name="demo-category" id="demo-category">
                     <option value="">- Account Type Dropdown -</option>
                     <option value="1">Bills</option>
                     <option value="1">Loans</option>
                     <option value="1">Cars</option>
                     <option value="1">Banking</option>
                     <option value="1">Investment</option>
                  </select>
                  <br />
                  <input name="" id="" value="" placeholder="Name" type="text"><br />
                  <input name="" id="" value="" placeholder="Attribute 1" type="text"><br />
                  <input name="" id="" value="" placeholder="Attribute 2" type="text"><br />
                  <input name="" id="" value="" placeholder="Attribute 3" type="text"><br />
                  <div class="6u$(small)">
                     <input id="test1" name="test" type="radio" checked><label for="test1">Radio 1</label>
                     <input id="test2" name="test" type="radio"><label for="test2">Radio 2</label>
                  </div>
                  <div class="6u$(small)">
                     <input id="check1" name="checkbox" type="checkbox"><label for="check1">Radio 1</label>
                     <input id="check2" name="checkbox" type="checkbox" checked><label for="check2">Radio 2</label>
                     <input id="check3" name="checkbox" type="checkbox"><label for="check3">Radio 2</label>
                  </div>
                  <a href="#" class="button special">Add account</a>
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