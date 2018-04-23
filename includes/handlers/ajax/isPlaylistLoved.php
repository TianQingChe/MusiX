<?php
include("../../config.php");

if(isset($_POST['playlistId'])){
	$userId=$_SESSION['userId'];
	$playlistId=$_POST['playlistId'];
	$query=mysqli_query($con, "SELECT * FROM user_like_playlist WHERE userId='$userId' and playlistId='$playlistId'");

	$resultArray=mysqli_num_rows($query);
	$arr = array ('num'=>$resultArray);
	echo json_encode($arr);
}
?>