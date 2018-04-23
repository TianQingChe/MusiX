<?php
include("../../config.php");

if(isset($_POST['audienceId'])){
	$userId=$_SESSION['userId'];
	$audienceId=$_POST['audienceId'];
	$query=mysqli_query($con, "SELECT * FROM user_like_user WHERE userId='$userId' and followingId='$audienceId'");

	$resultArray=mysqli_num_rows($query);
	$arr = array ('num'=>$resultArray);
	echo json_encode($arr);
}
?>