<!DOCTYPE html>
<?php
  ob_start();
  @session_start();
  include("../Env/config.php");
?>
<html>
<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  $file_path = $root . '/lip-inc/components/header.php';
  include($file_path);
?>
  <body>
    <?php
      $root = $_SERVER['DOCUMENT_ROOT'];
      $file_path = $root . '/lip-inc/components/navbar.php';
      include($file_path);
    ?>

    <div class="page">
      <div class="container">
        <div class="columns">
          <div class="column is-3">
            <?php
              $root = $_SERVER['DOCUMENT_ROOT'];
              $file_path = $root . '/lip-inc/components/side-menu.php';
              include($file_path);
            ?>
          </div>
          <div class="column is-9">
            <div class="container">
              <div class="column is-9 notification is-warning">
                <p style="text-align:center">!! โปรดจำหมายเลขสั่งซื้อสินค้าไว้ สำหรับการแจ้งการชำระเงิน !! </p>
              </div>
              <h1 class="title" style="margin-top:30px">
                รายการสั่งซื้อสินค้า
              </h1>
              <?php
              $strSQL = "SELECT * FROM orders WHERE order_id = '".$_GET["OrderID"]."' ";
              $objQuery = mysql_query($strSQL)  or die(mysql_error());
              $objResult = mysql_fetch_array($objQuery);

              $strSQL2 = "SELECT * FROM province WHERE PROVINCE_ID = '".$objResult['province']."'";
              $objQuery2 = mysql_query($strSQL2)  or die(mysql_error());
              $objResult2 = mysql_fetch_array($objQuery2);
              $province = $objResult2["PROVINCE_NAME"];

              $strSQL3 = "SELECT * FROM amphur WHERE AMPHUR_ID = '".$objResult['amphur']."'";
              $objQuery3 = mysql_query($strSQL3)  or die(mysql_error());
              $objResult3 = mysql_fetch_array($objQuery3);
              $amphur = $objResult3["AMPHUR_NAME"];

              $strSQL4 = "SELECT * FROM district WHERE DISTRICT_CODE = '".$objResult['district']."'";
              $objQuery4 = mysql_query($strSQL4)  or die(mysql_error());
              $objResult4 = mysql_fetch_array($objQuery4);
              $district = $objResult4["DISTRICT_NAME"];
              ?>

              <table class="table" style="width:70%">
                <tbody>
                  <tr>
                    <td>หมายเลขสั่งซื้อสินค้า</td>
                    <td><?php echo $objResult["order_id"];?></td>
                  </tr>
                  <tr>
                    <td>ชื่อสำหรับจัดส่ง</td>
                    <td><?php echo $objResult["Name"];?></td>
                  </tr>
                  <tr>
                    <td>ที่อยู่สำหรับจัดส่ง</td>
                    <td><?php echo $objResult["Address"]." ".$amphur." ".$district." ".$province." ".$objResult["postcode"];?></td>
                  </tr>
                  <tr>
                    <td>เบอร์โทร</td>
                    <td><?php echo $objResult["Tel"];?></td>
                  </tr>
                  <tr>
                    <td>อีเมล</td>
                    <td><?php echo $objResult["Email"];?></td>
                  </tr>
                </tbody>
              </table>

              <h2 class="subtitle">
                รายการสินค้า
              </h2>

              <table class="table" style="width:70%">
                <thead>
                  <tr>
                    <th>ชื่อสินค้า</th>
                    <th>ราคาสินค้า</th>
                    <th>จำนวน</th>
                    <th>ราคารวม</th>
                  </tr>
                </thead>
                <tbody>
              <?php

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
              	  ?>
              	  <tr>
                		<td><?php echo $objResult3["product_name"];?></td>
                		<td><?php echo $objResult3["product_price"];?></td>
                		<td><?php echo $objResult2["qty"];?></td>
                		<td><?php echo number_format($Total,2);?></td>
              	  </tr>
              	  <?
               }
                ?>
                </tbody>
              </table>
              <div class="columns">
                <div class="column">
                  <div style="width:70%">
                    <div class="is-pulled-right">
                      ราคารวมทั้งหมด : <?php echo number_format($SumTotal,2);?>
                    </div>
                  </div>
                </div>
              </div>

              <?php
              mysql_close();
              ?>
              <div class="columns">
                <div class="column">
                  <div style="width:70%">
                    <div class="has-text-centered">
                      <a href="print.php?OrderID=<?php echo $_GET["OrderID"];?>" target="_blank" class="button is-info is-outlined"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;พิมพ์รายงาน</a>
                      <a href="payment.php?id=<?php echo $objResult["order_id"]; ?>" class="button is-primary is-outlined"><i class="fa fa-money" aria-hidden="true"></i>&nbsp;&nbsp;แจ้งการชำระเงิน</a>
                      <a href="index.php" class="button is-success is-outlined"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp;หน้าแรก</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php
      $root = $_SERVER['DOCUMENT_ROOT'];
      $file_path = $root . '/lip-inc/components/footer.php';
      include($file_path);
    ?>


    </body>
    </html>
