<meta charset="UTF8">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">

<?
ob_start();
@session_start();
include("../../Env/config.php");
$brand = $_POST["brand"];
$type = $_POST["type"];
$product_name = $_POST["product_name"];
$detail = $_POST['detail'];
$price = $_POST['price'];
$qty = $_POST['qty'];


if($_FILES["filUpload"]["name"] != ""){
		//*** Read file BINARY ***'
		$fp = fopen($_FILES["filUpload"]["tmp_name"],"r");
		$ReadBinary = fread($fp,filesize($_FILES["filUpload"]["tmp_name"]));
		fclose($fp);
		$FileData = addslashes($ReadBinary);

		//*** Insert Record ***//;
		$strSQL = "INSERT INTO product (product_id,product_name, brand_id, product_detail, product_price, protype_id ,product_num,product_img) VALUES (
			CONCAT(
	            DATE_FORMAT(NOW(), 'PD%d%m%Y'),
	            LPAD(
	                IFNULL(
	                    (SELECT
	                        SUBSTR(product_id, 11)
	                        FROM product AS alias
	                        WHERE SUBSTR(product_id, 1, 10) = DATE_FORMAT(NOW(), 'PD%d%m%Y')
	                        ORDER BY product_id DESC
	                        LIMIT 1
	                    )
	                    + 1,
	                    1
	                ),
	                6,
	                '0'
	            )
	        ),
			'$product_name','$brand','$detail','$price','$type','$qty','$FileData')";
		mysql_query($strSQL,$con);
}
echo "<meta http-equiv='refresh' content='1;URL=../../page/backend/pages/product.php'>";
mysql_close($con);
?>
