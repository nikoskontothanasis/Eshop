<?php
include("session.php");
?> 
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-7">
<title>Είσοδος στο σύστημα</title> 
</head>
<body bgcolor=#FACC2E> 
<?php
include_once("mysql.php"); 
include_once("show_items.php");

function adminpage($siteurl) {

	include("admin_actions.php"); $_SESSION['ADMIN']=1;
	echo "<h3>Κεντρική σελίδα διαχειρίσεως</h3>"; 
	echo "<hr>";
	print_list($action);
}

function userpage($code) {

	$_SESSION['ADMIN']=$code; \
	include("log.php");
	echo "<h3>Καλωσήρθατε στο site μας<br>Προσοχή!!Η εισόδος σας παρακολουθείται για λόγους ασφαλείας</h3>";
	add_entry($code,"ΕΙΣΟΔΟΣ ΣΤΟ ΣΥΣΤΗΜΑ");
	show_items();
	 }

include("mysql.php"); 
$login=$_POST['login'];
$pass=$_POST['pass'];
$link=mysql_connect($host,$user,$password); 
mysql_select_db($db);
$sql="select * from user where login='$login' and password='$pass'"; 
$result=mysql_query($sql);
$n=mysql_num_rows($result); 
if($n==0)
{
	echo "<h3>Δεν υπάρχει τέτοιος χρήστης</h3>"; }
else {
	$row=mysql_fetch_array($result,MYSQL_BOTH); 
	$valid=$row['valid'];
	$code=$row['code'];
if($valid!=1)
	echo "<h3>Δεν έχει εγκριθεί η είσοδος</h3>"; 
else{
	if($login=="admin")
		adminpage($siteurl); else
	userpage($code);
} 
}
show_logout(); 
?>
</body>
</html>
