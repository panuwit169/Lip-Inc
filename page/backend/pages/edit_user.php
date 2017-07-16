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
                    <h1 class="page-header">ดูข้อมูลลูกค้า</h1>
                </div>
                <?php
                  $id = $_GET['id'];
                  $sqltxt = "SELECT * FROM useraccount join roleaccount on useraccount.status = roleaccount.role_status WHERE useraccount.id=$id";
                  $result = mysql_query ($sqltxt,$con);
                  while($rs = mysql_fetch_array($result)){
                ?>
                <form action="../../../process/backend/save_edit_user.php" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group required row">
                          <label class="control-label col-md-2">รหัสลูกค้า</label>
                          <div class="controls col-md-8 ">
                              <input class="form-control" maxlength="30" style="margin-bottom: 10px" name="id" type="text" value="<?php echo $rs[0]; ?>" readonly required />
                          </div>
                      </div>
                      <div class="form-group required row">
                          <label class="control-label col-md-2">ชื่อลูกค้า</label>
                          <div class="controls col-md-8 ">
                              <input class="form-control" style="margin-bottom: 10px" type="text" value="<?php echo $rs[4]; ?>" readonly required />
                          </div>
                      </div>
                      <div class="form-group required row">
                          <label class="control-label col-md-2">ชื่อ Username</label>
                          <div class="controls col-md-8 ">
                            <input class="form-control" style="margin-bottom: 10px" type="text" value="<?php echo $rs[1]; ?>" readonly required />
                          </div>
                      </div>
                      <div class="form-group required row">
                          <label class="control-label col-md-2">ระดับ</label>
                          <div class="controls col-md-8 ">
                            <select class="form-control" name="role">
                              <?php
                                $sqltxt2 = "SELECT * FROM roleaccount";
                                $result2 = mysql_query ($sqltxt2,$con);
                                while($rs2 = mysql_fetch_array($result2)){
                              ?>
                                <option value="<?php echo $rs2[0]; ?>" <?php if($rs2[1] == $rs[6]){ echo " selected";} ?>><?php echo $rs2[1]; ?></option>
                              <?php } ?>
                            </select>

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
