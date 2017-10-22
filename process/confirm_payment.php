<?php
ob_start();
session_start();
include("../Env/config.php");

$id = $_POST["paymentid"];
$account = $_POST["acc"];
$date = $_POST["datepayment"];
$time = $_POST["timepayment"];
$amount = $_POST["amountpayment"];

if($_FILES["filUpload"]["name"] != ""){
		//*** Read file BINARY ***'
		$fp = fopen($_FILES["filUpload"]["tmp_name"],"r");
		$ReadBinary = fread($fp,filesize($_FILES["filUpload"]["tmp_name"]));
		fclose($fp);
		$FileData = addslashes($ReadBinary);

		//*** Insert Record ***//;
		$strSQL = "INSERT INTO payment (id,order_id, account, datepayment, timepayment, amount ,status,img) VALUES (
			CONCAT(
	            DATE_FORMAT(NOW(), 'PY%d%m%Y'),
	            LPAD(
	                IFNULL(
	                    (SELECT
	                        SUBSTR(id, 11)
	                        FROM payment AS alias
	                        WHERE SUBSTR(id, 1, 10) = DATE_FORMAT(NOW(), 'PY%d%m%Y')
	                        ORDER BY id DESC
	                        LIMIT 1
	                    )
	                    + 1,
	                    1
	                ),
	                6,
	                '0'
	            )
	        ),
			'$id','$account','$date','$time','$amount','notcheck','$FileData')";
		mysql_query($strSQL,$con);
}
echo "<meta http-equiv='refresh' content='1;URL=../page/payment.php?alert=success'>";
?>
