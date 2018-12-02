<?php
    function add_popup_template($header){  
    	echo '<head>
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
					<h2 class="popup">' . "$header" . '</h2>
				</header>';
    }
?>


