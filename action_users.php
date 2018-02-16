<?php
session_start();

function checkSession() {

	if(empty($_SESSION["admin"]))
	return false;
	return true; 
}
	function makeBack() {
		echo "<a href=login.php>Back</a>"; 
}

function makeInsertForm() {

	echo "<h3 align=center>Insert form</h3>";
	echo "<form method=post action=insert_user.php>";
	echo "<table border=1>";
	echo "<tr><td>Name:</td>";
	echo "<td><input type=text name=name></td></tr>";
	echo "<tr><td>Lastname:</td>";
	echo "<td><input type=text name=lastname></td></tr>"; 
	echo "<tr><td>Username:</td>";
	echo "<td><input type=text name=username></td></tr>";
	echo "<tr><td>Email:</td>";
	echo "<td><input type=text name=email></td></tr>";
	echo "<tr><td>Password:</td>";
	echo "<td><input type=password name=pass1></td></tr>";
	echo "<tr><td>Retype Password:</td>";
	echo "<td><input type=password name=pass2></td></tr>"; 
	echo "<tr><td>Press here</td>";
	echo "<td align=right><input type=submit value=ok></td>"; 
	echo "</table>";
	echo "</form>";
}

function makeDisplayForm() {
	include("mysql.php"); 
	$link=mysql_connect($host,$user,$pass); 
	mysql_select_db($db);
	$sql="select * from users";
	$res=mysql_query($sql); 
	$N=mysql_num_rows($res);
	echo "<h3 align=center>Users in database: $N</h3>"; 
	echo "<table border=1 align=center>";
	echo "<tr><td>Username</td><td>Name</td><td>Lastname</td><td>Email</td><tr>";
	while($row=mysql_fetch_array($res,MYSQL_BOTH)){
		echo "<tr>";
		echo "<td>".$row["username"]."</td>"; 
		echo "<td>".$row["name"]."</td>"; 
		echo "<td>".$row["lastname"]."</td>"; 
		echo "<td>".$row["email"]."</td>";
		echo "</tr>"; 
	}
	echo "</table>";
	mysql_close($link); 
}


function makeDeleteForm() {

include("mysql.php"); 
$link=mysql_connect($host,$user,$pass); 
mysql_select_db($db);
echo "<h4 align=center>Delete user</h3>"; 
$sql="select username from users";
echo "<form method=post action=delete_user.php>"; 
echo "User:<select name=usercode>";
$res=mysql_query($sql); 
while($row=mysql_fetch_array($res,MYSQL_BOTH)){
	echo "<option>".$row["username"]."</option>";
}
echo "</select>";
echo "Press here:<input type=submit value=ok>"; 
echo "</form>";
mysql_close($link);
}

if(!checkSession())
	die("<h4>Incorrect entry</h4>");
if(empty($_POST["userlist"])) 
	die("<h4>Incorrect entry </h4>");
echo "<p align=right>";
echo "<a href=logout.php>logout</a>";
echo "</p>";
$option=$_POST["userlist"];
if($option=="insert") makeInsertForm();
else
if($option=="display") makeDisplayForm(); 
else
makeDeleteForm(); 
makeBack();
?>

