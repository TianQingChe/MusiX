<?php
include("includes/artistIncludedFiles.php");
?>

<div class="entityInfo borderBottom" id="saveUserId" aId="<?php echo $audienceId; ?>">

	<div class="centerSection">

		<div class="userInfo">

			<h1 class="userName">Following</h1>

		</div>

	</div>

</div>

<div class="playlistsContainer">

	<div class="gridViewContainer">


				<div class='followViewItem' role='link' tabindex='0' onclick="openPage('artistFollowingUser.php')">

						<div class='followingImage'>
							<img src='assets/images/user.png'>
						</div>

				</div>

				<div class='followViewItem' role='link' tabindex='0' onclick="openPage('artistFollowingSong.php')">

						<div class='followingImage'>
							<img src='assets/images/song.png'>
						</div>

				</div>

				<div class='followViewItem' role='link' tabindex='0' onclick="openPage('artistFollowingPlaylist.php')">

						<div class='followingImage'>
							<img src='assets/images/playlist.jpg'>
						</div>

				</div>

	</div>
</div>