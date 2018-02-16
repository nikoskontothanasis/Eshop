<?php
session_start();

function checkSession() {

	if(empty($_SESSION["admin"])) return false;
		return true; 
	}

function makeInsertForm() {

	echo "<h3 align=center>Insert a swimwear  </h3>";
	echo "<form method=post action=insert_product.php>"; 
	echo "<table align=center border=1>";
	echo "<tr>";
	echo "<td>Name:</td>";
	echo "<td><input type=text name=name></td>"; 
	echo "</tr>";
	echo "<tr>";
	echo "<td>Size:</td>";
	echo "<td><input type=text name=size></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Color:</td>";
	echo "<td><input type=text name=color></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Price:</td>";
	echo "<td><input type=text name=price></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Items:</td>";
	echo "<td><input type=text name=items></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Click here</td>";
	echo "<td align=right><input type=submit value=ok></td>"; 
	echo "</tr>";
	echo "</table>";
	echo "</form>"; 
}

function makeDisplayForm() {

	echo "<h3> Swimwears </h3>"; 
	include("mysql.php");
	$link=mysql_connect($host,$user,$pass); 
	mysql_select_db($db);
	$sql="select code from users where username='".$_SESSION["admin"]."'";
	$res=mysql_query($sql);
	$row=mysql_fetch_array($res,MYSQL_BOTH);
	$usercode=$row["code"];
	$sql="select * from swimwears where usercode=$usercode"; 
	$res=mysql_query($sql);
	echo "<table align=center border=1>";
	echo "<tr>";
	echo "<td>Name</td><td>Size</td><td>Color</td><td>Price</td><td>Items</td>"; 
	echo "</tr>";
	while($row=mysql_fetch_array($res,MYSQL_BOTH)){
		echo "<tr>";
		echo "<td>".$row["name"]."</td>"; 
		echo "<td>".$row["size"]."</td>"; 
		echo "<td>".$row["color"]."</td>";
		echo "<td>".$row["price"]."</td>";
		echo "<td>".$row["items"]."</td>";
		echo "</tr>"; 
	}
	echo "</table>";
	mysql_close($link); 
}


function makeDeleteForm() {

	echo "<h3> Delete Items </h3>";
	include("mysql.php"); 
	$link=mysql_connect($host,$user,$pass); 
	mysql_select_db($database);
	$sql="select code from users where username='".$_SESSION["admin"]."'"; 
	$res=mysql_query($sql);
	$row=mysql_fetch_array($res,MYSQL_BOTH);
	$usercode=$row["code"];
	$sql="select name from swimwears where usercode=$usercode";
	$res=mysql_query($sql);
	echo "<form method=post action=delete_product.php>";
	echo "Name of the product:";
	echo "<select name=name>"; 
	while($row=mysql_fetch_array($res,MYSQL_BOTH)) {
	echo "<option>".$row["name"]."</option>"; }
	echo "</select>";
	echo "<input type=submit value=ok>"; 
	echo "</form>";
	mysql_close($link);
}

function makeBuyForm() {

	echo "<h3> Buy form </h3>"; 
	include("mysql.php");
	$link=mysql_connect($host,$user,$pass); 
	mysql_select_db($db);
	$sql="select code from users where username='".$_SESSION["admin"]."'"; 
	$res=mysql_query($sql);
	$row=mysql_fetch_array($res);
	$thiscode=$row["code"];
	//select products of the other users
	$sql="select * from swimwears where usercode<>$thiscode"; 
	$res=mysql_query($sql);
	echo "<table align=center border=1>";
	echo "<tr>";
	echo "<td>Product name </td><td>Price</td><td>Available items</td><td>Quantity</td>";
	echo "</tr>"; 
	while($row=mysql_fetch_array($res,MYSQL_BOTH)) {
		echo "<tr>";
		echo "<form method=post action=buy.php>";
		echo "<td>".$row["name"]."</td>";
		echo "<td>".$row["price"]."</td>";
		echo "<td>".$row["items"]."</td>";
		echo "<td><input type=text name=items></td>";
		echo "<td><input type=submit value=ok></td>";
		echo "<input type=hidden name=productname value=".$row["name"].">"; 
		echo "<input type=hidden name=productcode value=".$row["code"].">";
		echo "<input type=hidden name=usercode value=".$thiscode.">";
		echo "</form>"; 
		echo "</tr>";
	}
echo "</table>";
mysql_close($link);
}

function makeBack() {

	echo "<a href=login.php>Back</a>"; }
	if(!checkSession()) {
		makeBack();
		die("<h4>Incorrect entry</h4>"); 
		}
	if(empty($_POST["productlist"])) {
		makeBack();
		die("<h4>Incorrect entry </h4>");
		}
	echo "<p align=right>";
	echo "<a href=logout.php>logout</a>"; 
	echo "</p>"; 
	$option=$_POST["productlist"];
	if($option=="insert")
		makeInsertForm();
	else if($option=="display")
		makeDisplayForm(); 
	else if($option=="delete") 
		makeDeleteForm();
	else
		makeBuyForm();
makeBack(); 

?>

