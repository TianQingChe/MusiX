<?php
include("includes/artistIncludedFiles.php");
?>

<div class="entityInfo borderBottom" id="saveUserId" aId="<?php echo $audienceId; ?>">

	<div class="centerSection">

		<div class="userInfo">

			<h1 class="userName">Following Users</h1>

		</div>

	</div>

</div>

<script>
	$(document).ready(function(){
		LikeUserVisual();
	});

	function LikeUserVisual(){
		$(".controlButton.love.likeUser").show();
		$(".controlButton.unlove.likeUser").hide();
    }

    function UnLikeUserVisual(){
    	$(".controlButton.unlove.likeUser").show();
		$(".controlButton.love.likeUser").hide();
    }

    function likeUser(i){
	$(".controlButton.love.likeUser."+i).show();
	$(".controlButton.unlove.likeUser."+i).hide();
	//insert into db
	var aId=$("#saveUserId"+i).attr("aId");
	$.post("includes/handlers/ajax/updateAudienceLove.php",{audienceId: aId});
	}

	function unLikeUser(i){
		$(".controlButton.unlove.likeUser."+i).show();
		$(".controlButton.love.likeUser."+i).hide();
		//delete from db
		var aId=$("#saveUserId"+i).attr("aId");
		$.post("includes/handlers/ajax/updateAudienceUnLove.php",{audienceId: aId});
	}
</script>

<div class="tracklistContainer">
	<ul class="tracklist">

		<?php 
			$followersId= mysqli_query($con, "SELECT followingId FROM user_like_user where userId=".$userLoggedIn->getId());
			$followers=array();
			while($row = mysqli_fetch_array($followersId)) {
			   $follwerId=$row['followingId'];
			   $follwer=new Audience($con,$follwerId);
			   array_push($followers,$follwer);
			}
			$i=0;
			foreach($followers as $follwer){
				if ($follwer->getUserType()==1){
					echo "<li class='tracklistRow'>
						<div class='trackInfo'>
							<span class='trackName' role='link' tabindex='0' onclick='openPage(\"artistUser.php?id=" . $follwer->getId() . "\")'>"
						  . $follwer->getUsername() . "</span>
						</div>
						<div class='trackDuration'>
							<button class='controlButton unlove likeUser ".$i."' id='saveUserId" .$i. "'aId='".$follwer->getId()."' title='Unlove button' onclick='likeUser(".$i.")'>
							<img src='assets/images/icons/unlove.png' alt='Cancel Love'>
							</button>
							<button class='controlButton love likeUser ".$i."' title='Love button' style='display: none;' onclick='unLikeUser(".$i.")'>
									<img src='assets/images/icons/love.png' alt='Love'>
							</button>
					    </div>
				     	</li>";
				}else{
					echo "<li class='tracklistRow'>
						<div class='trackInfo'>
							<span class='trackName' role='link' tabindex='0' onclick='openPage(\"artistArtist.php?id=" . $follwer->getId() . "\")'>"
						  . $follwer->getUsername() . "</span>
						  <span class='artistName'>artist</span>
						</div>
						<div class='trackDuration'>
							<button class='controlButton unlove likeUser ".$i."' id='saveUserId" .$i. "'aId='".$follwer->getId()."' title='Unlove button' onclick='likeUser(".$i.")'>
							<img src='assets/images/icons/unlove.png' alt='Cancel Love'>
							</button>
							<button class='controlButton love likeUser ".$i."' title='Love button' style='display: none;' onclick='unLikeUser(".$i.")'>
									<img src='assets/images/icons/love.png' alt='Love'>
							</button>
					    </div>
				     </li>";
				}
				$i+=1;
			}
		?>

	</ul>
</div>