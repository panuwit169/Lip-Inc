<meta charset="UTF8">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">

<?
ob_start();
@session_start();
include("../../Env/config.php");
$brand_name = $_POST["brand_name"];

		//*** Insert Record ***//;
		$strSQL = "INSERT INTO brand (brand_name) VALUES ('$brand_name')";
		mysql_query($strSQL,$con);

echo "<meta http-equiv='refresh' content='1;URL=../../page/backend/pages/product.php'>";
mysql_close($con);
?>
