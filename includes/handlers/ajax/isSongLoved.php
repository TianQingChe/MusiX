<?php
include("../../config.php");

if(isset($_POST['songId'])){
	$userId=$_SESSION['userId'];
	$songId=$_POST['songId'];
	$query=mysqli_query($con, "SELECT * FROM user_like_song WHERE userId='$userId' and songId='$songId'");

	$resultArray=mysqli_num_rows($query);
	$arr = array ('num'=>$resultArray);
	echo json_encode($arr);
}
?>