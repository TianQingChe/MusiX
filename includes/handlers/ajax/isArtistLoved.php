<?php
include("../../config.php");

if(isset($_POST['artistId'])){
	$userId=$_SESSION['userId'];
	$artistId=$_POST['artistId'];
	$query=mysqli_query($con, "SELECT * FROM user_like_user WHERE userId='$userId' and followingId='$artistId'");

	$resultArray=mysqli_num_rows($query);
	$arr = array ('num'=>$resultArray);
	echo json_encode($arr);
}
?>