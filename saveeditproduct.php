<meta charset="UTF8">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">

<?
$hostname = "localhost";
$username = "root";
$password = "1234";
$dbname = "cosmetic";
$conn = mysql_connect( $hostname, $username, $password );
if (!$conn) die ( "ไม่สามารถติดต่อกับ MySQL ได้" );
mysql_select_db ( $dbname, $conn )or die ( "ไม่สามารถเลือกฐานข้อมูล itbook ได้" );
mysql_query("SET character_set_results=tis620");
mysql_query("SET character_set_client=tis620");
mysql_query("SET character_set_connection=tis620");
mysql_query("SET NAMES UTF8");


$sql = "UPDATE product SET product_name = '$product_name',brand_id = '$brand_id',product_detail = '$product_detail',product_price = '$product_price',protype_id = '$protype_id',product_num = '$product_num' WHERE product_id='$id'";


mysql_query($sql,$conn) or die("UPDATE ลงตาราง product มีข้อผิดพลาดเกิดขึ้น".
mysql_error());
echo "<br><br><CENTER><H2>แก้ไขข้อมูลเรียบร้อย</H2><BR><BR></CENTER>";
echo "<CENTER><A HREF=\"showproduct.php\">แสดงข้อมูลทั้งหมด</A></CENTER>";

mysql_close($conn);
?>
