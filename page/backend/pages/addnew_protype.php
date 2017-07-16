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
                    <h1 class="page-header">เพิ่มข้อมูลประเภทสินค้าใหม่</h1>
                </div>
                <form action="../../../process/backend/save_new_protype.php" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-lg-12">

                      <div class="form-group required row">
                          <label class="control-label col-md-2">ชื่อประเภทสินค้า</label>
                          <div class="controls col-md-8 ">
                              <input class="form-control" style="margin-bottom: 10px" type="text" name="protype_name" required/>
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
