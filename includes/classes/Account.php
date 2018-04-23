<?php
	class Account {

		private $con;
		private $errorArray;

		public function __construct($con) {
			$this->con = $con;
			$this->errorArray = array();
		}

		public function login($un,$pw){
			// $pw=md5($pw);
			$query=mysqli_query($this->con,"SELECT userType FROM users WHERE username='$un' AND password='$pw'");
			if(mysqli_num_rows($query)==1){
				$result=mysqli_fetch_row($query);
				return $result[0];
			}else{
				array_push($this->errorArray,Constants::$loginFailed);
				return -1;
			}
		}

		public function getUserId($un){
			$query=mysqli_query($this->con,"SELECT id FROM users WHERE username='$un'");
			$result=mysqli_fetch_row($query);
			return $result[0];
		}


		public function register($un, $fn, $ln, $em, $em2, $pw, $pw2,$userType) {
			$this->validateUsername($un);
			$this->validateFirstName($fn);
			$this->validateLastName($ln);
			$this->validateEmails($em, $em2);
			$this->validatePasswords($pw, $pw2);

			if(empty($this->errorArray)) {
				//Insert into db
				return $this->insertUserDetails($un, $fn, $ln, $em, $pw,$userType);
			}
			else {
				return false;
			}

		}

		public function getError($error) {
			if(!in_array($error, $this->errorArray)) {
				$error = "";
			}
			return "<span class='errorMessage'>$error</span>";
		}

		private function insertUserDetails($un, $fn, $ln, $em, $pw,$userType) {
			// $encryptedPw = md5($pw);
			$profilePic = "assets/images/profile-pics/head_emerald.png";
			$date = date("Y-m-d");
			$name=$fn." ".$ln;

			$result = mysqli_query($this->con, "INSERT INTO users VALUES ('', '$un', '$pw','$userType','$fn', '$ln', '$em', '$date', '$profilePic','$name')");
			echo "";
			return $result;
		}


		private function validateUsername($un) {

			if(strlen($un) > 25 || strlen($un) < 3) {
				array_push($this->errorArray, Constants::$usernameCharacters);
				return;
			}

			//check if username exists
			$checkUserExists=mysqli_query($this->con,"SELECT username FROM users where username='$un'");//return the number of records selected
			if(mysqli_num_rows($checkUserExists)!=0){
				array_push($this->errorArray, Constants::$usernameTaken);
			}

		}

		private function validateFirstName($fn) {
			if(strlen($fn) > 25 || strlen($fn) < 2) {
				array_push($this->errorArray, Constants::$firstNameCharacters);
				return;
			}
		}

		private function validateLastName($ln) {
			if(strlen($ln) > 25 || strlen($ln) < 2) {
				array_push($this->errorArray, Constants::$lastNameCharacters);
				return;
			}
		}

		private function validateEmails($em, $em2) {
			if($em != $em2) {
				array_push($this->errorArray, Constants::$emailsDoNotMatch);
				return;
			}

			if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
				array_push($this->errorArray, Constants::$emailInvalid);
				return;
			}

			$checkUserEmailExists=mysqli_query($this->con,"SELECT email FROM users where email='$em'");//return the number of records selected
			if(mysqli_num_rows($checkUserEmailExists)!=0){
				array_push($this->errorArray, Constants::$emailTaken);
			}

		}

		private function validatePasswords($pw, $pw2) {
			
			if($pw != $pw2) {
				array_push($this->errorArray, Constants::$passwordsDoNoMatch);
				return;
			}

			if(preg_match('/[^A-Za-z0-9]/', $pw)) {
				array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
				return;
			}

			if(strlen($pw) > 30 || strlen($pw) < 3) {
				array_push($this->errorArray, Constants::$passwordCharacters);
				return;
			}

		}


	}
?>