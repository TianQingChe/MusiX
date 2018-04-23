<?php
include("includes/artistIncludedFiles.php");
if(isset($_GET['id'])) {
	$artistId = $_GET['id'];
}
else {
	header("Location: artistIndex.php");
}
$artist = new Artist($con, $artistId);
include("includes/handlers/create-handler.php");
?>
        <div class="userDetails">

	<div class="container">
		<form id="songForm" action="includes/handlers/create-handler.php" method="POST">
					<h2>Create your song</h2>
					<input type="hidden" name="artistId" id="artistId" value="<?php echo $artistId; ?>">
					<p>
						<!-- <label for="username">Username</label> -->
						<input id="title" name="title" type="text" placeholder="Title of the song" required>
					</p>

					<p>
						<!-- <label for="firstName">First name</label> -->
						<input id="duration" name="duration" type="text" placeholder="Duration, e.g. 3:40" required>
					</p>

					<p>
						<label for="language">Language: </label>
						<select id="language" class="inline" name="language" style="color: gray;">
							<option value=1 selected="selected" style="color: gray;">English</option>
							<option value=2 style="color: gray;">Chinese</option>
							<option value=3 style="color: gray;">Hindi</option>
							<option value=4 style="color: gray;">Germen</option>
							<option value=5 style="color: gray;">French</option>
							<option value=6 style="color: gray;">Spanish</option>
							<option value=7 style="color: gray;">Korean</option>
							<option value=8 style="color: gray;">Japanese</option>
							<option value=9 style="color: gray;">Arabic</option>
							<option value=10 style="color: gray;">Pure Music</option>
						</select>
					</p>

					<p>
						<label for="genre">Genre: </label>
						<select id="genre" class="inline" name="genre" style="color: gray;">
							<optgroup label="Blues" style="color: black;">
							<option value=2 selected="selected" style="color: gray;">Soul blues</option>
							<option value=3 style="color: gray;">Country blues</option>
							<option value=4 style="color: gray;">Punk blues</option>
							<option value=5 style="color: gray;">Swamp blues</option>
							</optgroup>
							<optgroup label="Country" style="color: black;">
							<option value=7 style="color: gray;">Alternative country</option>
							<option value=8 style="color: gray;">Country pop</option>
							<option value=9 style="color: gray;">Classic country</option>
							<option value=10 style="color: gray;">Progressive country</option>
							</optgroup>
							<optgroup label="Hip hop" style="color: black;">
							<option value=11 style="color: gray;">Hip hop</option>
							<option value=12 style="color: gray;">Alternative hip hop</option>
							<option value=13 style="color: gray;">Trap</option>
							<option value=14 style="color: gray;">Jazz rap</option>
							<option value=15 style="color: gray;">Ghetto house</option>
							<option value=16 style="color: gray;">Hardcore hip hop</option>
							<option value=17 style="color: gray;">Nerdcore</option>
							</optgroup>
							<optgroup label="Jazz" style="color: black;">
							<option value=18 style="color: gray;">Jazz</option>
							<option value=19 style="color: gray;">Free jazz</option>
							<option value=20 style="color: gray;">Punk jazz</option>
							<option value=21 style="color: gray;">Acid jazz</option>
							<option value=22 style="color: gray;">Modal jazz</option>
							<option value=23 style="color: gray;">Mainstream jazz</option>
							</optgroup>
							<optgroup label="Pop" style="color: black;">
							<option value=24 style="color: gray;">Pop</option>
							<option value=25 style="color: gray;">Folk pop</option>
							<option value=26 style="color: gray;">Teen pop</option>
							<option value=27 style="color: gray;">Traditional pop music</option>
							<option value=28 style="color: gray;">Pop rap</option>
							<option value=29 style="color: gray;">Christian pop</option>
							<option value=30 style="color: gray;">Country pop</option>
							</optgroup>
							<optgroup label="Rock" style="color: black;">
							<option value=31 style="color: gray;">Rock</option>
							<option value=32 style="color: gray;">Alternative rock</option>
							<option value=33 style="color: gray;">Beat music</option>
							<option value=34 style="color: gray;">Electronic rock</option>
							<option value=35 style="color: gray;">Experimental rock</option>
							<option value=37 style="color: gray;">Heavy metal</option>
							<option value=38 style="color: gray;">Punk rock</option>
						</select>
					</p>

					<!-- <p>
						<button style="color: black;background-color: white;">Upload Cover</button>
					</p> -->
					<p><a href="upload.php" target="_blank">Upload cover of the song</a></p>
					<p>
						<!-- <label for="firstName">First name</label> -->
						<input id="cover" name="cover" type="text" placeholder="Url of cover" required>
					</p>

					<p><a href="upload.php" target="_blank">Upload the song</a></p>
					<p>
						<!-- <label for="firstName">First name</label> -->
						<input id="path" name="path" type="text" placeholder="Url of song" required>
					</p>

					<center><button type="submit" style="color: black;background-color: white;" id="songButton" name="songButton">Release</button></center>
					
		</form>
	</div>
 
