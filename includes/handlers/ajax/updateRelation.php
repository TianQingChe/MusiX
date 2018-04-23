<?php
include("../../config.php");


	$id=$_POST['id'];
	$followerId=$_POST['followerId'];
	$followingId=$_POST['followingId'];
	$isLoved=mysqli_query($con, "UPDATE user_like_user set userId='$followerId',followingId='$followingId' where id='$id'");

?>