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
            <?php if ($_GET['alert'] == "success"){?>
              <div class="column is-9 notification is-success">
                <center>คุณได้แจ้งการโอนเงินสำเร็จแล้ว</center>
              </div>
            <?php } ?>
            <h1 class="title">
              แจ้งการโอนเงิน
            </h1>
            <form action="../process/confirm_payment.php" method="post" enctype="multipart/form-data">
            <table>
              <tr>
                <td>หมายเลขการสั่งซื้อ</td>
                <td><input type="text" class="input" style="width:200px" name="paymentid" value="<?php echo $_GET["id"];?>" required></td>
              </tr>
              <tr>
                <td width="20%">บัญชีที่โอน</td>
                <td>
                  <label class="radio">
                  <input type="radio" name="acc" value="k-bank"checked>
                  <img src="../assets/kbank.png" width="30px"> ธนาคารกสิกรไทย 751-2-43563-3 สาขาเดอะมอลล์ บางแค
                  </label>
                </td>
              </tr>
              <tr>
                <td>วันที่โอน</td>
                <td><input type="date" class="input" style="width:200px" name="datepayment" value="" required></td>
              </tr>
              <tr>
                <td>เวลา (โดยประมาณ)</td>
                <td><input type="text" class="input" style="width:200px" name="timepayment" value="" required></td>
              </tr>
              <tr>
                <td>หลักฐานการโอนเงิน</td>
                <td><input type="file" style="width:200px" name="filUpload" accept="image/*" required></td>
              </tr>
              <tr>
                <td>จำนวนเงิน</td>
                <td><input type="number" class="input" style="width:200px" name="amountpayment" value="" required></td>
              </tr>
            </table>
                <div style="width:70vw;text-align:center;padding-top:20px"><input type="submit" class="button is-success" value="ยืนยัน"></div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <?php
      $root = $_SERVER['DOCUMENT_ROOT'];
      $file_path = $root . '/lip-inc/components/footer.php';
      include($file_path);
    ?>


  </body>
</html>
