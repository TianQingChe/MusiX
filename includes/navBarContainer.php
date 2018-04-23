<div id="navBarContainer">
	<nav class="navBar">
		<span role="link" tabindex="0" onclick="openPage('audienceindex.php')" class="logo">
			<img src="assets/images/icons/logo.png">
		</span>

		<div class="group">
			<div class="navItem">
				<span role='link' tabindex='0' onclick='openPage("search.php")' class="navItemLink">
					Search
					<img src="assets/images/icons/search.png" class="icon" alt="Search">
				</span>
			</div>
		</div>

		<div class="group">

			<div class="navItem">
				<span role="link" tabindex="0" onclick="openPage('browse.php')" class="navItemLink">Browse</span>
			</div>

			<div class="navItem">
				<span role="link" tabindex="0" onclick="openPage('yourMusic.php')" class="navItemLink">Your Playlists</span>
			</div>

			<div class="navItem">
				<span role="link" tabindex="0" onclick="openPage('following.php')" class="navItemLink">Following</span>
			</div>

			<div class="navItem">
				<span role="link" tabindex="0" onclick="openPage('followers.php')" class="navItemLink">Followers</span>
			</div>

			<div class="navItem">
				<span role="link" tabindex="0" onclick="openPage('settings.php')" class="navItemLink"><?php echo $userLoggedIn->getFirstAndLastName(); ?></span>
			</div>

		</div>
	</nav>
</div>