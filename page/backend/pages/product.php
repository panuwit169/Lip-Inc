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
                    <h1 class="page-header">จัดการสินค้า</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            แก้ไขรายการสินค้า
                            <div style="float:right;margin-top: -7px;">
                              <a href="addnew_product.php">
                                <button type="button" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มสินค้าใหม่</button>
                              </a>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table id="product" class="display" cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th>รหัสสินค้า</th>
                                  <th>ชื่อสินค้า</th>
                                  <th>ราคาสินค้า</th>
                                  <th>จำนวนสินค้าคงเหลือ</th>
                                  <th>รูปภาพสินค้า</th>
                                  <th>ตัวเลือก</th>
                                </tr>
                              </thead>
                              <?php
                                $sqltxt = "SELECT * FROM product order by product_id ASC";
                                $result = mysql_query ($sqltxt,$con);
                              ?>
                              <tbody>
                                <?php
                                  while($rs = mysql_fetch_array($result)){
                                ?>
                                <tr>
                                  <td><?php echo $rs["product_id"]; ?></td>
                                  <td><?php echo $rs["product_name"]; ?></td>
                                  <td><?php echo $rs["product_price"] ?></td>
                                  <td><?php echo $rs["product_num"] ?></td>
                                  <?php echo '<td><img width="80px" name="image" src="data:image/jpeg;base64,'.base64_encode( $rs['product_img'] ).'"/></td>'; ?>
                                  <td>
                                    <a style="text-decoration: none;" href="edit_product.php?id=<?php echo $rs["product_id"]; ?>">
                                      <button type="button" class="btn btn-warning">แก้ไข</button>
                                    </a>
                                    <?php
                                      echo "<a href=\"../../../process/backend/deleteproduct.php?id=$rs[0]\" ";
                                      echo "onclick=\"return confirm('ยืนยันการลบข้อมูลสินค้า $rs[1]')\"><button type=\"button\" class=\"btn btn-danger\">ลบ</button></a>";
                                    ?>
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
              <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            จัดการประเภทสินค้า
                            <div style="float:right;margin-top: -7px;">
                              <a href="addnew_protype.php">
                                <button type="button" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มประเภทสินค้าใหม่</button>
                              </a>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <table id="protype" class="display" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>รหัสประเภทสินค้า</th>
                                <th>ชื่อประเภทสินค้า</th>
                                <th>ตัวเลือก</th>
                              </tr>
                            </thead>
                            <?php
                              $sqltxt2 = "SELECT * FROM product_type order by protype_id ASC";
                              $result2 = mysql_query ($sqltxt2,$con);
                            ?>
                            <tbody>
                              <?php
                                while($rs2 = mysql_fetch_array($result2)){
                              ?>
                              <tr>
                                <td><?php echo $rs2["protype_id"]; ?></td>
                                <td><?php echo $rs2["protype_name"]; ?></td>
                                <td>
                                  <?php
                                    echo "<a href=\"../../../process/backend/deleteprotype.php?id=$rs2[0]\" ";
                                    echo "onclick=\"return confirm('ยืนยันการลบข้อมูลสินค้า $rs2[1]')\"><button type=\"button\" class=\"btn btn-danger\">ลบ</button></a>";
                                  ?>
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
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            จัดการแบรนด์สินค้า
                            <div style="float:right;margin-top: -7px;">
                              <a href="addnew_brand.php">
                                <button type="button" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มแบรนด์ใหม่</button>
                              </a>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <table id="brand" class="display" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>รหัสแบรนด์</th>
                                <th>ชื่อแบรนด์</th>
                                <th>ตัวเลือก</th>
                              </tr>
                            </thead>
                            <?php
                              $sqltxt3 = "SELECT * FROM brand order by brand_id ASC";
                              $result3 = mysql_query ($sqltxt3,$con);
                            ?>
                            <tbody>
                              <?php
                                while($rs3 = mysql_fetch_array($result3)){
                              ?>
                              <tr>
                                <td><?php echo $rs3["brand_id"]; ?></td>
                                <td><?php echo $rs3["brand_name"]; ?></td>
                                <td>
                                  <?php
                                    echo "<a href=\"../../../process/backend/deletebrand.php?id=$rs3[0]\" ";
                                    echo "onclick=\"return confirm('ยืนยันการลบข้อมูลสินค้า $rs3[1]')\"><button type=\"button\" class=\"btn btn-danger\">ลบ</button></a>";
                                  ?>
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
                <!-- /.col-lg-6 -->
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
        $('#protype').DataTable();
        $('#brand').DataTable();
    });
    </script>

</body>

</html>
