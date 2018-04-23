<?php
include("../../config.php");

if(isset($_POST['artistId'])){
	$userId=$_SESSION['userId'];
	$artistId=$_POST['artistId'];
	$isLoved=mysqli_query($con, "SELECT * FROM user_like_user WHERE userId='$userId' and followingId='$artistId'");
	if(mysqli_num_rows($isLoved)==0){
		$query = mysqli_query($con, "INSERT INTO user_like_user (userId,followingId) VALUES ('$userId','$artistId')");
	}
}
?>