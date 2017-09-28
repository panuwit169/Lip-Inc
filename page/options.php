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
                ประวัติการสั่งซื้อสินค้า
              </h1>
              <div class="columns is-multiline">
                <table id="history" class="display" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>รหัสการสั่งซื้อ</th>
                      <th>วันที่</th>
                      <th>ชื่อผู้สั่งซื้อ</th>
                      <th>เลขไปรษณีย์</th>
                      <th>ตัวเลือก</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sql = mysql_query("SELECT * FROM orders WHERE user_id = ".$_SESSION['user_id']);
                      $num = mysql_num_rows($sql);
                      while($user = mysql_fetch_array($sql)){
                    ?>
                    <tr>
                      <td><?php echo $user["order_id"]; ?></td>
                      <td><?php echo $user["OrderDate"]; ?></td>
                      <td><?php echo $user["Name"]; ?></td>
                      <td>
                      <?php
                        if($user["TrackingNo"] == ""){
                          echo "-";
                        } else{
                          echo $user["TrackingNo"];
                        }
                      ?>
                      </td>
                      <td>
                        <a style="text-decoration: none;" href="historydata.php?id=<?php echo $user["order_id"]; ?>">
                          <button type="button" class="button is-info is-small">ดูรายละเอียด</button>
                        </a>
                      </td>
                    </tr>
                    <?php
                      }
                    ?>
                  </tbody>

                </table>
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
