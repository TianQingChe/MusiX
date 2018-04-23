<?php
include("includes/artistIncludedFiles.php");
?>

<div class="entityInfo borderBottom" id="saveUserId" aId="<?php echo $audienceId; ?>">

	<div class="centerSection">

		<div class="userInfo">

			<h1 class="userName">Following Songs</h1>

		</div>

	</div>

</div>

<script>
	$(document).ready(function(){
		LikeSongVisual();
	});

	function LikeSongVisual(){
		$(".controlButton.love.likeSong").show();
		$(".controlButton.unlove.likeSong").hide();
    }

    function UnLikeSongVisual(){
    	$(".controlButton.unlove.likeSong").show();
		$(".controlButton.love.likeSong").hide();
    }

    function likeSong(i){
	$(".controlButton.love.likeSong."+i).show();
	$(".controlButton.unlove.likeSong."+i).hide();
	//insert into db
	var aId=$("#saveSongId"+i).attr("aId");
	$.post("includes/handlers/ajax/updateLove.php",{songId: aId});
	}

	function unLikeSong(i){
		$(".controlButton.unlove.likeSong."+i).show();
		$(".controlButton.love.likeSong."+i).hide();
		//delete from db
		var aId=$("#saveSongId"+i).attr("aId");
		$.post("includes/handlers/ajax/updateUnLove.php",{songId: aId});
	}
</script>

<div class="tracklistContainer">
	<ul class="tracklist">

		<?php 
			$followersId= mysqli_query($con, "SELECT songId FROM user_like_song where userId=".$userLoggedIn->getId());
			$followers=array();
			while($row = mysqli_fetch_array($followersId)) {
			   $follwerId=$row['songId'];
			   $follwer=new Song($con,$follwerId);
			   array_push($followers,$follwer);
			}
			$i=0;
			foreach($followers as $follwer){
				$artist=$follwer->getArtist();
					echo "<li class='tracklistRow'>
						<div class='trackInfo'>
							<span class='trackName' role='link' tabindex='0' onclick='openPage(\"artistSong.php?id=" . $follwer->getId() . "\")'>"
						  . $follwer->getTitle() . "</span>
						</div>
						<div class='trackDuration'>
							<button class='controlButton unlove likeSong ".$i."' id='saveSongId" .$i. "'aId='".$follwer->getId()."' title='Unlove button' onclick='likeSong(".$i.")'>
							<img src='assets/images/icons/unlove.png' alt='Cancel Love'>
							</button>
							<button class='controlButton love likeSong ".$i."' title='Love button' style='display: none;' onclick='unLikeSong(".$i.")'>
									<img src='assets/images/icons/love.png' alt='Love'>
							</button>
					    </div>
				     	</li>";
				$i+=1;
			}
		?>

	</ul>
</div>