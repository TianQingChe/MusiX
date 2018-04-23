<?php
include("includes/adminIncludedFiles.php");

if(isset($_GET['term'])) {
	$term = urldecode($_GET['term']);
}
else {
	$term = "";
}
?>

<div class="searchContainer">

	<h4>Search for a user</h4>
	<input type="text" class="searchInput" value="<?php echo $term; ?>" placeholder="Start typing..." onfocus="this.value = this.value">

</div>

<script>

$(".searchInput").focus();

$(function() {
	// var timer;
	$(".searchInput").keyup(function() {
		clearTimeout(timer);
		timer = setTimeout(function() {
			var val = $(".searchInput").val();
			openPage("adminSearch.php?term=" + val);
		}, 2000);
	})


})

</script>

<?php if($term == "") exit(); ?>

<div class="tracklistContainer borderBottom">
	<h2>USERS</h2>
	<?php
		$albumQuery = mysqli_query($con, "SELECT * FROM users WHERE `username` LIKE '$term%' LIMIT 10");

		if(mysqli_num_rows($albumQuery) == 0) {
			echo "<span class='noResults'>No users found matching " . $term . "</span>";
		}

		while($row = mysqli_fetch_array($albumQuery)) {

			echo "<li class='tracklistRow'>
			        <div class='trackInfo'>
					<span class='trackName' role='link' tabindex='0' onclick='openPage(\"adminUser.php?id=" . $row['id'] . "\")'>". $row['username'] ."</span>
					
					</div></li>
					";


		}
	?>

</div>









