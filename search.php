<?php
include("includes/includedFiles.php");

if(isset($_GET['term'])) {
	$term = urldecode($_GET['term']);
}
else {
	$term = "";
}
?>

<div class="searchContainer">

	<h4>Search for an artist, song playlist or user</h4>
	<input type="text" class="searchInput" value="<?php echo $term; ?>" placeholder="Start typing..." onfocus="this.value = this.value">

</div>

<script>

$(".searchInput").focus();

$(function() {
	// var timer;
	$(".searchInput").keyup(function() {
		clearTimeout(timer);
		timer = setTimeout(function() {
			var val = $(".searchInput").val();
			openPage("search.php?term=" + val);
		}, 2000);
	})


})

</script>

<?php if($term == "") exit(); ?>

<div id="search" class="tracklistContainer borderBottom">
	<h2>SONGS</h2>
	<ul id="trackPart" class="tracklist">
		
		<?php
		$songsQuery = mysqli_query($con, "SELECT id FROM songs WHERE title LIKE '$term%' LIMIT 10");

		if(mysqli_num_rows($songsQuery) == 0) {
			echo "<span class='noResults'>No songs found matching " . $term . "</span>";
		}



		$songIdArray = array();

		$i = 1;
		while($row = mysqli_fetch_array($songsQuery)) {

			if($i > 15) {
				break;
			}

			array_push($songIdArray, $row['id']);

			$albumSong = new Song($con, $row['id']);
			$albumArtist = $albumSong->getArtist();

			echo "<li class='tracklistRow'>
					<div class='trackCount'>
						<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)'>
						<span class='trackNumber'>$i</span>
					</div>


					<div class='trackInfo'>
						<span role='link' tabindex='0' class='trackName' onclick='openPage(\"song.php?id=" . $albumSong->getId() ."\")'>" . $albumSong->getTitle() . "</span>
						<span role='link' tabindex='0' class='artistName' onclick='openPage(\"artist.php?id=" . $albumArtist->getId() ."\")'>" . $albumArtist->getName() . "</span>
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
			var tracks;
			$.post("https://itunes.apple.com/search?term="+'<?php echo $term; ?>'+"&entity=musicTrack&limit=10",function(data){
			    tracks=JSON.parse(data);
			    var list="";
			    console.log(tracks);
				for (var i = 0, l = tracks.results.length; i < l; i++) {
					// console.log(tracks.results[i]["trackName"]);
					var trackInfo="<div class='trackInfo'><span class='trackName'><a id='tName' target='_blank' href="+tracks.results[i]["trackViewUrl"]+">"+tracks.results[i]["trackName"]+"</a></span><span class='artistName'><a id='aName' target='_blank' href="+tracks.results[i]["artistViewUrl"]+">"+tracks.results[i]["artistName"]+"</a></span></div>";

					var trackDuration="<div class='trackDuration'><span class='duration'>"+formatTime(tracks.results[i]["trackTimeMillis"])+"</span></div>";
					list+="<li class='tracklistRow'>"+trackInfo+trackDuration+"</li>";
			    }
			    document.getElementById('trackPart').innerHTML += "<h3>From Itunes</h3>"+list;

		    });

			var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
			tempPlaylist = JSON.parse(tempSongIds);
			function formatTime(millis) {
				var seconds=millis/1000;
				var time = Math.round(seconds);
				var minutes = Math.floor(time / 60); //Rounds down
				var seconds = time - (minutes * 60);

				var extraZero = (seconds < 10) ? "0" : "";

				return minutes + ":" + extraZero + seconds;
			}
		</script>

	</ul>
</div>


<div id="artistPart" class="artistsContainer borderBottom">

	<h2>ARTISTS</h2>

	<?php
	$artistsQuery = mysqli_query($con, "SELECT id FROM users WHERE name LIKE '$term%' LIMIT 10");
	
	if(mysqli_num_rows($artistsQuery) == 0) {
		echo "<span class='noResults'>No artists found matching " . $term . "</span>";
	}

	while($row = mysqli_fetch_array($artistsQuery)) {

		$artistFound = new Artist($con, $row['id']);

		echo "<div class='searchResultRow'>
				<div class='artistName'>

					<span role='link' tabindex='0' onclick='openPage(\"artist.php?id=" . $artistFound->getId() ."\")'>
					"
					. $artistFound->getName() .
					"
					</span>

				</div>

			</div>";

	}


	?>
	<script>
			var tracks;
			$.post("https://itunes.apple.com/search?term="+'<?php echo $term; ?>'+"&entity=musicArtist&limit=10",function(data){
			    artists=JSON.parse(data);
			    var list="";
			    console.log(artists);
				for (var i = 0, l = artists.results.length; i < l; i++) {
					// console.log(tracks.results[i]["trackName"]);
					var artistInfo="<div class='trackInfo'><span class='trackName'><a id='tName' target='_blank' href="+artists.results[i]["artistLinkUrl"]+">"+artists.results[i]["artistName"]+"</a></span>"+"<span class='artistName'>"+artists.results[i]["primaryGenreName"]+"</a></span></div>";
					list+="<li class='tracklistRow'>"+artistInfo+"</li>";
			    }
			    document.getElementById('artistPart').innerHTML += "<h3>From Itunes</h3>"+list;

		    });
		</script>

</div>

<div class="tracklistContainer borderBottom">
	<h2>PLAYLISTS</h2>
	<?php
		$albumQuery = mysqli_query($con, "SELECT * FROM playlists WHERE `name` LIKE '$term%' LIMIT 10");

		if(mysqli_num_rows($albumQuery) == 0) {
			echo "<span class='noResults'>No playlists found matching " . $term . "</span>";
		}

		while($row = mysqli_fetch_array($albumQuery)) {

			echo "<li class='tracklistRow'>
			        <div class='trackInfo'>
					<span class='trackName' role='link' tabindex='0' onclick='openPage(\"otherplaylist.php?id=" . $row['id'] . "\")'>". $row['name'] ."</span>
					<span role='link' tabindex='0' class='artistName'>" . $row['owner'] . "</span>
					</div></li>
					";


		}
	?>

</div>

<div class="tracklistContainer borderBottom">
	<h2>USERS</h2>
	<?php
		$albumQuery = mysqli_query($con, "SELECT * FROM users WHERE `username` LIKE '$term%' LIMIT 10");

		if(mysqli_num_rows($albumQuery) == 0) {
			echo "<span class='noResults'>No users found matching " . $term . "</span>";
		}

		while($row = mysqli_fetch_array($albumQuery)) {

			echo "<li class='tracklistRow'>
			        <div class='trackInfo'>
					<span class='trackName' role='link' tabindex='0' onclick='openPage(\"user.php?id=" . $row['id'] . "\")'>". $row['username'] ."</span>
					
					</div></li>
					";


		}
	?>

</div>

<nav class="optionsMenu">
	<input type="hidden" class="songId">
	<?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
</nav>








