<?php
include("includes/adminIncludedFiles.php");
?>

<html>

<head>
<meta charset="UTF-8">
<title></title>
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/> -->
<script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
		findAllSongs();
});
function findAllSongs(){
		$.post("includes/handlers/ajax/findAllSongs.php",function(data){
			var songs=JSON.parse(data);
			renderSongs(songs)
		});
}
function deleteSong(event){
	var td=$(event.currentTarget);
	var songId=td.attr("id");
	$.post("includes/handlers/ajax/deleteSong.php",{songId:songId});
	findAllSongs();
}

function renderSongs(songs){
			var tbody=$("tbody");
			tbody.empty();
			var i=0;
			for(var m in songs){
				i+=1;
				var song=songs[m];
				var tr=$("<tr>");

				var td=$("<td><input id='title"+i+"' style='background-color:transparent;color:#aa9b9b;border:0.5px solid gray;' type='text' value='"+song.title+"'></td>");
				tr.append(td);

				td=$("<td><input id='artistId"+i+"' style='background-color:transparent;color:#aa9b9b;border:0.5px solid gray;'  type='text' style='color:black;' value='"+song.artistId+"'></td>");
				tr.append(td);

				td=$("<td><input id='coverPath"+i+"' style='background-color:transparent;color:#aa9b9b;border:0.5px solid gray;'  type='text' style='color:black;' value='"+song.cover+"'></td>");
				tr.append(td);

				td=$("<td><input id='duration"+i+"' style='background-color:transparent;color:#aa9b9b;border:0.5px solid gray;'  type='text' style='color:black;' value='"+song.duration+"'></td>");
				tr.append(td);

				td=$("<td><input id='musicPath"+i+"' style='background-color:transparent;color:#aa9b9b;border:0.5px solid gray;'  type='text' style='color:black;' value='"+song.path+"'></td>");
				tr.append(td);
				
				td=$('<td><button id="deleteSongBtn" style="background-color: transparent;border: none;cursor: pointer;" hover="cursor: pointer;" name="deleteUserBtn"><img style="width: 35px;height: 35px;" src="assets/images/icons/delete.png"></button></td>');
				td.attr("id",song.id);
				td.click(deleteSong);
				tr.append(td);
				
				tbody.append(tr);
			}
}
function addSong(){
	var title=$("#title").val();
	var artistId=$("#artistId").val();
	var coverPath=$("#coverPath").val();
	var duarion=$("#duarion").val();
	var musicPath=$("#musicPath").val();
	$.post("includes/handlers/ajax/addSong.php",{title:title,artistId:artistId,cover:coverPath,duarion:duarion,path:musicPath});
	$("#title").val("");
	$("#artistId").val("");
	$("#coverPath").val("");
	$("#duarion").val("");
	$("#musicPath").val("");
	findAllSongs();
}

</script>
</head>
<body style="background-color: #181818;">

<div class="container">
<h1 style="padding-top: 20px;padding-left: 300px;">Songs</h1>
<table class="table" style="color: black;">
   <thead>
       <tr>
          <th>Title</th>
          <th>ArtistId</th>
          <th>Cover path</th>
          <th>Duration</th>
          <th>Music path</th>
       </tr>
       <tr>
          <th><input name="title" id="title" style='background-color:transparent;color:white;border:0.5px solid gray;'></th>
          <th><input name="artistId" id="artistId" style='background-color:transparent;color:white;border:0.5px solid gray;'></th>
          <th><input name="coverPath" id="coverPath" style='background-color:transparent;color:white;border:0.5px solid gray;'></th>
          <th><input name="duarion" id="duration" style='background-color:transparent;color:white;border:0.5px solid gray;'></th>
          <th><input name="musicPath" id="musicPath" style='background-color:transparent;color:white;border:0.5px solid gray;'></th>
          <th><button id="addSongBtn" onclick="addSong()" style="background-color: transparent;border: none;cursor: pointer;" hover="cursor: pointer;" name="addSongBtn"><img style="width: 35px;height: 35px;" src="assets/images/icons/admin-plus.png"></button></th>
       </tr>
       
   </thead>
   <tbody>
   </tbody>
</table>
</div>

</body>
</html>