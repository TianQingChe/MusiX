<?php
include("includes/artistIncludedFiles.php");
?>

<div class="playlistsContainer">

	<div class="gridViewContainer">
		<h2>SONGS</h2>

		<div class="buttonItems">
			<button class="button green" onclick="openPage('createSong.php?id=<?php echo $userLoggedIn->getId(); ?>')">NEW SONG</button>
		</div>

</div>

<div class="tracklistContainer">
	<ul class="tracklist">

		<?php 
			$followersId= mysqli_query($con, "SELECT id FROM songs where artistId=".$userLoggedIn->getId());
			$followers=array();
			while($row = mysqli_fetch_array($followersId)) {
			   $follwerId=$row['id'];
			   $follwer=new Song($con,$follwerId);
			   array_push($followers,$follwer);
			}
			$i=1;
			foreach($followers as $follwer){
					echo "<li class='tracklistRow'>
							<div class='trackCount'>
								<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $follwer->getId() . "\", tempPlaylist, true)'>
								<span class='trackNumber'>$i</span>
							</div>
							<div class='trackInfo'>
								<span class='trackName' role='link' tabindex='0' onclick='openPage(\"artistSong.php?id=" . $follwer->getId() . "\")'>"
							  . $follwer->getTitle() . "</span>
							</div>
							<div class='trackOptions'>
								<input type='hidden' class='songId' value='" . $follwer->getId() . "'>
								<img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
							</div>

							<div class='trackDuration'>
								<span class='duration'>" . $follwer->getDuration() . "</span>
							</div>
				     	</li>";
				$i+=1;
			}
		?>

	</ul>
</div>

<nav class="optionsMenu">
	<input type="hidden" class="songId">
	<?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
</nav>