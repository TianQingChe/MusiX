<?php
include("includes/artistIncludedFiles.php");
?>

<div class="entityInfo borderBottom" id="saveUserId" aId="<?php echo $audienceId; ?>">

	<div class="centerSection">

		<div class="userInfo">

			<h1 class="userName">Following Playlists</h1>

		</div>

	</div>

</div>

<script>
	$(document).ready(function(){
		LikePlaylistVisual();
	});

	function LikePlaylistVisual(){
		$(".controlButton.love.likePlaylist").show();
		$(".controlButton.unlove.likePlaylist").hide();
    }

    function UnLikePlaylistVisual(){
    	$(".controlButton.unlove.likePlaylist").show();
		$(".controlButton.love.likePlaylist").hide();
    }

    function likePlaylist(i){
	$(".controlButton.love.likePlaylist."+i).show();
	$(".controlButton.unlove.likePlaylist."+i).hide();
	//insert into db
	var aId=$("#savePlaylistId"+i).attr("aId");
	$.post("includes/handlers/ajax/updatePlaylistLove.php",{playlistId: aId});
	}

	function unLikePlaylist(i){
		$(".controlButton.unlove.likePlaylist."+i).show();
		$(".controlButton.love.likePlaylist."+i).hide();
		//delete from db
		var aId=$("#savePlaylistId"+i).attr("aId");
		$.post("includes/handlers/ajax/updatePlaylistUnLove.php",{playlistId: aId});
	}
</script>

<div class="tracklistContainer">
	<ul class="tracklist">

		<?php 
			$followersId= mysqli_query($con, "SELECT playlistId FROM user_like_playlist where userId=".$userLoggedIn->getId());
			$followers=array();
			while($row = mysqli_fetch_array($followersId)) {
			   $follwerId=$row['playlistId'];
			   $follwer=new Playlist($con,$follwerId);
			   array_push($followers,$follwer);
			}
			$i=0;
			foreach($followers as $follwer){
					echo "<li class='tracklistRow'>
						<div class='trackInfo'>
							<span class='trackName' role='link' tabindex='0' onclick='openPage(\"artistotherplaylist.php?id=" . $follwer->getId() . "\")'>"
						  . $follwer->getName() . "</span>
						</div>
						<div class='trackDuration'>
							<button class='controlButton unlove likePlaylist ".$i."' id='savePlaylistId" .$i. "'aId='".$follwer->getId()."' title='Unlove button' onclick='likePlaylist(".$i.")'>
							<img src='assets/images/icons/unlove.png' alt='Cancel Love'>
							</button>
							<button class='controlButton love likePlaylist ".$i."' title='Love button' style='display: none;' onclick='unLikePlaylist(".$i.")'>
									<img src='assets/images/icons/love.png' alt='Love'>
							</button>
					    </div>
				     	</li>";
				$i+=1;
			}
		?>

	</ul>
</div>