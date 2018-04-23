<?php 
include("../../config.php");
include("../../classes/Account.php");


	//Register button was pressed
	$id = $_POST['id'];
	mysqli_query($con, "DELETE FROM user_like_user WHERE id='$id'");




?>