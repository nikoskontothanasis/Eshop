<?php
session_start();
if(empty($_SESSION["admin"]))
	die("<h4>Incorrect entry</h4>");
unset($_SESSION["admin"]);
echo "<h3>Click <a href=e-shop.php>here</a> to login</h3>";
?>
