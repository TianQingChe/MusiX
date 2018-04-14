<?php

include("includes/config.php");
include("includes/classes/Artist.php");
include("includes/classes/Song.php");

//session_destroy();

if(isset($_SESSION['userLoggedIn'])){
	$userLoggedIn=$_SESSION['userLoggedIn'];
}
else{
	header("Location: login.php");
}

?>

<html>
<head>
	<title>Welcome to MusiX!</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="icon" href="assets/images/icons/logo.png" type="image/x-icon"/>
</head>

<body>
	<div id="mainContainer">

		<div id="topContainer">
			<?php include("includes/navBarContainer.php"); ?>
			<div id="mainViewContainer">
				<div id="mainContent">