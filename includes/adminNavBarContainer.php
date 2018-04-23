<div id="navBarContainer">
	<nav class="navBar">
		<span role="link" tabindex="0" onclick="openPage('admin.php')" class="logo">
			<img src="assets/images/icons/logo.png">
		</span>

		<div class="group">
			<div class="navItem">
				<span role='link' tabindex='0' onclick='openPage("adminSearch.php")' class="navItemLink">
					Search
					<img src="assets/images/icons/search.png" class="icon" alt="Search">
				</span>
			</div>
		</div>

		<div class="group">

			<div class="navItem">
				<span role="link" tabindex="0" onclick="openPage('manageUser.php')" class="navItemLink">Manage Users</span>
			</div>

			<div class="navItem">
				<span role="link" tabindex="0" onclick="openPage('manageSong.php')" class="navItemLink">Manage Songs</span>
			</div>

			<div class="navItem">
				<span role="link" tabindex="0" onclick="openPage('manageRelations.php')" class="navItemLink">Manage Relations</span>
			</div>

			<div class="navItem">
				<span role="link" tabindex="0" onclick="openPage('adminSettings.php')" class="navItemLink"><?php echo $userLoggedIn->getFirstAndLastName(); ?></span>
			</div>

		</div>
	</nav>
</div>