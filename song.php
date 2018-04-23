<?php include("includes/includedFiles.php"); 

if(isset($_GET['id'])) {
	$songId = $_GET['id'];
}
else {
	header("Location: audienceindex.php");
}

$song = new Song($con, $songId);
$artist = $song->getArtist();
?>

<script>

$(document).ready(function(){
	var aId=$("#saveSongPageId").attr("aId");
	$.post("includes/handlers/ajax/isSongLoved.php",{songId: aId},function(data){
		var q=JSON.parse(data);
		// console.log(q.num);
		// console.log(q.num);
		if(q.num==1){
			loveSongPageVisual();
		}else{
			unloveSongPageVisual();
		}
	});
})

function loveSongPageVisual(){
	$(".controlButton.love.songPage").show();
	$(".controlButton.unlove.songPage").hide();
}

function unloveSongPageVisual(){
	$(".controlButton.unlove.songPage").show();
	$(".controlButton.love.songPage").hide();
}

function loveSongPage(){
	$(".controlButton.love.songPage").show();
	$(".controlButton.unlove.songPage").hide();
	//insert into db
	var aId=$("#saveSongPageId").attr("aId");
	$.post("includes/handlers/ajax/updateLove.php",{songId: aId});
}

function unloveSongPage(){
	$(".controlButton.unlove.songPage").show();
	$(".controlButton.love.songPage").hide();
	//delete from db
	var aId=$("#saveSongPageId").attr("aId");
	$.post("includes/handlers/ajax/updateUnlove.php",{songId: aId});
}
</script>

<div class="entityInfo" id="saveSongPageId" aId="<?php echo $song->getId(); ?>">

	<div class="leftSection">
		<div class="playlistImage">
			<img src="<?php echo $song->getCover(); ?>">
		</div>
	</div>

	<div class="rightSection">
		<div class="d1" ><h2><?php echo $song->getTitle(); ?></h2></div>
		<span class='trackName' role='link' tabindex='0' onclick="openPage('artist.php?id=<?php echo $artist->getId(); ?>')">
						  <p>By <?php echo $artist->getName(); ?></p></span>
		
		<span class='trackName'><p>Language: <?php echo $song->getLanguage(); ?></p></span>
		<span class='trackName'><p>Genre: <?php echo $song->getGenre(); ?></p></span>
		<span class='trackName'><p>Played: <?php echo $song->getPlays(); ?></p></span>
		<span class='trackName'><p><?php echo $song->getDuration(); ?></p></span>
		<?php 
			$songQuery = mysqli_query($con, "SELECT * FROM songs order by rand() limit 7");
			$songArray = array();
			$songIdArray=array();
            array_push($songIdArray,$song->getId());
			while($row = mysqli_fetch_array($songQuery)) {
				array_push($songArray, $row);
				array_push($songIdArray, $row['id']);
			}

			echo "<div class='trackCount' style='float:left;'>
					<img style='cursor:hand' id='songPlay' width=32px height=32px src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $song->getId() . "\", tempPlaylist, true)'>
			     </div>"
		?>
		<div class="d2" style="float: left;">
			<button class="controlButton unlove songPage" title="Unlove button" onclick="loveSongPage()">
						<img src="assets/images/icons/unlove.png" alt="Cancel Love">
		    </button>
			<button class="controlButton love songPage" title="Love button" style="display: none;" onclick="unloveSongPage()">
						<img src="assets/images/icons/love.png" alt="Love">
		    </button>
	    </div>
	    <div class='trackOptions' style="float: left;">
						<input type="hidden" class='songId' value="<?php echo $song->getId(); ?>">
						<img style="width: 20px;height: 20px;" class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
		</div>
	<script>
			var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
			tempPlaylist = JSON.parse(tempSongIds);
			// console.log(tempPlaylist);
	</script>

</div>

<nav class="optionsMenu">
	<input type="hidden" class="songId">
	<?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
</nav>