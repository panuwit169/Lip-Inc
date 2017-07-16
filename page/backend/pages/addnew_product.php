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
                    <h1 class="page-header">เพิ่มข้อมูลสินค้าใหม่</h1>
                </div>
                <form action="../../../process/backend/save_new_product.php" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group required row">
                          <label class="control-label col-md-2">แบรนด์สินค้า</label>
                          <div class="controls col-md-8 ">
                            <select class="form-control" name="brand">
                              <?php
                                $sqltxt = "SELECT * FROM brand";
                                $result = mysql_query ($sqltxt,$con);
                                while($rs = mysql_fetch_array($result)){
                              ?>
                                <option value="<?php echo $rs["brand_id"]; ?>"><?php echo $rs["brand_name"]; ?></option>
                              <?php } ?>
                            </select>

                          </div>
                      </div>

                      <div class="form-group required row">
                          <label class="control-label col-md-2">ประเภทสินค้า</label>
                          <div class="controls col-md-8 ">
                            <select class="form-control" name="type">
                              <?php
                                $sqltxt2 = "SELECT * FROM product_type";
                                $result2 = mysql_query ($sqltxt2,$con);
                                while($rs2 = mysql_fetch_array($result2)){
                              ?>
                                <option value="<?php echo $rs2["protype_id"]; ?>"><?php echo $rs2["protype_name"]; ?></option>
                              <?php } ?>
                            </select>

                          </div>
                      </div>

                      <div class="form-group required row">
                          <label class="control-label col-md-2">ชื่อสินค้า</label>
                          <div class="controls col-md-8 ">
                              <input class="form-control" style="margin-bottom: 10px" type="text" name="product_name" required/>
                          </div>
                      </div>
                      <div class="form-group required row">
                          <label class="control-label col-md-2">รายละเอียดสินค้า</label>
                          <div class="controls col-md-8 ">
                            <textarea class="form-control" name="detail" style="margin-bottom: 10px" cols="0" rows="7"></textarea>
                          </div>
                      </div>
                      <div class="form-group required row">
                          <label class="control-label col-md-2">ราคาสินค้า</label>
                          <div class="controls col-md-8 ">
                              <input class="form-control" style="margin-bottom: 10px" type="number" name="price" required/>
                          </div>
                      </div>
                      <div class="form-group required row">
                          <label class="control-label col-md-2">รูปสินค้า</label>
                          <div class="controls col-md-8 ">
                            <input type="file" name="filUpload" accept="image/*" required>
                          </div>
                      </div>
                      <div class="form-group required row">
                          <label class="control-label col-md-2" style="margin-top:10px">จำนวนสินค้า</label>
                          <div class="controls col-md-8 " style="margin-top:10px">
                              <input class="form-control" style="margin-bottom: 10px" name="qty" type="number" required/>
                          </div>
                      </div>
                    </div>
                  </div>
                  <center><button type="submit" class="btn btn-success">ยืนยัน</button></center>
                </form>
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
