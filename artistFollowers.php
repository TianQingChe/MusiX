<?php
include("includes/artistIncludedFiles.php");
?>

<div class="entityInfo borderBottom" id="saveUserId" aId="<?php echo $audienceId; ?>">

	<div class="centerSection">

		<div class="userInfo">

			<h1 class="userName">Followers</h1>

		</div>

	</div>

</div>

<div class="tracklistContainer">
	<ul class="tracklist">

		<?php 
			$followersId= mysqli_query($con, "SELECT userId FROM user_like_user where followingId=".$userLoggedIn->getId());
			$followers=array();
			while($row = mysqli_fetch_array($followersId)) {
			   $follwerId=$row['userId'];
			   $follwer=new Audience($con,$follwerId);
			   array_push($followers,$follwer);
			}
			foreach($followers as $follwer){
				if ($follwer->getUserType()==1){
					echo "<li class='tracklistRow'>
						<div class='trackInfo'>
							<span class='trackName' role='link' tabindex='0' onclick='openPage(\"artistUser.php?id=" . $follwer->getId() . "\")'>"
						  . $follwer->getUsername() . "</span>
						</div>
				     </li>";
				}else{
					echo "<li class='tracklistRow'>
						<div class='trackInfo'>
							<span class='trackName' role='link' tabindex='0' onclick='openPage(\"artistArtist.php?id=" . $follwer->getId() . "\")'>"
						  . $follwer->getUsername() . "</span>
						  <span class='artistName'>artist</span>
						</div>
				     </li>";
				}
			}
		?>

	</ul>
</div>