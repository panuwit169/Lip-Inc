<meta charset="UTF8">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">

<?
ob_start();
@session_start();
include("../../Env/config.php");
$id = $_GET['id'];

if($_GET['status'] == "notcheck"){
  $sql = "UPDATE payment SET status = 'checked' WHERE id='$id'";
  mysql_query($sql,$con) or die("UPDATE ลงตาราง product มีข้อผิดพลาดเกิดขึ้น".
  mysql_error());
} else if ($_GET['status'] == "checked") {
  $sql = "UPDATE payment SET status = 'notcheck' WHERE id='$id'";
  mysql_query($sql,$con) or die("UPDATE ลงตาราง product มีข้อผิดพลาดเกิดขึ้น".
  mysql_error());
} else if ($_GET['status'] == "error") {
  $sql = "UPDATE payment SET status = 'notcheck' WHERE id='$id'";
  mysql_query($sql,$con) or die("UPDATE ลงตาราง product มีข้อผิดพลาดเกิดขึ้น".
  mysql_error());
}

echo "<meta http-equiv='refresh' content='1;URL=../../page/backend/pages/order.php'>";
mysql_close($con);
?>
