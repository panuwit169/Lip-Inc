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
                    <h1 class="page-header">แก้ไข / เพิ่มข้อมูล Tracking</h1>
                </div>
                <?php
                  $id = $_GET['id'];
                  $sqltxt = "SELECT * FROM orders where order_id = '$id'";
                  $result = mysql_query ($sqltxt,$con);
                  while($rs = mysql_fetch_array($result)){
                ?>
                <form action="../../../process/backend/save_edit_tracking.php" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group required row">
                          <label class="control-label col-md-2">รหัส Tracking</label>
                          <div class="controls col-md-8 ">
                              <input class="form-control" maxlength="30" style="margin-bottom: 10px" name="tracking" type="text" value="<?php echo $rs["TrackingNo"]; ?>" required/>
                          </div>
                      </div>
                      <input type="hidden" name="id" value="<?php echo $id;?>">
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
