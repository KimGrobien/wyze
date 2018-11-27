<?php
  require_once('db_con.php');
	session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Wyze</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/landing.css"/>
    <style>
      .button{
        margin: 0px auto;
      }
    </style>
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
					<h1>Login</h1>
				</header>

				<div class="flex">
          <form id="myform" action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
            Username:
            <input type="text" id="username" name="loginusr" value=""/><br>
            Password:
            <input type="password" id="password" name="loginpass" value=""/> <br>
            
            <?php
              if(isset($_POST["login"]) &&
                isset($_POST["loginusr"]) &&
                isset($_POST["loginpass"])):
                  if($_POST["loginusr"] == ""):
                    echo("Please enter a username");
                  elseif($_POST["loginpass"] == ""):
                    echo("Please enter a password");
                  else:
                    $connection = connect_to_db();
              
                    $sql = sprintf("Select 1 FROM users WHERE username = '%s' AND password = password('%s')",
                    $connection->real_escape_string($_POST["loginusr"]),
                    $connection->real_escape_string($_POST["loginpass"]));
                    
                    // execute query
                    $result = $connection->query($sql) or die(mysqli_error());   
                    
                    // check whether we found a row
                    if ($result->num_rows == 1):
                      $_SESSION["authenticated"] = true;
                      setcookie("loginusr", $_COOKIE["loginusr"], time() + 7 * 24 * 60 * 60);
                    
                      $host = $_SERVER["HTTP_HOST"];
                      $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
                      header("Location: http://$host$path/home.php");
                      exit;
                    else:
                      echo("Incorrect username or password");
                    endif;
                  endif;
              endif;
            ?>
            <br>
            <button type="submit" name="login" class="button">Start Budgeting</button>
            <!--<a href="index.php?submit" class="button" id="login" name="login">Start Budgeting</a>-->
            <br>
            <a href="#three">Not a member? Learn More</a>
          </form>
				</div>
			</div>
		</section>
  <!-- Three -->
  	<section id="three" class="wrapper align-center">
  		<div class="inner">
  			<div class="flex flex-2">
          <article>
  				<h1><strong>About Wyze</strong></h1>
            <p>
              Wyze is a budgeting app aimed towards people who want to learn more about
              personal finance. Wyze lets you take control of your spending by teaching you
              the basics of personal finance, suggesting a spending budget, and helping you save
              for the future goals you hope to achieve!
            </p>
            <a href="signup.php" class="button">Sign Up!</a>
          </article>
          <article>
            <h1><strong>Personal Finance Tutorials</strong></h1>
            <a href="https://www.youtube.com/watch?v=r7xsyacbObQ">Stock Market 101</a><br>
            <a href="https://www.youtube.com/watch?v=E57KmpbNzLI">Investing in YOURSELF</a><br><br>
            <h1><strong>Recent Financial Articles</strong></h1>
            <a href="https://finance.yahoo.com/news/dow-drops-200-points-treasury-yields-move-higher-141746422.php">Stock Market News</a><br>
  					<a href="https://www.bloomberg.com/news/articles/2018-06-21/america-s-millennials-are-waking-up-to-a-grim-financial-future">Our Future</a><br>
  				  <a href="https://www.washingtonpost.com/business/millennials-get-plenty-of-financial-advice--most-of-it-is-wrong/2018/05/18/575247ec-5a10-11e8-8836-a4a123c359ab_story.php?noredirect=on">
            Improvement as a MILLENNIAL</a>
          </article>
  			</div>
  		</div>
  	</section>
	</body>
</html>