<?php
include("../../config.php");

if(isset($_POST['audienceId'])){
	$userId=$_SESSION['userId'];
	$audienceId=$_POST['audienceId'];
	$isLoved=mysqli_query($con, "SELECT * FROM user_like_user WHERE userId='$userId' and followingId='$audienceId'");
	if(mysqli_num_rows($isLoved)==1){
		$query = mysqli_query($con, "DELETE FROM user_like_user WHERE userId='$userId' and followingId='$audienceId'");
	}
}
?>