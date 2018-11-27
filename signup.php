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
    <body class="subpage">
        
        <!-- Header -->
        <header id="header">
        <div class="inner">
	        <a href="index.php" class="logo"><strong>WYZE</strong></a>
    	    <nav id="nav">
		        Learn | Budget | Succeed
	        </nav>
	        <a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
        </div>
        </header>

    
        <section id="main" class="wrapper">
        <div class="inner">
	    <header class="align-center">
            <h2>Sign Up</h2>
        </header>
            <div class="" id="myForm">
                <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
                    
                <?php

                    // check whether we found a row
                    if ($result->num_rows == 1):
                ?>      <div style="color: red">Username is already used!</div><?php
                    else:
                        $sql = sprintf("INSERT INTO `users`('username','password','fname','lname','email','numPhone') 
                                        VALUES ('%s', password('%s'),'%s','%s','%s','%s')",
                        $connection->real_escape_string($_POST["usr"]),
                        $connection->real_escape_string($_POST["psw"]),
                        $connection->real_escape_string($_POST["fname"]),
                        $connection->real_escape_string($_POST["lname"]),
                        $connection->real_escape_string($_POST["email"]),
                        $connection->real_escape_string($_POST["phone"]));
                        endif;

                        // execute query
                        $result = $connection->query($sql) or die(mysqli_error($connection));  

                        if ($result === false):
                            die("Could not query database");

                        endif;
                    endif;
            endif;



?>
                    

                    <label for="usr"><b>Username:</b></label>
                    <input type="text" placeholder="Enter Username" name="usr" required>
                    <br>
                    <label for="psw"><b>Password:</b></label>
                    <input type="password" placeholder="Enter Password" name="psw" required>
                    <br>
                    <label for="fname"><b>First Name:</b></label>
                    <input type="text" placeholder="Enter First Name" name="fname" required>
                    <br>
                    <label for="lname"><b>Last Name:</b></label>
                    <input type="text" placeholder="Enter Last Name" name="lname" required>
                    <br>
                    <label for="email"><b>Email:</b></label>
                    <input type="text" placeholder="Enter Email" name="email" required>
                    <br>
                    <label for="phone"><b>Phone # (optional):</b></label>
                    <input type="text" placeholder="###-###-####" name="phone" required>
                    <br>
                    <button type="submit" class="button" name="signup">Sign Up!</button>
                    <a href="index.php" class="button">Cancel</a>
                    
                </form>
            </div>
    </body>
</html>

