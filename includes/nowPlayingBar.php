<?php
$songQuery = mysqli_query($con, "SELECT id FROM songs ORDER BY RAND() LIMIT 10");

$resultArray = array();

while($row = mysqli_fetch_array($songQuery)) {
	array_push($resultArray, $row['id']);
}

$jsonArray = json_encode($resultArray);
?>
<script>

$(document).ready(function(){
	var newPlaylist =<?php echo $jsonArray; ?>//nowPlayingBar is underneath the introduction of script.js file, so it can access the currentPlaylist in script.js directlyA
	audioElement=new Audio();
	setTrack(newPlaylist  [0],newPlaylist,false);
	updateVolumeProgressBar(audioElement.audio);

	$("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove",function(e){
		e.preventDefault();
	});

	$(".playbackBar .progressBar").mousedown(function(){
		mouseDown=true;
	});

	$(".playbackBar .progressBar").mousemove(function(e){
		if(mouseDown){
			//set time of song depending on position of mouse
			timeFromOffset(e,this);
		}
	});

	$(".playbackBar .progressBar").mouseup(function(e){
			//set time of song depending on position of mouse
			timeFromOffset(e,this);
	});

	$(".volumeBar .progressBar").mousedown(function() {
		mouseDown = true;
	});

	$(".volumeBar .progressBar").mousemove(function(e) {
		if(mouseDown == true) {

			var percentage = e.offsetX / $(this).width();

			if(percentage >= 0 && percentage <= 1) {
				audioElement.audio.volume = percentage;
			}
		}
	});

	$(".volumeBar .progressBar").mouseup(function(e) {
		var percentage = e.offsetX / $(this).width();

		if(percentage >= 0 && percentage <= 1) {
			audioElement.audio.volume = percentage;
		}
	});

	$(document).mouseup(function(){
		mouseDown=false;
	});
})

function timeFromOffset(mouse,progressBar){
	var percentage=mouse.offsetX/$(progressBar).width()*100;
	var seconds=audioElement.audio.duration*(percentage/100);
	audioElement.setTime(seconds);
}

function prevSong() {
	if(audioElement.audio.currentTime >= 3 || currentIndex == 0) {
		audioElement.setTime(0);
	}
	else {
		currentIndex = currentIndex - 1;
		setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
	}
}

function nextSong(){
	if(repeat){
		audioElement.setTime(0);
		playSong();
		return;
	}
	if(currentIndex==currentPlaylist.length-1){
		currentIndex=0;
	}else{
		currentIndex++;
	}
	var trackToPlay=shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
	setTrack(trackToPlay,currentPlaylist,true);
}

function setRepeat(){
	repeat=!repeat;
	var imageName=repeat ? "repeat-active.png":"repeat.png";
	$(".controlButton.repeat img").attr("src","assets/images/icons/"+imageName);
}

function setShuffle(){
	shuffle = !shuffle;
	var imageName = shuffle ? "shuffle-active.png" : "shuffle.png";
	$(".controlButton.shuffle img").attr("src", "assets/images/icons/" + imageName);

	if(shuffle == true) {
		//Randomize playlist
		shuffleArray(shufflePlaylist);
		currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);
	}
	else {
		//shuffle has been deactivated
		//go back to regular playlist
		currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);
	}
}

function shuffleArray(a) {
    var j, x, i;
    for (i = a.length; i; i--) {
        j = Math.floor(Math.random() * i);
        x = a[i - 1];
        a[i - 1] = a[j];
        a[j] = x;
    }
}

function setTrack(trackId,newPlaylist,play){

	if(newPlaylist != currentPlaylist) {
		currentPlaylist = newPlaylist;
		shufflePlaylist = currentPlaylist.slice();
		shuffleArray(shufflePlaylist);
	}

	if(shuffle == true) {
		currentIndex = shufflePlaylist.indexOf(trackId);
	}
	else {
		currentIndex = currentPlaylist.indexOf(trackId);
	}

	pauseSong();
	
	$.post("includes/handlers/ajax/getSongJson.php",{songId:trackId},function(data){
        $("#thisId").value=trackId;
		var track=JSON.parse(data);
		$(".trackName span").text(track.title);
		$(".trackName span").attr("onclick","openPage('song.php?id="  +  trackId +  "')");

		$.post("includes/handlers/ajax/getArtistJson.php",{artistId:track.artistId},function(data){
			var artist=JSON.parse(data);
			$(".trackInfo .artistName span").text(artist.firstName+" "+artist.lastName);
			$(".trackInfo .artistName span").attr("onclick","openPage('artist.php?id="  +  artist.id +  "')");
		});

		$(".albumlink img").attr("src",track.cover);

		audioElement.setTrack(track);
		isSongLoved(trackId);

		if(play){
			playSong(trackId);
	    }
	});
}

