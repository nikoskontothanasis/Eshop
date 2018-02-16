<?php
include("session.php");
?> <html>
<head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-7">
<title>
Επιλογή τεμαχίων
</title> </head>
<body bgcolor=#E2A9F3> <?php
include_once("log.php"); include_once("show_items.php"); function show_order_form($x)
{
echo "<h3>Επιβεβαίωση εισαγωγής στο καλάθι</h3>"; echo "<form method=POST action=user2.php>";
echo "<table border=1>";
echo "<td><b>Προιόν</b></td><td><b>Ποσότητα</b>"; echo "</td><td><b>Επιβεβαίωση</b></td>";
echo "</tr>";
foreach($x as $key=>$v) {
echo "<tr><td>$key</td>";
echo "<td>$v</td><td align=right>";
echo "<input type=checkbox name=$key>";
echo "<input type=hidden name=value_$key value=$v>";
echo "</td></tr>"; }
echo "<tr><td></td><td>Πατήστε εδώ</td>";
echo "<td align=right><input type=submit value=ok></td>"; echo "</tr></table></form>";
} if($_SESSION['ADMIN']=="")
echo "<h3>Μόνο πιστοποιημένοι χρήστες επιτρέπονται εδώ</h3>"; else
{
show_order_form($_POST);
add_entry($_SESSION['ADMIN'],"Παραγγελία");
show_logout(); }
?>
</body> </html>