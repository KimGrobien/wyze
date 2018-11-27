<?php

  if(isset($_POST["signup"]) &&
     isset($_POST["signupusr"]) &&
     isset($_POST["signupemail"]) &&
     isset($_POST["signuppsw"])):
       if($_POST["signupusr"] == ""):?>
         <div style="color: red">You must fill out all information of Sign Up page!</div><?php
       elseif($_POST["signupemail"] == ""):?>
         <div style="color: red">You must fill out all information of Sign Up page!</div><?php
       elseif($_POST["signuppsw"] == ""):?>
         <div style="color: red">You must fill out all information of Sign Up page!</div><?php
       else:
         
         $connection = connect_to_db();
         
         $sql = sprintf("Select 1 FROM users WHERE user = '%s'",
         $connection->real_escape_string($_POST["signupusr"]));

    // execute query
    $result = $connection->query($sql) or die(mysqli_error());           

    // check whether we found a row
    if ($result->num_rows == 1):
      ?><div style="color: red">Username is already used!</div><?php
    else:
      $sql = sprintf("INSERT INTO `users`() VALUES ('%s', password('%s'))",
               $connection->real_escape_string($_POST["user"]),
               $connection->real_escape_string($_POST["pass"]));
    endif;
    // execute query
    $result = $connection->query($sql) or die(mysqli_error($connection));  

    if ($result === false):
        die("Could not query database");
    
    endif;
endif;
endif;

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>WYZE Sign Up</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="assets/css/landing.css"/>
    </head>
    <body>
        <!-- Header -->
        <header id="header">
        <div class="inner">
	        <a href="index.php" class="logo"><strong>Wyze</strong></a>
    	    <nav id="nav">
		        Learn | Budget | Succeed
	        </nav>
	        <a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
        </div>
        </header>

        <!-- Banner -->
        <section id="banner">
        <div class="inner">
	    <header>
            <h1>Sign Up</h1>
        </header>
	    <div class="flex">
            <div class="form-popup" id="myForm">
                <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">

                    <label for="usr"><b>Username:</b></label>
                    <input type="text" placeholder="Enter Username" name="signupusr" required>
                    
                    <label for="email"><b>Email:</b></label>
                    <input type="text" placeholder="Enter Email" name="signupemail" required>
                    
                    <label for="psw"><b>Password:</b></label>
                    <input type="password" placeholder="Enter Password" name="signuppsw" required>
                    
                    <a href="" class="button" name="signup">Sign Up!</a><br>
                    <button type="button" class="button" onclick="closeForm()">Close</button>
                </form>
            </div>
        </div>
    </body>
</html>

