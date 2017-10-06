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
              <h1 class="title" style="margin-top:30px">
                เช็คเอ้าสินค้า
              </h1>
              <table class="table" style="width:70%">
                <thead>
                  <tr>
                    <th>ชื่อสินค้า</th>
                    <th>ราคา</th>
                    <th>จำนวน</th>
                    <th>ราคารวม</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $Total = 0;
                $SumTotal = 0;

                for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
                {
              	  if($_SESSION["strProductID"][$i] != "")
              	  {
              		$strSQL = "SELECT * FROM product WHERE product_id = '".$_SESSION["strProductID"][$i]."' ";
              		$objQuery = mysql_query($strSQL)  or die(mysql_error());
              		$objResult = mysql_fetch_array($objQuery);
              		$Total = $_SESSION["strQty"][$i] * $objResult["product_price"];
              		$SumTotal = $SumTotal + $Total;
              	  ?>
              	  <tr>
                		<td><?php echo $objResult["product_name"];?></td>
                		<td><?php echo $objResult["product_price"];?></td>
                		<td><?php echo $_SESSION["strQty"][$i];?></td>
                		<td><?php echo number_format($Total,2);?></td>
              	  </tr>
              	  <?php
              	  }
                }
                ?>
                </tbody>
              </table>
              <div class="columns">
                <div class="column">
                  <div style="width:70%">
                    <div class="is-pulled-right">
                      ราคคารวมทั้งหมด : <?php echo number_format($SumTotal,2);?>
                    </div>
                  </div>
                </div>
              </div>
              <?php if(isset($_SESSION['ses_id'])){ ?>
              <h2 class="subtitle">
                ที่อยู่สำหรับจัดส่ง
              </h2>
              <?php
              $strSQL2 = "SELECT * FROM useraccount WHERE id = '".$_SESSION['user_id']."' ";
              $objQuery2 = mysql_query($strSQL2)  or die(mysql_error());
              while($objResult2 = mysql_fetch_array($objQuery2)){
                $name = $objResult2["name"];
                $email = $objResult2["email"];
                $tel = $objResult2["tel"];
                $address = $objResult2["address"];
              }
              ?>
              <form name="form1" method="post" action="../process/save_checkout.php">
                <div class="field" style="width:30%">
                  <label class="label">ชื่อ</label>
                  <p class="control">
                    <input class="input" type="text" name="txtName" value="<?php echo $name;?>" required="">
                  </p>
                </div>
                <div class="field" style="width:30%">
                  <label class="label">ที่อยู่</label>
                  <p class="control">
                    <textarea class="textarea" name="txtAddress" required=""><?php echo $address;?></textarea>
                  </p>
                </div>
                <div class="field" style="width:30%">
                  <label class="label">เบอร์โทร</label>
                  <p class="control">
                    <input class="input" type="text" name="txtTel" value="<?php echo $tel;?>" required="">
                  </p>
                </div>
                <div class="field" style="width:30%">
                  <label class="label">อีเมล</label>
                  <p class="control">
                    <input class="input" type="email" name="txtEmail" value="<?php echo $email;?>" required="">
                  </p>
                </div>
                <input type="submit" class="button is-success" name="Submit" value="ยืนยัน">
              </form>
              <?php
            } else {
              echo '
              <div class="notification is-warning" style="width:70%">
                <div class="has-text-centered">
                  กรุณาเข้าสู่ระบบ ก่อนการสั่งซื้อสินค้า !
                </div>
              </div>';
            }
              mysql_close();
              ?>
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


    </body>
    </html>
