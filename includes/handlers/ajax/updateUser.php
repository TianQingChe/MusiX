<?php 
include("../../config.php");
include("../../classes/Account.php");
$userId=$_POST['userId'];
$username = $_POST['username'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$email2 = $_POST['email2'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$userType=$_POST['userType']; 
$account=new Account($con);
	$wasSuccessful = mysqli_query($con, "UPDATE users SET username='$username',firstName='$firstName',lastName='$lastName',email='$email',userType='$userType',password='$password' WHERE id='$userId'");

?>