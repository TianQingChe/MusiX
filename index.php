<?php $con = mysqli_connect("cs5200-spring2018-yu.ctgkaydbplwu.us-east-2.rds.amazonaws.com", "yangfan", "Ok*64818503", "music",3306); ?>


<html>
<html>
<head>
	<title>Welcome to MusiX!</title>
	<link meida="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="assets/css/indexNav.css">
	<link rel="stylesheet" type="text/css" href="assets/css/index.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="assets/js/script.js"></script>
	<link rel="icon" href="assets/images/icons/logo.png" type="image/x-icon"/>
</head>
<body style="padding-top: 60px;">

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="">MusiX</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="adminLogin.php">Admin</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="login.php">Log In</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>

	
<div id="loginText" style="text-align: center;"><h1>Recently Popular</h1></div>

<div class="playlistsContainer">
	<div class="gridViewContainer">

	<?php
		$albumQuery = mysqli_query($con, "SELECT * FROM songs ORDER BY plays LIMIT 9");

		while($row = mysqli_fetch_array($albumQuery)) {
			



			echo "<div class='followViewItem'>
					<a href='indexSong.php?id=" . $row['id'] . "' style='text-decoration:none;'>
						<div class='followingImage'><img src='" . $row['cover'] . "'></div>

						<div class='gridViewInfo'>"
							. $row['title'] .
						"</div>
					</a>

				</div>";



		}
	?>
	</div>

</div>
</body>
</html>