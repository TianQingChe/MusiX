<?php
include("../../config.php");

if(isset($_POST['playlistId'])){
	$userId=$_SESSION['userId'];
	$playlistId=$_POST['playlistId'];
	$isLoved=mysqli_query($con, "SELECT * FROM user_like_playlist WHERE userId='$userId' and playlistId='$playlistId'");
	if(mysqli_num_rows($isLoved)==1){
		$query = mysqli_query($con, "DELETE FROM user_like_playlist WHERE userId='$userId' and playlistId='$playlistId'");
	}
}
?>