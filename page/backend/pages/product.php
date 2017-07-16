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
                                  mysql_close($con);
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
                            Dismissable Alerts
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. <a href="#" class="alert-link">Alert Link</a>.
                            </div>
                            <div class="alert alert-info alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. <a href="#" class="alert-link">Alert Link</a>.
                            </div>
                            <div class="alert alert-warning alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. <a href="#" class="alert-link">Alert Link</a>.
                            </div>
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. <a href="#" class="alert-link">Alert Link</a>.
                            </div>
                        </div>
                        <!-- .panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Modals
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Button trigger modal -->
                            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                                Launch Demo Modal
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                        </div>
                                        <div class="modal-body">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                        </div>
                        <!-- .panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
              </div>
              <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tooltips and Popovers
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <h4>Tooltip Demo</h4>
                            <div class="tooltip-demo">
                                <button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="left" title="Tooltip on left">Tooltip on left</button>
                                <button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Tooltip on top">Tooltip on top</button>
                                <button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">Tooltip on bottom</button>
                                <button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="right" title="Tooltip on right">Tooltip on right</button>
                            </div>
                            <br>
                            <h4>Clickable Popover Demo</h4>
                            <div class="tooltip-demo">
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="left" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
                                    Popover on left
                                </button>
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="top" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
                                    Popover on top
                                </button>
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
                                    Popover on bottom
                                </button>
                                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="right" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
                                    Popover on right
                                </button>
                            </div>
                        </div>
                        <!-- .panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
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
