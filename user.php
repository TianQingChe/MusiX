<?php
include("includes/includedFiles.php");
if(isset($_GET['id'])) {
	$audienceId = $_GET['id'];
}
else {
	header("Location: audienceindex.php");
}
$audience=new Audience($con,$audienceId);
?>

<script>

$(document).ready(function(){
	var aId=$("#saveUserId").attr("aId");
	$.post("includes/handlers/ajax/isAudienceLoved.php",{audienceId: aId},function(data){
		var q=JSON.parse(data);
		// console.log(q.num);
		// console.log(q.num);
		if(q.num==1){
			loveUserVisual();
		}else{
			unloveUserVisual();
		}
	});
})

function loveUserVisual(){
	$(".controlButton.love.user").show();
	$(".controlButton.unlove.user").hide();
}

function unloveUserVisual(){
	$(".controlButton.unlove.user").show();
	$(".controlButton.love.user").hide();
}

function loveUser(){
	$(".controlButton.love.user").show();
	$(".controlButton.unlove.user").hide();
	//insert into db
	var aId=$("#saveUserId").attr("aId");
	$.post("includes/handlers/ajax/updateAudienceLove.php",{audienceId: aId});
}

function unloveUser(){
	$(".controlButton.unlove.user").show();
	$(".controlButton.love.user").hide();
	//delete from db
	var aId=$("#saveUserId").attr("aId");
	$.post("includes/handlers/ajax/updateAudienceUnLove.php",{audienceId: aId});
}
</script>

<div class="entityInfo borderBottom" id="saveUserId" aId="<?php echo $audienceId; ?>">

	<div class="centerSection">

		<div class="userInfo">

			<h1 class="userName"><?php echo $audience->getUsername(); ?></h1>

			<div class="headerButtons">
				<center><button class="controlButton unlove user" title="Unlove button" onclick="loveUser()">
						<img src="assets/images/icons/unlove.png" alt="Cancel Love">
				</button></center>
				<center><button class="controlButton love user" title="Love button" style="display: none;" onclick="unloveUser()">
					<img src="assets/images/icons/love.png" alt="Love">
				</button></center>
			</div>

		</div>

	</div>

</div>

<div class="playlistsContainer">

	<div class="gridViewContainer">
		<h2>PLAYLISTS</h2>

		<?php
			$username = $audience->getUsername();

			$playlistsQuery = mysqli_query($con, "SELECT * FROM playlists WHERE owner='$username'");

			if(mysqli_num_rows($playlistsQuery) == 0) {
				echo "<span class='noResults'>This user doesn't have any playlists yet.</span>";
			}

			while($row = mysqli_fetch_array($playlistsQuery)) {

				$playlist = new Playlist($con, $row);

				echo "<div class='gridViewItem' role='link' tabindex='0' 
							onclick='openPage(\"otherplaylist.php?id=" . $playlist->getId() . "\")'>

						<div class='playlistImage'>
							<img src='assets/images/icons/playlist.png'>
						</div>
						
						<div class='gridViewInfo'>"
							. $playlist->getName() .
						"</div>

					</div>";



			}
		?>
	</div>
</div>

<nav class="optionsMenu">
	<input type="hidden" class="songId">
	<?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
</nav>
