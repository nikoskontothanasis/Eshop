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
if($_POST["pass1"]!=$_POST["pass2"])
	die("<h4>Incorrect password </h4>"); 
echo "<p align=right>";
echo "<a href=logout.php>logout</a>";
echo "</p>";
include("mysql.php"); 
$link=mysql_connect($host,$user,$pass); 
mysql_select_db($db);
$sql="select * from users where username='".$_POST["username"]."'";
$res=mysql_query($res);
$n=mysql_num_rows($res);
if($n!=0){
	mysql_close($link);
	die("<h4>User ".$_POST["username"]." exists</h4>"); 
}
$sql="insert into users(name,lastname,username,email,password,valid) values("; $sql=$sql."'".$_POST["name"]."','".$_POST["lastname"]."','".$_POST["username"]."','".
$_POST["email"]."','".$_POST["pass1"]."',1)"; $res=mysql_query($sql);
if(!$res) 
	die("<h4>Incorrect user ".$_POST["username"]."</h4>");
else 
	echo "<h4> Correct insertion of user ".$_POST["username"]."</h4>";
mysql_close($link); 
?>

