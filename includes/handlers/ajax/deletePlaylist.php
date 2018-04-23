<?php
include("../../config.php");

if(isset($_POST['playlistId'])) {
	$playlistId = $_POST['playlistId'];

	$playlistQuery = mysqli_query($con, "DELETE FROM playlists WHERE id='$playlistId'");
	mysqli_query($con, "DELETE FROM playlist_song WHERE playlistId='$playlistId'");
	mysqli_query($con, "DELETE FROM user_like_playlist WHERE playlistId='$playlistId'");
}
else {
	echo "PlaylistId was not passed into deletePlaylist.php";
}


?>