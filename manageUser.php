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
		findAllUsers();
});
function findAllUsers(){
		$.post("includes/handlers/ajax/findAllUsers.php",function(data){
			var users=JSON.parse(data);
			renderUsers(users)
		});
}
function deleteUser(event){
	var td=$(event.currentTarget);
	var userId=td.attr("id");
	$.post("includes/handlers/ajax/deleteUser.php",{userId:userId});
	// findAllUsers();
}
function modifyUser(event){
	var td=$(event.currentTarget);
	var userId=td.attr("id");
	var i=td.attr("order");
	var username=$("#username"+i).val();
	var firstName=$("#firstName"+i).val();
	var lastName=$("#lastName"+i).val();
	var email=$("#email"+i).val();
	var email2=$("#email"+i).val();
	var password=$("#password"+i).val();
	var password2=$("#password"+i).val();
	var userType=$("#userType"+i+" option:selected").val();
	console.log(userId);
	console.log(userType);
	$.post("includes/handlers/ajax/updateUser.php",{userId:userId,username:username,firstName:firstName,lastName:lastName,email:email,email2:email2,password:password,password2:password2,userType:userType});
	// findAllUsers();
}
function renderUsers(users){
			var tbody=$("tbody");
			tbody.empty();
			var i=0;
			for(var m in users){
				i+=1;
				var user=users[m];
				var tr=$("<tr>");

				var td=$("<td><input id='userId"+i+"' readonly='readonly'  style='background-color:transparent;color:#aa9b9b;border:0.5px solid gray;' type='text' value='"+user.id+"'></td>");
				tr.append(td);

				var td=$("<td><input id='username"+i+"' style='background-color:transparent;color:#aa9b9b;border:0.5px solid gray;' type='text' value='"+user.username+"'></td>");
				tr.append(td);

				td=$("<td><input id='password"+i+"' style='background-color:transparent;color:#aa9b9b;border:0.5px solid gray;'  type='text' style='color:black;' value='"+user.password+"'></td>");
				tr.append(td);
				
				if(user.userType==1){
					td=$("<td><select id='userType"+i+"' class='inline' name='userType' style='background-color:transparent;color:#aa9b9b;border:0.5px solid gray;'><option value=1 selected='selected'>Audience</option><option value=2 >Artist</option></select></td>");
					tr.append(td);
				}else{
					td=$("<td><select id='userType"+i+"' class='inline' name='userType' style='background-color:transparent;color:#aa9b9b;border:0.5px solid gray;'><option value=1 >Audience</option><option value=2 selected='selected' style='color: black;'>Artist</option></select></td>");
					tr.append(td);
				}
				
				td=$("<td><input id='firstName"+i+"' style='background-color:transparent;color:#aa9b9b;border:0.5px solid gray;'  type='text' style='color:black;' value='"+user.firstName+"'></td>");
				tr.append(td);

				td=$("<td><input id='lastName"+i+"' style='background-color:transparent;color:#aa9b9b;border:0.5px solid gray;'  type='text' style='color:black;' value='"+user.lastName+"'></td>");
				tr.append(td);

				td=$("<td><input id='email"+i+"' style='background-color:transparent;color:#aa9b9b;border:0.5px solid gray;'  type='text' style='color:black;' value='"+user.email+"'></td>");
				tr.append(td);

				td=$('<td><button id="modifyUserBtn" style="background-color: transparent;border: none;cursor: pointer;" hover="cursor: pointer;" name="modifyUserBtn"><img style="width: 35px;height: 35px;" src="assets/images/icons/modify.png"></button></td>');
				td.attr("id",user.id);
				td.attr("order",i);
				td.click(modifyUser);
				tr.append(td);
				
				td=$('<td><button id="deleteUserBtn" style="background-color: transparent;border: none;cursor: pointer;" hover="cursor: pointer;" name="deleteUserBtn"><img style="width: 35px;height: 35px;" src="assets/images/icons/delete.png"></button></td>');
				td.attr("id",user.id);
				td.click(deleteUser);
				tr.append(td);
				
				tbody.append(tr);
			}
}
function addUser(){
	var username=$("#username").val();
	var firstName=$("#firstName").val();
	var lastName=$("#lastName").val();
	var email=$("#email").val();
	var email2=$("#email").val();
	var password=$("#password").val();
	var password2=$("#password").val();
	var userType=$("#userType").val();
	console.log(userType);
	console.log(username);
	$.post("includes/handlers/ajax/addUser.php",{username:username,firstName:firstName,lastName:lastName,email:email,email2:email2,password:password,password2:password2,userType:userType});
	$("#username").val("");
	$("#firstName").val("");
	$("#lastName").val("");
	$("#email").val("");
	$("#password").val("");
	findAllUsers();
}

</script>
</head>
<body style="background-color: #181818;">

<div class="container">
<h1 style="padding-top: 20px;padding-left: 300px;">Users</h1>
<table class="table" style="color: black;">
   <thead>
       <tr>
       	  <th>UserId</th>
          <th>Username</th>
          <th>Password</th>
          <th>User Type</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
       </tr>
       <tr>
       	  <th><input readonly="readonly" style='background-color:transparent;color:white;border:0.5px solid gray;'></th>
          <th><input name="username" id="username" style='background-color:transparent;color:white;border:0.5px solid gray;'></th>
          <th><input name="password" id="password" style='background-color:transparent;color:white;border:0.5px solid gray;'></th>
          <th><select id="userType" class="inline" name="userType" style="background-color: transparent;color: white;border:0.5px solid gray;">
							<option value=1 selected="selected" style="color: black;">Audience</option>
							<option value=2 style="color: black;">Artist</option>
						</select></th>
          <th><input name="firstName" id="firstName" style='background-color:transparent;color:white;border:0.5px solid gray;'></th>
          <th><input name="lastName" id="lastName" style='background-color:transparent;color:white;border:0.5px solid gray;'></th>
          <th><input name="email" id="email" style='background-color:transparent;color:white;border:0.5px solid gray;'></th>
          <th><button id="addUserBtn" onclick="addUser()" style="background-color: transparent;border: none;cursor: pointer;" hover="cursor: pointer;" name="addUserBtn"><img style="width: 35px;height: 35px;" src="assets/images/icons/admin-plus.png"></button></th>
       </tr>
       
   </thead>
   <tbody>
   </tbody>
</table>
</div>

</body>
</html>