<meta charset="UTF8">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">

<?
ob_start();
@session_start();
include("../../Env/config.php");
$protype_name = $_POST["protype_name"];

		//*** Insert Record ***//;
		$strSQL = "INSERT INTO product_type (protype_name) VALUES ('$protype_name')";
		mysql_query($strSQL,$con);

echo "<meta http-equiv='refresh' content='1;URL=../../page/backend/pages/product.php'>";
mysql_close($con);
?>
