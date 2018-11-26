<?php
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
            <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
              Username:
              <input type="text" id="username" name="loginusr" value=""/><br>
              Password:
              <input type="password" id="password" name="loginpass" value=""/> <br>
              <a href="home.php" class="button">Start Budgeting</a><br>
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
            <button class="button" onclick="openForm()">Sign Up!</button>
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

					</div>
				</div>
			</section>

				<?php

				//	if(isset())

				?>


        <div class="form-popup" id="myForm">
          <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
            <h1>Sign Up</h1>

            <label for="usr"><b>Username:</b></label>
            <input type="text" placeholder="Enter Username" name="signupusr" required>

            <label for="email"><b>Email:</b></label>
            <input type="text" placeholder="Enter Email" name="signupemail" required>

            <label for="psw"><b>Password:</b></label>
            <input type="password" placeholder="Enter Password" name="signuppsw" required>

            <input type="submit" name="signup" value="Sign Up!"><br>
            <button type="button" class="button" onclick="closeForm()">Close</button>
          </form>
        </div>

        <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
        </script>
</html>

<?php


 ?>
