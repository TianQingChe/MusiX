<?php 
include("../../config.php");

	//Register button was pressed
	$title = $_POST['title'];
	$artistId = $_POST['artistId'];
	$cover = $_POST['cover'];
	$genre = 24;
	$duarion = $_POST['duarion'];
	$path = $_POST['path'];
	$language = 1;
	$wasSuccessful =mysqli_query($con,"INSERT into songs values ('','$title','$artistId','$cover','$genre','$duarion','$path','$language',0)");



?>