<div id="navBarContainer">
	<nav class="navBar">
		<span role="link" tabindex="0" onclick="openPage('artistIndex.php')" class="logo">
			<img src="assets/images/icons/logo.png">
		</span>

		<div class="group">
			<div class="navItem">
				<span role='link' tabindex='0' onclick='openPage("artistSearch.php")' class="navItemLink">
					Search
					<img src="assets/images/icons/search.png" class="icon" alt="Search">
				</span>
			</div>
		</div>

		<div class="group">

			<div class="navItem">
				<span role="link" tabindex="0" onclick="openPage('artistBrowse.php')" class="navItemLink">Browse</span>
			</div>

			<div class="navItem">
				<span role="link" tabindex="0" onclick="openPage('yourWork.php')" class="navItemLink">Your Works</span>
			</div>

			<div class="navItem">
				<span role="link" tabindex="0" onclick="openPage('artistYourMusic.php')" class="navItemLink">Your Playlists</span>
			</div>

			<div class="navItem">
				<span role="link" tabindex="0" onclick="openPage('artistFollowing.php')" class="navItemLink">Following</span>
			</div>

			<div class="navItem">
				<span role="link" tabindex="0" onclick="openPage('artistFollowers.php')" class="navItemLink">Followers</span>
			</div>

			<div class="navItem">
				<span role="link" tabindex="0" onclick="openPage('artistSettings.php')" class="navItemLink"><?php echo $userLoggedIn->getFirstAndLastName(); ?></span>
			</div>

		</div>
	</nav>
</div>