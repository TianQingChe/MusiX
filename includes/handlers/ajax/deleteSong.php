<?php 
include("../../config.php");


	//Register button was pressed
	$songId = $_POST['songId'];
	$wasSuccessful = mysqli_query($con, "DELETE FROM songs WHERE id='$songId'");
	mysqli_query($con, "DELETE FROM playlist_song WHERE songId='$songId'");
	mysqli_query($con, "DELETE FROM user_like_song WHERE songId='$songId'");


?>