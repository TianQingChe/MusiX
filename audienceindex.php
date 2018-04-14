<?php include("includes/header.php"); ?>

<h1 class="pageHeadingBig">Your might also like</h1>

<div class="gridViewContainer">

	<?php
		$songQuery = mysqli_query($con, "SELECT * FROM songs order by rand() limit 7");

		while($row = mysqli_fetch_array($songQuery)) {
			echo "<li class='tracklistRow'> <div class='gridViewItem'>
					<a href='song.php?id=" . $row['id'] ."'>" . 
						  $row['title'] .
					"</a>
				</div> 
				<div class='trackCount' style='float:right'>
						<img class='play' src='assets/images/icons/play-white.png'>
					</div></li>";
		}
	?>

</div>


<?php include("includes/footer.php"); ?>
					
