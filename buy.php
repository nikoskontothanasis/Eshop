<?php
session_start();
function checkSession() {
if(empty($_SESSION["admin"])) return false;
return true; }
if(!checkSession())
die("<h4>Incorrect entry</h4>");
if(empty($_POST["productname"])) die("<h4>Incorrect entry</h4>");
echo "<p align=right>";
echo "<a href=logout.php>logout</a>"; echo "</p>";
include("mysql.php");
$link=mysql_connect($host,$user,$pass); 
mysql_select_db($db);
	 $items=$_POST["items"];
$timestamp=time(); $code=$_POST["productcode"]; $usercode=$_POST["usercode"];
$sql="select items from swimwears where code=$code"; $res=mysql_query($sql);
$row=mysql_fetch_array($res);
$nitems=$row["items"];
if($nitems<$items)
die("<h3> Ανεπαρκής Ποσότητα </h3>");
$sql="insert into order(productcode,usercode,items,timestamp) values("; $sql=$sql."$code,$usercode,$items,$timestamp)";
mysql_query($sql);
$sql="update swimwears set items=items-$items where code=$code"; mysql_query($sql);
mysql_close($link); 
?>
