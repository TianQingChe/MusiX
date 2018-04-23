<?php

	class Artist{
		private $con;
		private $id;
		private $name;
	
	public function __construct($con,$id) {
			$this->con = $con;
			$this->id=$id;
	}

	public function getName(){
		$firstQuery = mysqli_query($this->con, "SELECT firstName FROM users WHERE id='$this->id' and userType=2");
		$firstName = mysqli_fetch_array($firstQuery);
		$lastQuery = mysqli_query($this->con, "SELECT lastName FROM users WHERE id='$this->id' and userType=2");
		$lastName = mysqli_fetch_array($lastQuery);
		return $firstName['firstName']." ".$lastName['lastName'];
	}

	public function getUsername(){
			$query = mysqli_query($this->con, "SELECT username FROM users WHERE id='$this->id'");
			$row = mysqli_fetch_array($query);
			return $row['username'];
	}

	public function getId() {
			return $this->id;
	}

	public function getSongIds() {

		$query = mysqli_query($this->con, "SELECT id FROM songs WHERE artistId='$this->id' ORDER BY plays ASC");

		$array = array();

		while($row = mysqli_fetch_array($query)) {
			array_push($array, $row['id']);
		}

		return $array;

	}
}


?>