<meta charset="UTF8">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">

<?
  ob_start();
  @session_start();
  include("../../Env/config.php");
  $id = $_POST['id'];
  $tracking = $_POST["tracking"];

  $sql = "UPDATE orders SET TrackingNo = '$tracking' WHERE order_id='$id'";
  mysql_query($sql,$con) or die("UPDATE ลงตาราง orders มีข้อผิดพลาดเกิดขึ้น".
  mysql_error());
  echo "<meta http-equiv='refresh' content='1;URL=../../page/backend/pages/order.php'>";
  mysql_close($con);
?>
