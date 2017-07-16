<?php ob_start(); ?>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta charset="utf-8">
<?
include("../../Env/config.php");
$sql = "DELETE FROM useraccount WHERE id= '$id' ";
mysql_query($sql) or die ( "DELETE จาตาราง cosmetic มีข้อผิดพลาดเกิดขึ้น".mysql_error());
mysql_close ( $con );
header("Location:../../page/backend/pages/user.php");
?>
