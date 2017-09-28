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
<style>
  #history_wrapper{
    width: 65vw;
  }
</style>
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
              <h1 class="title">
                ข้อมูลรายละเอียดการสั่งซื้อ
              </h1>
              <div class="columns is-multiline">
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
                <div class="row" style="margin-bottom:50px;width: 70vw;">
                    <?php
                      $id = $_GET['id'];
                      $sqltxt = "SELECT * FROM orders WHERE order_id = $id";
                      $result = mysql_query ($sqltxt,$con);
                      while($rs = mysql_fetch_array($result)){
                        $payment_id = $rs["id"];
                        $name = $rs["Name"];
                        $address = $rs["Address"];
                        $tel = $rs["Tel"];
                        $email = $rs["Email"];
                        $price = $rs["amount"];
                        $tracking = $rs["TrackingNo"];
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
                          <div class="row">
                              <label class="control-label col-md-3">เลขไปรษณีย์</label>
                              <label class="control-label col-md-7">
                                <?php
                                  if($tracking == ""){
                                    echo "-";
                                  } else {
                                    echo $tracking;
                                  }
                                ?>
                            </label>
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
                      $sqltxt2 = "SELECT * FROM orders JOIN orders_detail ON orders.order_id = orders_detail.order_id JOIN product ON product.product_id = orders_detail.product_id WHERE orders.order_id = $id ";
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
                      <div class="row" style="text-align:right">
                          <label class="control-label col-md-12">ราคารวม <?php echo number_format($total,2); ?> บาท</label>
                      </div>
                      <center><a href="options.php" class="button is-primary">ย้อนกลับ</a></center>
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
    <script src="../page/backend/vendor/jquery/jquery.min.js"></script>
    <script src="../page/backend/vendor/dataTable/dataTable.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#history').DataTable();
    });
    </script>


  </body>
</html>
