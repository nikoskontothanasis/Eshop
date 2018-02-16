<?php
session_start();
function checkSession() {
if(empty($_SESSION["admin"])) return false;
return true; }
if(!checkSession())
die("<h4>Incorrect entry</h4>");
if(empty($_POST["name"])) die("<h4>Incorrect entry</h4>");
echo "<p align=right>";
echo "<a href=logout.php>logout</a>"; echo "</p>";
include("mysql.php");
$link=mysql_connect($host,$user,$pass); 
	mysql_select_db($db);
$sql="select code from users where username='".$_SESSION["admin"]."'";
$res=mysql_query($sql);
$row=mysql_fetch_array($res,MYSQL_BOTH);
$usercode=$row["code"];
$sql="insert into swimwears(name,usercode,price,items,color) values('";
$sql=$sql.$_POST["name"]."',$usercode,".$_POST["price"].",".$_POST["items"].",'". $_POST["color"]."')";
mysql_query($sql);
mysql_close($link); 
?>

