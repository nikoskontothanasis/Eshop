<?php
session_start();

function checkSession() {

if(empty($_SESSION["admin"])) return false;
	return true; 
}
if(!checkSession())
	die("<h4>Incorrect entry</h4>");
if(empty($_POST["username"])) 
	die("<h4>Incorrect entry</h4>");
echo "<p align=right>";
echo "<a href=logout.php>logout</a>";
echo "</p>";
include("mysql.php");
$username=$_POST["username"]; 
$link=mysql_connect($host,$user,$pass); 
mysql_select_db($db);
$sql="delete from users where username='$username'"; 
mysql_query($sql);
echo "<h4>Succesfully deleted $username</h4>";
mysql_close($link);
?>