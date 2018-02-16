<?php
include_once("session.php");
?> <html>
<head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-7">
<title>
Εισαγωγή προιόντων στο καλάθι
</title> 
</head>
<body bgcolor=#E2A9F3> <?php
include_once("log.php"); include_once("show_items.php"); function add_tobasket($x)
{
foreach($_SESSION['product_name'] as $key=>$v) {
$_SESSION['product_name'][$key]=0; }
foreach($x as $key=>$v)
{
	if($v=='on') $_SESSION['product_name'][$key]=
	$x["value_$key"];
}
if($_SESSION['ADMIN']=="")
echo "<h3>Μόνο πιστοποιημένοι χρήστες επιτρέπονται</h3>";
else {
	add_entry($_SESSION['ADMIN'],"Εγγραφή στο καλάθι"); add_tobasket($_POST);
show_items();
show_logout();
}
?>
</body>
</html>
