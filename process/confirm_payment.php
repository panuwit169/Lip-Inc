<?php
ob_start();
session_start();
include("../Env/config.php");

$id = $_POST["paymentid"];
$account = $_POST["acc"];
$date = $_POST["datepayment"];
$time = $_POST["timepayment"];
$amount = $_POST["amountpayment"];

 $sql = "INSERT INTO payment (order_id,account,datepayment,timepayment,amount) VALUES
($id,'$account','$date',$time,$amount)";
mysql_query($sql,$con);
echo "<meta http-equiv='refresh' content='1;URL=../page/payment.php?id=success'>";
?>
