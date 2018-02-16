<?php
session_start();
if(!isset($_SESSION['product_name'])) $_SESSION['product_name']=Array();
function logout() {
unset($_SESSION['ADMIN']); unset($_SESSION['product_name']); echo "<h3>ΑΝΤΙΟ ΣΑΣ!!!</h3>";
}
function show_logout() {
echo "<hr><a href=logout.php>енодос</a>"; }
?>
