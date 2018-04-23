<?php
	class Audience {

		private $con;
		private $id;

		public function __construct($con,$id) {
			$this->con = $con;
			$this->id=$id;
		}

		public function getUsername(){
			$query = mysqli_query($this->con, "SELECT username FROM users WHERE id='$this->id'");
			$row = mysqli_fetch_array($query);
			return $row['username'];
		}

		public function getUserType(){
			$query = mysqli_query($this->con, "SELECT userType FROM users WHERE id='$this->id'");
			$row = mysqli_fetch_array($query);
			return $row['userType'];
		}

		public function getEmail() {
			$query = mysqli_query($this->con, "SELECT email FROM users WHERE username='$this->username'");
			$row = mysqli_fetch_array($query);
			return $row['email'];
		}

		public function getId(){
			return $this->id;
		}

		public function getFirstAndLastName() {
			$query = mysqli_query($this->con, "SELECT concat(firstName, ' ', lastName) as 'name'  FROM users WHERE username='$this->username'");
			$row = mysqli_fetch_array($query);
			return $row['name'];
		}

	}
?>