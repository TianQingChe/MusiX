<?php
if(isset($_POST['loginButton'])) {
	//Login button was pressed
	$username=$_POST['loginUsername'];
	$password=$_POST['loginPassword'];

	//login function
	$result=$account->login($username,$password);
	
	if($result!=-1){
		$_SESSION['userLoggedIn']=$username;
		$_SESSION['userId']=$account->getUserId($username);
		if($result==1){
			header("Location: audienceindex.php");
		}else if($result==1){
			header("Location: artistIndex.php");
		}else{
			header("Location: admin.php");
		}
	}
}
?>