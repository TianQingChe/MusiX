<?php 
include("../../config.php");

	//Register button was pressed
	$followerId = $_POST['followerId'];
	$followingId = $_POST['followingId'];
	$wasSuccessful =mysqli_query($con,"INSERT into user_like_user values ('','$followerId','$followingId')");



?>