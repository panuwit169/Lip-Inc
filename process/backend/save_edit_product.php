<meta charset="UTF8">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">

<?
ob_start();
@session_start();
include("../../Env/config.php");
$detail = $_POST['detail'];
$price = $_POST['price'];
$qty = $_POST['qty'];
$id = $_POST['id'];

if($_FILES["filUpload"]["name"] != "")
	{
		//*** Read file BINARY ***'
		$fp = fopen($_FILES["filUpload"]["tmp_name"],"r");
		$ReadBinary = fread($fp,filesize($_FILES["filUpload"]["tmp_name"]));
		fclose($fp);
		$FileData = addslashes($ReadBinary);

		//*** Insert Record ***//;
		$strSQL = "UPDATE product SET product_img = '".$FileData."' WHERE product_id='$id'";
		mysql_query($strSQL,$con);
	}

$sql = "UPDATE product SET product_detail = '$detail', product_price = '$price' , product_num = '$qty' WHERE product_id='$id'";
mysql_query($sql,$con) or die("UPDATE ลงตาราง product มีข้อผิดพลาดเกิดขึ้น".
mysql_error());
echo "<meta http-equiv='refresh' content='1;URL=../../page/backend/pages/product.php'>";
mysql_close($con);
?>
