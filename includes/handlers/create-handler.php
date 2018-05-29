<?php 
$con = mysqli_connect("cs5200-spring2018-yu.ctgkaydbplwu.us-east-2.rds.amazonaws.com", "yangfan", "Ok*64818503", "music",3306);

if(isset($_POST['songButton'])) {
	//Register button was pressed
	// $con= $_POST['con'];
	$artistId=$_POST['artistId'];
	$title = $_POST['title'];
	$duration = $_POST['duration'];
	$language = $_POST['language'];
	$genre = $_POST['genre'];
	$cover = $_POST['cover'];
	$path = $_POST['path'];

	$result = mysqli_query($con, "INSERT INTO songs (title,artistId,duration,`language`,genre,cover,`path`,plays) VALUES ('$title', '$artistId','$duration','$language','$genre', '$cover', '$path', 0)");

	if($result){
			header("Location: ../../yourWork.php");
		}else{
			echo "Release failed, please check your song information";
		}

	}


?>