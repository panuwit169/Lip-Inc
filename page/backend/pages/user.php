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
                    <h1 class="page-header">จัดการลูกค้า</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            แก้ไขลูกค้า
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table id="user" class="display" cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th>รหัสลูกค้า</th>
                                  <th>ชื่อลูกค้า</th>
                                  <th>ชื่อ Username</th>
                                  <th>ระดับ</th>
                                  <th>ตัวเลือก</th>
                                </tr>
                              </thead>
                              <?php
                                $sqltxt = "SELECT * FROM useraccount join roleaccount on useraccount.status = roleaccount.role_status order by useraccount.id ASC";
                                $result = mysql_query ($sqltxt,$con);
                              ?>
                              <tbody>
                                <?php
                                  while($rs = mysql_fetch_array($result)){
                                ?>
                                <tr>
                                  <td><?php echo $rs[0]; ?></td>
                                  <td><?php echo $rs[4]; ?></td>
                                  <td><?php echo $rs[1] ?></td>
                                  <td><?php echo $rs[6] ?></td>
                                  <td>
                                    <a style="text-decoration: none;" href="edit_user.php?id=<?php echo $rs[0]; ?>">
                                      <button type="button" class="btn btn-warning">แก้ไข / กำหนดสิทธิ์</button>
                                    </a>
                                    <?php
                                      echo "<a href=\"../../../process/backend/deleteuser.php?id=$rs[0]\" ";
                                      echo "onclick=\"return confirm('ยืนยันการลบข้อมูลลูกค้า $rs[1]')\"><button type=\"button\" class=\"btn btn-danger\">ลบ</button></a>";
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
        $('#user').DataTable();
    });
    </script>

</body>

</html>
