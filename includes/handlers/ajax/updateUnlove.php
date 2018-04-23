<?php
include("../../config.php");

if(isset($_POST['songId'])){
	$userId=$_SESSION['userId'];
	$songId=$_POST['songId'];
	$isLoved=mysqli_query($con, "SELECT * FROM user_like_song WHERE userId='$userId' and songId='$songId'");
	if(mysqli_num_rows($isLoved)==1){
		$query = mysqli_query($con, "DELETE FROM user_like_song WHERE userId='$userId' and songId='$songId'");
	}
}
?>