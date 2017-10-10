<?php
	require_once "../mpdf/mpdf.php";
	ob_start();
  session_start();
	include("../Env/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<link rel="stylesheet" href="../css/bulma.css">
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/products.css">
<link rel="stylesheet" href="../css/login.css">
<link rel="stylesheet" href="../css/base.css">
<body>
<?php echo "<p style='position:absolute;right:50px;top:20px'>วันที่".DateThai(date("Y-m-d"))."</p>";?>
<div style="text-align:center">
	<img src="../assets/logo.jpg" width="200px" />
	<h3>รายการสั่งซื้อสินค้า</h3>
</div>

<?php
$strSQL = "SELECT * FROM orders WHERE order_id = '".$_GET["OrderID"]."' ";
$objQuery = mysql_query($strSQL)  or die(mysql_error());
$objResult = mysql_fetch_array($objQuery);

$strSQL5 = "SELECT * FROM province WHERE PROVINCE_ID = '".$objResult['province']."'";
$objQuery5 = mysql_query($strSQL5)  or die(mysql_error());
$objResult5 = mysql_fetch_array($objQuery5);
$province = $objResult5["PROVINCE_NAME"];

$strSQL6 = "SELECT * FROM amphur WHERE AMPHUR_ID = '".$objResult['amphur']."'";
$objQuery6 = mysql_query($strSQL6)  or die(mysql_error());
$objResult6 = mysql_fetch_array($objQuery6);
$amphur = $objResult6["AMPHUR_NAME"];

$strSQL4 = "SELECT * FROM district WHERE DISTRICT_CODE = '".$objResult['district']."'";
$objQuery4 = mysql_query($strSQL4)  or die(mysql_error());
$objResult4 = mysql_fetch_array($objQuery4);
$district = $objResult4["DISTRICT_NAME"];
?>

<table class="table-report" style="width:80%;" style="border-collapse: collapse;" >
  <tbody >
		<tr style="padding: 5px">
			<th colspan="2" style="padding: 5px">รายละเอียดผู้สั่งซื้อ/จัดส่ง</th>
		</tr>
    <tr>
      <td width="30%" style="padding: 5px">รหัสการสั่งซื้อ</td>
      <td width="70%" style="padding: 5px"><?php echo $objResult["order_id"];?></td>
    </tr>
    <tr>
      <td style="padding: 5px">ชื่อลูกค้า</td>
      <td style="padding: 5px"><?php echo $objResult["Name"];?></td>
    </tr>
    <tr>
      <td style="padding: 5px">ที่อยู่</td>
      <td style="padding: 5px"><?php echo $objResult["Address"]." ".$amphur." ".$district." ".$province." ".$objResult["postcode"];?></td>
    </tr>
    <tr>
      <td style="padding: 5px">เบอร์โทร</td>
      <td style="padding: 5px"><?php echo $objResult["Tel"];?></td>
    </tr>
    <tr>
      <td style="padding: 5px">อีเมล</td>
      <td style="padding: 5px"><?php echo $objResult["Email"];?></td>
    </tr>
  </tbody>
</table>
  <br><br>
  <table width="704" border="1" align="center" style="border-collapse: collapse;" >
    <thead>
      <tr>
				<th style="border: 2px solid black;">ลำดับ</th>
        <th style="border: 2px solid black;">รายการสินค้า</th>
        <th style="border: 2px solid black;">ราคา่อหน่วย</th>
        <th style="border: 2px solid black;">จำนวน</th>
        <th style="border: 2px solid black;">ราคารวม</th>
      </tr>
    </thead>
    <tbody>
			  <?php
				$no=0;
			  $Total = 0;
			  $SumTotal = 0;
			  $strSQL2 = "SELECT * FROM orders_detail WHERE order_id = '".$_GET["OrderID"]."' ";
			  $objQuery2 = mysql_query($strSQL2)  or die(mysql_error());
			  while($objResult2 = mysql_fetch_array($objQuery2))
			  {
			      $strSQL3 = "SELECT * FROM product WHERE product_id = '".$objResult2["product_id"]."' ";
			      $objQuery3 = mysql_query($strSQL3)  or die(mysql_error());
			      $objResult3 = mysql_fetch_array($objQuery3);
			      $Total = $objResult2["qty"] * $objResult3["product_price"];
			      $SumTotal = $SumTotal + $Total;
						$no++;
			      ?>
			      <tr>
							<td><?php echo $no;?></td>
			        <td><?php echo $objResult3["product_name"];?></td>
			        <td><?php echo $objResult3["product_price"];?></td>
			        <td><?php echo $objResult2["qty"];?></td>
			        <td><?php echo number_format($Total,2);?></td>
			      </tr>
			   <?php } ?>
			<tr>
				<td colspan="5" align="right"><?php echo "ราคารวมทั้งหมด : ".number_format($SumTotal,2)." บาท ";?></td>
			</tr>
    </tbody>
  </table>
</body>
</html>


<?php
$html = ob_get_contents();
ob_end_clean();
$pdf = new mPDF('th', 'A4', '0', 'THSaraban');
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output();         // เก็บไฟล์ html ที่แปลงแล้วไว้ใน MyPDF/MyPDF.pdf ถ้าต้องการให้แสดง

function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonthCut[$strMonth];
		return " $strDay $strMonthThai $strYear";
	}
?>
