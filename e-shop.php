<!DOCTYPE html>
<html>
<head>
	<title>E-Shop</title>
</head>
<body bgcolor=#FFE4C4>
<h2>Welcome!</h2>
<p><b><h4>Sing In OR Sing Up!</h4></b></p>
<?
function login_form()
{
	echo "<hr>";
	echo "<table border=1>";
	echo "<form method=post action=login.php>";
	echo "<tr>";
	echo "<td> Username:</td>";
	echo "<td><input type=text name=login></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td> Password:</td>";
	echo "<td><input type=password name=pass></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td></td>";
	echo "<td align=center><input type=submit value=Ok></td>";
	echo "</tr>";
	echo "</form>";
	echo "</table>";
}
function sing_up(){
	echo "<a href=registerform.html><i><h4>Sing Up</h4></i></a>";
}
login_form();
echo "<hr>";
sing_up();
?>
</body>
</html>