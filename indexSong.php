<?php
include("includes/config.php");
include("includes/classes/User.php");
include("includes/classes/Artist.php");
include("includes/classes/Song.php");
include("includes/classes/Playlist.php");

if(isset($_GET['id'])) {
	$songId = $_GET['id'];
}
else {
	header("Location: index.php");
}

$song = new Song($con, $songId);
$artist = $song->getArtist();
?>
<html>
<head>
	<title>Welcome to MusiX!</title>
	<link rel="stylesheet" type="text/css" href="assets/css/indexNav.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="assets/js/script.js"></script>
	<link rel="icon" href="assets/images/icons/logo.png" type="image/x-icon"/>
</head>
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
	<script>
			var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
			tempPlaylist = JSON.parse(tempSongIds);
			// console.log(tempPlaylist);
	</script>
	<?php include("includes/indexPlayingBar.php"); ?>
</div>
</html>
