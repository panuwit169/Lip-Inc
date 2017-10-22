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
                    <h1 class="page-header">แก้ไขข้อมูลสินค้า</h1>
                </div>
                <?php
                  $id = $_GET['id'];
                  $sqltxt = "SELECT * FROM product where product_id='$id' order by product_id ASC";
                  $result = mysql_query ($sqltxt,$con);
                  while($rs = mysql_fetch_array($result)){
                ?>
                <form action="../../../process/backend/save_edit_product.php" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group required row">
                          <label class="control-label col-md-2">รหัสสินค้า</label>
                          <div class="controls col-md-8 ">
                              <input class="form-control" maxlength="30" style="margin-bottom: 10px" name="id" type="text" value="<?php echo $rs["product_id"]; ?>" readonly required/>
                          </div>
                      </div>
                      <div class="form-group required row">
                          <label class="control-label col-md-2">ชื่อสินค้า</label>
                          <div class="controls col-md-8 ">
                              <input class="form-control" style="margin-bottom: 10px" type="text" value="<?php echo $rs["product_name"]; ?>" readonly required/>
                          </div>
                      </div>
                      <div class="form-group required row">
                          <label class="control-label col-md-2">รายละเอียดสินค้า</label>
                          <div class="controls col-md-8 ">
                            <textarea class="form-control" name="detail" style="margin-bottom: 10px" cols="0" rows="7"><?php echo $rs["product_detail"]; ?></textarea>
                          </div>
                      </div>
                      <div class="form-group required row">
                          <label class="control-label col-md-2">ราคาสินค้า</label>
                          <div class="controls col-md-8 ">
                              <input class="form-control" style="margin-bottom: 10px" type="number" name="price" value="<?php echo $rs["product_price"]; ?>" required/>
                          </div>
                      </div>
                      <div class="form-group required row">
                          <label class="control-label col-md-2">รูปสินค้า</label>
                          <div class="controls col-md-8 ">
                            <?php echo '<td><img width="150px" name="image" src="data:image/jpeg;base64,'.base64_encode( $rs['product_img'] ).'"/></td>'; ?>
                            <p>*ถ้าต้องการแก้ไขรูปกรุณาเลือกรูปใหม่</p><input type="file" name="filUpload" accept="image/*">
                          </div>
                      </div>
                      <div class="form-group required row">
                          <label class="control-label col-md-2" style="margin-top:10px">จำนวนสินค้า</label>
                          <div class="controls col-md-8 " style="margin-top:10px">
                              <input class="form-control" style="margin-bottom: 10px" name="qty" type="number" value="<?php echo $rs["product_num"]; ?>" required/>
                          </div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                  <center><button type="submit" class="btn btn-success">บันทึก</button></center>
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
