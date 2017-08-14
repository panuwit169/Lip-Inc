<!DOCTYPE html>
<html lang="en">
<?php
  ob_start();
  @session_start();
  include("../../../Env/config.php");
?>

<!-- Header -->
<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  $file_path = $root . '/lip-inc/components/backend/header.php';
  include($file_path);
?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php
          $root = $_SERVER['DOCUMENT_ROOT'];
          $file_path = $root . '/lip-inc/components/backend/navbar.php';
          include($file_path);
        ?>
        <!-- Side Menu -->
        <?php
          $root = $_SERVER['DOCUMENT_ROOT'];
          $file_path = $root . '/lip-inc/components/backend/side-menu.php';
          include($file_path);
        ?>
      </nav>

        <div id="page-wrapper">
            <div class="row" style="margin-bottom:50px">
                <div class="col-lg-12">
                    <h1 class="page-header">ข้อมูลรายละเอียดการสั่งซื้อ</h1>
                </div>
                <?php
                  $id = $_GET['id'];
                  $sqltxt = "SELECT * FROM orders JOIN payment ON orders.order_id = payment.order_id WHERE orders.order_id = $id";
                  $result = mysql_query ($sqltxt,$con);
                  while($rs = mysql_fetch_array($result)){
                    $payment_id = $rs["id"];
                    echo $pament_id;
                    $name = $rs["Name"];
                    $address = $rs["Address"];
                    $tel = $rs["Tel"];
                    $email = $rs["Email"];
                    $price = $rs["amount"];
                    $total = 0;
                  }
                  ?>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="row">
                          <label class="control-label col-md-3">รหัสการสั่งซื้อ</label>
                          <label class="control-label col-md-7"><?php echo $id; ?></label>
                      </div>
                      <div class="row">
                          <label class="control-label col-md-3">รหัสแจ้งการโอนเงิน</label>
                          <label class="control-label col-md-7"><?php echo $payment_id; ?></label>
                      </div>
                      <div class="row">
                          <label class="control-label col-md-3">ชื่อลูกค้า</label>
                          <label class="control-label col-md-7"><?php echo $name; ?></label>
                      </div>
                      <div class="row">
                          <label class="control-label col-md-3">ที่อยู่ลูกค้า</label>
                          <label class="control-label col-md-7"><?php echo $address; ?></label>
                      </div>
                      <div class="row">
                          <label class="control-label col-md-3">เบอร์โทรลูกค้า</label>
                          <label class="control-label col-md-7"><?php echo $tel; ?></label>
                      </div>
                      <div class="row">
                          <label class="control-label col-md-3">อีเมลลูกค้า</label>
                          <label class="control-label col-md-7"><?php echo $email; ?></label>
                      </div>
                      <table class="table">
                        <thead>
                          <tr>
                            <th>รหัสสินค้า</th>
                            <th>ชื่อสินค้า</th>
                            <th>ราคาสินค้าต่อหน่วย</th>
                            <th>จำนวน</th>
                            <th>รูปสินค้า</th>
                          </tr>
                        </thead>
                        <tbody>

                <?php
                  $sqltxt2 = "SELECT * FROM orders JOIN payment ON orders.order_id = payment.order_id JOIN orders_detail ON orders.order_id = orders_detail.order_id JOIN product ON product.product_id = orders_detail.product_id WHERE orders.order_id = $id ORDER BY payment.id ASC";
                  $result2 = mysql_query ($sqltxt2,$con);
                  while($rs2 = mysql_fetch_array($result2)){
                ?>
                      <tr>
                        <td><?php echo $rs2["product_id"] ;?></td>
                        <td><?php echo $rs2["product_name"] ;?></td>
                        <td><?php echo number_format($rs2["product_price"],2) ;?></td>
                        <td><?php echo $rs2["qty"];?></td>
                        <td><?php echo '<img width="80px" src="data:image/jpeg;base64,'.base64_encode( $rs2['product_img'] ).'"/>' ?></td>
                      </tr>
                      <?php $total += $rs2["product_price"];?>
                  <?php } ?>
                    </tbody>
                  </table>
                  <div class="row">
                      <label class="control-label col-md-12" style="text-align:right">ราคารวม <?php echo number_format($total,2); ?> บาท</label>
                  </div>
                  <div class="row">
                      <label class="control-label col-md-12" style="text-align:right">จำนวนเงินที่แจ้ง <?php echo number_format($price,2); ?> บาท</label>
                  </div>
                  <center><a href="order.php" class="btn btn-warning">ย้อนกลับ</a></center>
                  </div>
                </div>
            </div>

        </div>
        <!-- /#page-wrapper -->

    </div>

    <?php
      $root = $_SERVER['DOCUMENT_ROOT'];
      $file_path = $root . '/lip-inc/components/backend/script.php';
      include($file_path);
    ?>

    <script>
    // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })
    //datatble
    $(document).ready(function(){
        $('#product').DataTable();
    });
    </script>

</body>

</html>
