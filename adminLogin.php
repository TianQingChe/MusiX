<?php
	include("includes/config.php");
	include("includes/classes/Account.php");
	include("includes/classes/Constants.php");

	$account = new Account($con);

	include("includes/handlers/register-handler.php");
	include("includes/handlers/login-handler.php");

?>

<html>
<head>
	<title>Welcome to MusiX!</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>
	<?php 
		if(isset($_POST['registerButton'])){
			echo '<script>
					$(document).ready(function(){
						$("#loginForm").hide();
						$("#registerForm").show();
					});
				</script>';
		}else{
			echo '<script>
					$(document).ready(function(){
						$("#loginForm").show();
						$("#registerForm").hide();
					});
				</script>';
		}
	?>
	<div id="background">
		<div id="loginContainer">
			<div id="inputContainer">
				<form id="loginForm" action="login.php" method="POST">
					<h2>Login to your admin account</h2>
					<p>
						<?php echo $account->getError(Constants::$loginFailed); ?>
						<!-- <label for="loginUsername">Username</label> -->
						<input id="loginUsername" name="loginUsername" type="text" placeholder="Username" required>
					</p>
					<p>
						<!-- <label for="loginPassword">Password</label> -->
						<input id="loginPassword" name="loginPassword" type="password" placeholder="Password" required>
					</p>

					<button type="submit" name="loginButton">LOG IN</button>

					
				</form>

			</div>

			<div id="loginText">
				<h1>Manage Site Data</h1>
			</div>

		</div>
	</div>

</body>
</html>