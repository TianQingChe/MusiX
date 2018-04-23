<?php
include("includes/artistIncludedFiles.php");
if(isset($_GET['id'])) {
	$artistId = $_GET['id'];
}
else {
	header("Location: audienceindex.php");
}
$artist = new Artist($con, $artistId);
?>
<script>

$(document).ready(function(){
	var aId=$("#saveArtistId").attr("aId");
	$.post("includes/handlers/ajax/isArtistLoved.php",{artistId: aId},function(data){
		var q=JSON.parse(data);
		// console.log(q.num);
		// console.log(q.num);
		if(q.num==1){
			loveArtistVisual();
		}else{
			unloveArtistVisual();
		}
	});
})

function loveArtistVisual(){
	$(".controlButton.love.artist").show();
	$(".controlButton.unlove.artist").hide();
}

function unloveArtistVisual(){
	$(".controlButton.unlove.artist").show();
	$(".controlButton.love.artist").hide();
}

function loveArtist(){
	$(".controlButton.love.artist").show();
	$(".controlButton.unlove.artist").hide();
	//insert into db
	var aId=$("#saveArtistId").attr("aId");
	$.post("includes/handlers/ajax/updateArtistLove.php",{artistId: aId});
}

function unloveArtist(){
	$(".controlButton.unlove.artist").show();
	$(".controlButton.love.artist").hide();
	//delete from db
	var aId=$("#saveArtistId").attr("aId");
	$.post("includes/handlers/ajax/updateArtistUnLove.php",{artistId: aId});
}
</script>

<div class="entityInfo borderBottom" id="saveArtistId" aId="<?php echo $artist->getId(); ?>">

	<div class="centerSection">

		<div class="artistInfo">

			<h1 class="artistName"><?php echo $artist->getName(); ?></h1>

			<div class="headerButtons">
				<button class="button green" onclick="playFirstSong()">PLAY</button>
				<button class="controlButton unlove artist" title="Unlove button" onclick="loveArtist()">
						<img src="assets/images/icons/unlove.png" alt="Cancel Love">
				</button>
				<button class="controlButton love artist" title="Love button" style="display: none;" onclick="unloveArtist()">
					<img src="assets/images/icons/love.png" alt="Love">
				</button>
			</div>

		</div>

	</div>

</div>


<div class="tracklistContainer borderBottom">
	<h2>SONGS</h2>
	<ul class="tracklist">
		
		<?php
		$songIdArray = $artist->getSongIds();

		$i = 1;
		foreach($songIdArray as $songId) {

			if($i > 5) {
				break;
			}

			$albumSong = new Song($con, $songId);
			$albumArtist = $albumSong->getArtist();

			echo "<li class='tracklistRow'>
					<div class='trackCount'>
						<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)'>
						<span class='trackNumber'>$i</span>
					</div>


					<div class='trackInfo'>
						<span class='trackName' onclick='openPage(\"artistSong.php?id=" . $albumSong->getId() . "\")'>" . $albumSong->getTitle() . "</span>
						<span class='artistName' onclick='openPage(\"artistArtist.php?id=" . $albumArtist->getId() . "\")'>" . $albumArtist->getName() . "</span>
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
		</script>

	</ul>
</div>

<nav class="optionsMenu">
	<input type="hidden" class="songId">
	<?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
</nav>
