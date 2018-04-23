<?php 
include("../../config.php");
include("../../classes/Account.php");


	//Register button was pressed
	$userId = $_POST['userId'];
	$wasSuccessful = mysqli_query($con, "DELETE FROM users WHERE id='$userId'");
	mysqli_query($con, "DELETE FROM user_like_user WHERE userId='$userId'");
	mysqli_query($con, "DELETE FROM user_like_user WHERE followingId='$userId'");




?>