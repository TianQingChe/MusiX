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
		findAllUserRelations();
});

function findAllUserRelations(){
		$.post("includes/handlers/ajax/findAllUserRelations.php",function(data){
			var relations=JSON.parse(data);
			renderAllUserPlaylistRelations(relations)
		});
}

function deleteRelation(event){
	var td=$(event.currentTarget);
	var id=td.attr("id");
	$.post("includes/handlers/ajax/deleteRelation.php",{id:id});
	findAllSongs();
}

function renderAllUserPlaylistRelations(relations){
		var tbody=$("tbody");
			tbody.empty();
			var i=0;
			for(var m in relations){
				i+=1;
				var relation=relations[m];
				var tr=$("<tr>");

				var td=$("<td><input id='followerId"+i+"' style='background-color:transparent;color:#aa9b9b;border:0.5px solid gray;' type='text' value='"+relation.userId+"'></td>");
				tr.append(td);

				var td=$("<td><input id='followingId"+i+"' style='background-color:transparent;color:#aa9b9b;border:0.5px solid gray;' type='text' value='"+relation.followingId+"'></td>");
				tr.append(td);

				td=$('<td><button id="modifyRelationBtn" style="background-color: transparent;border: none;cursor: pointer;" hover="cursor: pointer;" name="modifyRelationBtn"><img style="width: 35px;height: 35px;" src="assets/images/icons/modify.png"></button></td>');
				td.attr("id",relation.id);
				td.attr("order",i);

				td.click(modifyRelation);
				tr.append(td);
				
				td=$('<td><button id="deleteRelationBtn" style="background-color: transparent;border: none;cursor: pointer;" hover="cursor: pointer;" name="deleteRelationBtn"><img style="width: 35px;height: 35px;" src="assets/images/icons/delete.png"></button></td>');
				td.attr("id",relation.id);
				td.click(deleteRelation);
				tr.append(td);
				
				tbody.append(tr);
			}
}
function modifyRelation(event){
	var td=$(event.currentTarget);
	var i=td.attr("order");
	var followerId=$("#followerId"+i).val();
	var followingId=$("#followingId"+i).val();
	var id=td.attr("id");
	$.post("includes/handlers/ajax/updateRelation.php",{id:id,followerId:followerId,followingId:followingId});
	findAllUserRelations();
}
function addRelation(){
	var followerId=$("#followerId").val();
	var followingId=$("#followingId").val();
	$.post("includes/handlers/ajax/addRelation.php",{followerId:followerId,followingId:followingId});
	$("#followerId").val("");
	$("#followingId").val("");
	findAllUserRelations();
}

</script>
</head>
<body style="background-color: #181818;">

<div class="container">
<h1 style="padding-top: 20px;padding-left: 300px;">Relations</h1>
<table class="table" style="color: black;">
   <thead>
       <tr>
          <th>FollowerId</th>
          <th>FollowingId</th>
       </tr>
       <tr>
          <th><input name="followerId" id="followerId" style='background-color:transparent;color:white;border:0.5px solid gray;'></th>
          <th><input name="followingId" id="followingId" style='background-color:transparent;color:white;border:0.5px solid gray;'></th>
          <th><button id="addRelationBtn" onclick="addRelation()" style="background-color: transparent;border: none;cursor: pointer;" hover="cursor: pointer;" name="addRelationBtn"><img style="width: 35px;height: 35px;" src="assets/images/icons/admin-plus.png"></button></th>
       </tr>
       
   </thead>
   <tbody>
   </tbody>
</table>
</div>

</body>
</html>