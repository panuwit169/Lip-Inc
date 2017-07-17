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
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">รายการสั่งซื้อ</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                        รายการสั่งซื้อล่าสุด
                      </div>
                      <!-- /.panel-heading -->
                      <div class="panel-body">
                          <table id="paymentorder" class="display" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>รหัสการสั่งซื้อ</th>
                                <th>รหัสแจ้งโอนเงิน</th>
                                <th>ชื่อผู้สั่งซื้อ</th>
                                <th>จำนวนเงินที่โอน</th>
                                <th>วันที่โอน</th>
                                <th>เวลาที่โอน</th>
                                <th>บัญชี</th>
                                <th>สถานะ</th>
                                <th>ตัวเลือก</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                $sqltxt = "SELECT * FROM orders JOIN payment ON orders.order_id = payment.order_id ORDER BY payment.id ASC";
                                $result = mysql_query($sqltxt,$con);
                                while($rs = mysql_fetch_array($result)){
                              ?>
                              <tr>
                                <td><?php echo $rs["order_id"]; ?></td>
                                <td><?php echo $rs["id"]; ?></td>
                                <td><?php echo $rs["Name"]; ?></td>
                                <td><?php echo $rs["amount"]; ?></td>
                                <td><?php echo $rs["datepayment"]; ?></td>
                                <td><?php echo $rs["timepayment"]; ?></td>
                                <td><?php echo $rs["account"]; ?></td>
                                <td>
                                  <?php
                                  if($rs["status"] == "notcheck"){
                                    echo "<span class='label label-warning'>ยังไม่สำเร็จ</span>";
                                  } else if ($rs["status"] == "checked"){
                                    echo "<span class='label label-success'>สำเร็จ</span>";
                                  } else if ($rs["status"] == "error"){
                                    echo "<span class='label label-danger'>ล้มเหลว</span>";
                                  }
                                  ?>
                                </td>
                                <td>
                                  <a style="text-decoration: none;" href="paymentorderdata.php?id=<?php echo $rs["order_id"]; ?>">
                                    <button type="button" class="btn btn-info">ดูรายละเอียด</button>
                                  </a>
                                  <a style="text-decoration: none;" href="../../../process/backend/changestatus.php?id=<?php echo $rs["id"]; ?>&status=<?php echo $rs["status"]; ?>" onclick="return confirm('ยืนยันการเปลี่ยนสถานะ <?php echo $rs["id"];?>')">
                                    <?php if($rs["status"] == "notcheck"){?>
                                      <button type="button" class="btn btn-warning">เปลี่ยนสถานะ</button>
                                    <?php } else if ($rs["status"] == "checked"){?>
                                      <button type="button" class="btn btn-warning">เปลี่ยนสถานะ</button>
                                    <?php } else if ($rs["status"] == "error"){ ?>
                                      <button type="button" class="btn btn-warning">ยกเลิกสถานะล้มเหลว</button>
                                    <?php } ?>
                                  </a>
                                  <?php if($rs["status"] == "notcheck" ){?>
                                    <a style="text-decoration: none;" href="../../../process/backend/changestatuserror.php?id=<?php echo $rs["id"]; ?>" onclick="return confirm('ยืนยันการเปลี่ยนสถานะเป็นล้มเหลว <?php echo $rs["id"];?>')">
                                      <button type="button" class="btn btn-danger">ล้มเหลว</button>
                                    </a>
                                  <?php } ?>
                                </td>
                              </tr>
                              <?php
                                }
                              ?>
                            </tbody>

                          </table>
                      </div>
                      <!-- .panel-body -->
                  </div>
                  <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
          </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php
      $root = $_SERVER['DOCUMENT_ROOT'];
      $file_path = $root . '/lip-inc/components/backend/script.php';
      include($file_path);
    ?>

    <script type="text/javascript">
    $(document).ready(function(){
        $('#paymentorder').DataTable();
    });
    </script>

</body>

</html>
