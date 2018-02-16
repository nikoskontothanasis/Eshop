<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body bgcolor="#FFDAB9">
<?php


function createTables(){
	include("mysql.php");
	$link=mysql_connect($host,$user,$pass);
	mysql_select_db($db);
	$sql1="create table if not exists users(code int not null auto_increment,name text,lastname text,"."username text,email text,password text,valid int,primary key(code))";
	$res1=mysql_query($sql1);
	if(!$res1) 
		die("<h4> Incorrect  create $sql1 </h4>");
	$sql2="create table if not exists swimwears(code int not null auto_increment,name text,color text,".
	"usercode int,price double,items int,image1 text,image2 text,image3 text,primarykey(code))";
	$res2=mysql_query($sql2);
	if(!$res2) 
		die("<h4> Incorrect create $sql2 </h4>");
	$sql3="create table if not exists eshoporder(ordercode int not null auto_increment,usercode int,productcode int,items int,timestamp int,primary key(ordercode))";
	$res3=mysql_query($sql3);
	if(!$res3) 
		die("<h4> Incorrect create $sql3 </h4>"); mysql_close($link);
	}

	function makeSession($login) {
	if(empty($_SESSION["admin"])) {
		$_SESSION["admin"]=$login;
	}
}

function check($login,$pass) {
if($login=="admin"){
	if($pass!="pass"){
		return false; 
	}
return true;
}
}


include("mysql.php");
$link=mysql_connect($host,$user,$pass);
mysql_select_db($db);
$sql="select * from users where username='$login' and password='$pass' and valid=1";
$res=mysql_query($sql); $n=mysql_num_rows($res);
if($n==0) {
	mysql_close($link);
	return false;
}
mysql_close($link);
return true;

function makeOptions() {

	if($_SESSION["admin"]=="admin")
	{
		echo "<h3 align=center>User options</h3>";
		echo "<form method=post action=action_users.php>"; echo "<table border=1>";
		echo "<tr>";
		echo "<td>User options</td>"; 
		echo "<td><select name=userlist>"; 
		echo "<option>insert</option>"; 
		echo "<option>display</option>"; 
		echo "<option>delete</option>"; 
		echo "</select></td>";
		echo "</tr>"; echo "<tr>";
		echo "<td>Press here</td>";
		echo "<td><input type=submit value=ok></td>"; echo "</tr>";
		echo "</table>"; echo "</form>"; }
else{
	echo "<h3 align=center>Product options</h3>";
	echo "<form method=post action=action_products.php>"; 
	echo "<table border=1>";
	echo "<tr>";
	echo "<td>Product options</td>";
	echo "<td><select name=productlist>"; 
	echo "<option>insert</option>";
	echo "<option>display</option>"; 
	echo "<option>delete</option>";
	echo "<option>buy</option>";
	echo "</select></td>";
	echo "</tr>"; 
	echo "<tr>";
	echo "<td>Press here</td>";
	echo "<td><input type=submit value=ok></td>"; 
	echo "</tr>";
	echo "</table>"; 
	echo "</form>"; 
}
}
if(empty($_SESSION["admin"])){
	if(empty($_POST["login"]) || empty($_POST["pass"]))
		die("<h4> Please complete the form in <a href=index.php>this page</a></h4>"); 
	if(!check($_POST["login"],$_POST["pass"]))
		die("<h4> Incorrect credentials </h4>"); }
echo "<p align=right>";
echo "<a href=logout.php>logout</a>"; 
echo "</p>"; 
makeSession($_POST["login"]); 
createTables();
makeOptions();

?>
</body>
</html>