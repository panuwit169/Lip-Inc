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
  $count=0;
  $strSQL = "SELECT * FROM payment JOIN orders_detail ON payment.order_id = orders_detail.order_id WHERE payment.id = $id";
  $result = mysql_query($strSQL,$con) or die(mysql_error());
  while($row = mysql_fetch_array($result)){
      $data[$count][0] = $row['id'];
      $data[$count][1] = $row['order_id'];
      $data[$count][2] = $row['account'];
      $data[$count][3] = $row['datepayment'];
      $data[$count][4] = $row['amount'];
      $data[$count][5] = $row['timepayment'];
      $data[$count][6] = $row['status'];
      $data[$count][7] = $row['order_detail_id'];
      $data[$count][8] = $row['product_id'];
      $data[$count][9] = $row['qty'];
      $count++;
  }
  for($i=0;$i<=sizeof($data);$i++)
  {
    $strSQL1 = mysql_query("SELECT * FROM product WHERE product_id = '".$data[$i][8]."'");
    while($user = mysql_fetch_array($strSQL1)){
      $pro_num = $user["product_num"] - $data[$i][9];
    }
    $strSQL2 = "UPDATE product SET product_num = '".$pro_num."' WHERE product_id = '".$data[$i][8]."'";
    mysql_query($strSQL2) or die(mysql_error());
  }
} else if ($_GET['status'] == "checked") {
  $sql = "UPDATE payment SET status = 'notcheck' WHERE id='$id'";
  mysql_query($sql,$con) or die("UPDATE ลงตาราง product มีข้อผิดพลาดเกิดขึ้น".
  mysql_error());
  $count=0;
  $strSQL = "SELECT * FROM payment JOIN orders_detail ON payment.order_id = orders_detail.order_id WHERE payment.id = $id";
  $result = mysql_query($strSQL,$con) or die(mysql_error());
  while($row = mysql_fetch_array($result)){
      $data[$count][0] = $row['id'];
      $data[$count][1] = $row['order_id'];
      $data[$count][2] = $row['account'];
      $data[$count][3] = $row['datepayment'];
      $data[$count][4] = $row['amount'];
      $data[$count][5] = $row['timepayment'];
      $data[$count][6] = $row['status'];
      $data[$count][7] = $row['order_detail_id'];
      $data[$count][8] = $row['product_id'];
      $data[$count][9] = $row['qty'];
      $count++;
  }
  for($i=0;$i<=sizeof($data);$i++)
  {
    $strSQL1 = mysql_query("SELECT * FROM product WHERE product_id = '".$data[$i][8]."'");
    while($user = mysql_fetch_array($strSQL1)){
      $pro_num = $user["product_num"] + $data[$i][9];
    }
    $strSQL2 = "UPDATE product SET product_num = '".$pro_num."' WHERE product_id = '".$data[$i][8]."'";
    mysql_query($strSQL2) or die(mysql_error());
  }
} else if ($_GET['status'] == "error") {
  $sql = "UPDATE payment SET status = 'notcheck' WHERE id='$id'";
  mysql_query($sql,$con) or die("UPDATE ลงตาราง product มีข้อผิดพลาดเกิดขึ้น".
  mysql_error());
}

echo "<meta http-equiv='refresh' content='1;URL=../../page/backend/pages/order.php'>";
mysql_close($con);
?>
