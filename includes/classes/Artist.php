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
		return $firstName['name']." ".$lastName['name'];
	}
}


?>