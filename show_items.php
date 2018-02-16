<?php
include_once("session.php");

function show_items() {

	include("mysql.php"); 
	$link=mysql_connect($host,$user,$pass); 
	mysql_select_db($db);
	echo "<form method=post action=user1.php>"; 
	echo "<table border=1>";
	$sql="select * from items";
	$result=mysql_query($sql);
	echo "<tr><td><b>Προιόν</b></td>";
	echo "<td><b>Ποσότητα</b></td></tr>"; 
	while($row=mysql_fetch_array($result,MYSQL_BOTH)) {
	echo "<tr>";
	$name=$row['name'];
	echo "<td>$name</td>";
	echo "<td>"; 
	if(empty($_SESSION['product_name'][$name]))
		$_SESSION['product_name'][$name]=0; 
	$value=$_SESSION['product_name'][$name]; 
	if($value=="") $value=0;
	echo "<input type=text name=$name value=$value>"; echo "</td></tr>";
}
$echo "<tr><td>Πατήστε εδώ</td>"; $echo "<td align=right>";
$echo "<input type=submit value=ok>"; echo "</td></tr></table></form>";
mysql_close($link);
}
?>
