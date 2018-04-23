<?php
include("../../config.php");

if(isset($_POST['audienceId'])){
	$userId=$_SESSION['userId'];
	$audienceId=$_POST['audienceId'];
	$isLoved=mysqli_query($con, "SELECT * FROM user_like_user WHERE userId='$userId' and followingId='$audienceId'");
	if(mysqli_num_rows($isLoved)==0){
		$query = mysqli_query($con, "INSERT INTO user_like_user (userId,followingId) VALUES ('$userId','$audienceId')");
	}
}
?>