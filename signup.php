    <?php
        require_once('db_con.php');
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
                    
                        if(isset($_POST["signup"]) &&
                        isset($_POST["usr"]) &&
                        isset($_POST["email"]) &&
                        isset($_POST["psw"]) &&
                        isset($_POST["fname"]) &&
                        isset($_POST["lname"]) &&
                        isset($_POST["phone"])):
                            if($_POST["usr"] == ""):?>
                                <div style="color: red">You must fill out all information of the Sign Up page!</div><?php
                            elseif($_POST["psw"] == ""):?>
                                <div style="color: red">You must fill out all information of the Sign Up page!</div><?php
                            elseif($_POST["fname"] == ""):?>
                                <div style="color: red">You must fill out all information of the Sign Up page!</div><?php
                            elseif($_POST["lname"] == ""):?>
                                <div style="color: red">You must fill out all information of the Sign Up page!</div><?php
                            elseif($_POST["email"] == ""):?>
                                <div style="color: red">You must fill out all information of the Sign Up page!</div><?php
                            else:
                    
                                $connection = connect_to_db();
                    
                                $sql = sprintf("Select 1 FROM users WHERE username = '%s'",
                                $connection->real_escape_string($_POST["usr"]));
                                
                                // execute query
                                $result = $connection->query($sql) or die(mysqli_error($connection));  
                
                                // check whether we found a row
                                if ($result->num_rows == 1):?>
                                    <div style="color: red">Username is already used!</div><?php
                                else:
                                    $sql = sprintf("INSERT INTO `users`(`username`,`password`,`fname`,`lname`,`email`,`numPhone`) 
                                                    VALUES ('%s', password('%s'),'%s','%s','%s','%s')",
                                                    $connection->real_escape_string($_POST["usr"]),
                                                    $connection->real_escape_string($_POST["psw"]),
                                                    $connection->real_escape_string($_POST["fname"]),
                                                    $connection->real_escape_string($_POST["lname"]),
                                                    $connection->real_escape_string($_POST["email"]),
                                                    $connection->real_escape_string($_POST["phone"]));
                                    // execute query
                                    $result = $connection->query($sql) or die(mysqli_error($connection));  
                
                                    if($result === false):
                                        die("Could not query database");
                                    else:?>
                                        
                                        <script>
                                            document.getElementById("overlay").style.display = "block";
                                        </script><?php
                                        $host = $_SERVER["HTTP_HOST"];
                                        $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
                                        header("Location: http://$host$path/success.php");
                                        exit;
                
                                    endif;
                                endif;
                            endif;
                        endif;
                    
                    
                    ?>

                    <label for="usr"><b>Username:</b></label>
                    <input type="text" placeholder="Enter Username" name="usr">
                    <br>
                    <label for="psw"><b>Password:</b></label>
                    <input type="password" placeholder="Enter Password" name="psw">
                    <br>
                    <label for="fname"><b>First Name:</b></label>
                    <input type="text" placeholder="Enter First Name" name="fname">
                    <br>
                    <label for="lname"><b>Last Name:</b></label>
                    <input type="text" placeholder="Enter Last Name" name="lname">
                    <br>
                    <label for="email"><b>Email:</b></label>
                    <input type="text" placeholder="Enter Email" name="email">
                    <br>
                    <label for="phone"><b>Phone # (optional):</b></label>
                    <input type="text" placeholder="###-###-####" name="phone">
                    <br>
                    <button type="submit" class="button" name="signup">Sign Up!</button>
                    <a href="index.php" class="button">Cancel</a>
                    
                </form>
            </div>
    </body>
</html>

