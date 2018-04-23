<?php
include("../../config.php");

if(isset($_POST['songId'])){
	$userId=$_SESSION['userId'];
	$songId=$_POST['songId'];
	$isLoved=mysqli_query($con, "SELECT * FROM user_like_song WHERE userId='$userId' and songId='$songId'");
	echo "aaaa";
	if(mysqli_num_rows($isLoved)==0){
		$query = mysqli_query($con, "INSERT INTO user_like_song (userId,songId) VALUES ('$userId','$songId')");
	}
}
?>