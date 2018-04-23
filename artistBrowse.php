<?php 
include("includes/artistIncludedFiles.php"); 
?>

<h1 class="pageHeadingBig">Your might also like</h1>

<div class="tracklistContainer">
	<ul class="tracklist">

	<?php
		$songQuery = mysqli_query($con, "SELECT * FROM songs order by rand() limit 7");

		$songArray = array();
		$songIdArray=array();

		while($row = mysqli_fetch_array($songQuery)) {
			array_push($songArray, $row);
			array_push($songIdArray, $row['id']);
		}
		$i = 1;
		foreach($songArray as $row) {
			$albumSong = new Song($con, $row['id']);
			$albumArtist = $albumSong->getArtist();
			echo "<li class='tracklistRow'>
					<div class='trackCount'>
						<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(". $row['id'] .",tempPlaylist,true)'>
						<span class='trackNumber'>$i</span>
					</div>
					<div class='trackInfo'>

						<span class='trackName' role='link' tabindex='0' onclick='openPage(\"artistSong.php?id=" . $albumSong->getId() . "\")'>"
						  . $albumSong->getTitle() . "</span>
						<span class='artistName' role='link' tabindex='0' onclick='openPage(\"artistArtist.php?id=" . $albumArtist->getId() . "\")'>" . $albumArtist->getName() . "</span>
					</div>

					<div class='trackOptions'>
						<input type='hidden' class='songId' value='" . $albumSong->getId() . "'>
						<img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
					</div>

					<div class='trackDuration'>
						<span class='duration'>" . $albumSong->getDuration() . "</span>
					</div>
				</li>";
			$i = $i + 1;
		}
	?>

	<script>
			var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
			tempPlaylist = JSON.parse(tempSongIds);
			// console.log(tempPlaylist);
	</script>
	</ul>

</div>

<nav class="optionsMenu">
	<input type="hidden" class="songId">
	<?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
</nav>