function playSong(trackId){

	if(audioElement.audio.currentTime == 0) {
		$.post("includes/handlers/ajax/updatePlays.php", { songId: audioElement.currentlyPlaying.id });
	}
	$(".controlButton.play").hide();
	$(".controlButton.pause").show();
	// if(isSongLoved(trackId)){
	// 		loveSongVisual();
	// }else{
	// 	    unloveSongVisual();
	// }
	audioElement.play();
}

function pauseSong(){
	$(".controlButton.play").show();
	$(".controlButton.pause").hide();
	audioElement.pause();
}

function isSongLoved(trackId){
	$.post("includes/handlers/ajax/isSongLoved.php",{songId: trackId},function(data){
			var q=JSON.parse(data);
			// console.log(q.num);
			// console.log(q.num);
			if(q.num==1){
				loveSongVisual();
			}else{
				unloveSongVisual();
			}
	});
}

function loveSongVisual(){
	$(".controlButton.love.song").show();
	$(".controlButton.unlove.song").hide();
}

function unloveSongVisual(){
	$(".controlButton.unlove.song").show();
	$(".controlButton.love.song").hide();
}

function loveSong(){
	$(".controlButton.love.song").show();
	$(".controlButton.unlove.song").hide();
	//insert into db
	$.post("includes/handlers/ajax/updateLove.php",{songId: audioElement.currentlyPlaying.id});
}

function unloveSong(){
	$(".controlButton.unlove.song").show();
	$(".controlButton.love.song").hide();
	//delete from db
	$.post("includes/handlers/ajax/updateUnlove.php",{songId: audioElement.currentlyPlaying.id});
}

</script>


<div id="nowPlayingBarContainer">

	<div id="nowPlayingBar">
		<div id="nowPlayingLeft">
			<div class="content">
				<span class="albumLink">
					<img tabindex="0" src="" class="albumArtwork">
				</span>

				<div class="trackInfo">
					<span class="trackName">
						<span role="link" tabindex="0"></span>
					</span>
					<span class="artistName">
						<span role="link" tabindex="0"></span>
					</span>
				</div>
			</div>
		</div>

		<div id="nowPlayingCenter">

			<div class="content playerControls">

				<div class="buttons">
					<button class="controlButton shuffle" title="Shuffle button" onclick="setShuffle()">
						<img src="assets/images/icons/shuffle.png" alt="Shuffle">
					</button>

					<button class="controlButton previous" title="Previous button" onclick="prevSong()">
						<img src="assets/images/icons/previous.png" alt="Previous">
					</button>

					<button class="controlButton play" title="Play button" onclick="playSong()">
						<img src="assets/images/icons/play.png" alt="Play">
					</button>

					<button class="controlButton pause" title="Pause button" style="display: none;" onclick="pauseSong()">
						<img src="assets/images/icons/pause.png" alt="Pause">
					</button>

					<button class="controlButton next" title="Next button" onclick="nextSong()">
						<img src="assets/images/icons/next.png" alt="Next">
					</button>

					<button class="controlButton repeat" title="Repeat button" onclick="setRepeat()">
						<img src="assets/images/icons/repeat.png" alt="Repeat">
					</button>

					<button class="controlButton unlove song" title="Unlove button" onclick="loveSong()">
						<img src="assets/images/icons/unlove.png" alt="Cancel Love">
					</button>

					<button class="controlButton love song" title="Love button" style="display: none;" onclick="unloveSong()">
						<img src="assets/images/icons/love.png" alt="Love">
					</button>

				</div>

				<div class="playbackBar">
					<span class="progressTime current">0.00</span>
					<div class="progressBar">
						<div class="progressBarBg">
							<div class="progress"></div>
						</div>
					</div>
					<span class="progressTime remaining">0.00</span>
				</div>
				
			</div>

		</div>

		<div id="nowPlayingRight">
			<div class="volumeBar">
				<button class="controlButton volume" title="Volume button">
					<img src="assets/images/icons/volume.png" alt="Volume">
				</button>

				<div class="progressBar">
					<div class="progressBarBg">
						<div class="progress"></div>
					</div>
				</div>
			</div>
		</div>

	</div>

</div>