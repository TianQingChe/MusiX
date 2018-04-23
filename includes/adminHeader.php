<?php

	include("includes/config.php");
	include("includes/classes/User.php");
	include("includes/classes/Artist.php");
	include("includes/classes/Song.php");
	include("includes/classes/Playlist.php");

//session_destroy();

if(isset($_SESSION['userLoggedIn'])){
	$userLoggedIn = new User($con, $_SESSION['userLoggedIn']);
	$username = $userLoggedIn->getUsername();
	echo "<script>userLoggedIn='$username'</script>";
}
else{
	header("Location: adminLogin.php");
}

?>

<html>
<head>
	<title>Welcome to MusiX!</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="assets/js/script.js"></script>
	<link rel="icon" href="assets/images/icons/logo.png" type="image/x-icon"/>
</head>

<body>

	<div id="mainContainer">

		<div id="topContainer">
			<?php include("includes/adminNavBarContainer.php"); ?>
			<div id="mainViewContainer">
				<div id="mainContent">