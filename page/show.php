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
              <?php if($_GET['over'] == "true") {?>
              <div class="notification is-warning" style="width:70%">
                ขออภัย ! คุณได้กรอกจำนวนสินค้า <?php echo $_GET["product"];?> เกินจำนวนในคลังสินค้า ลองใหม่อีกครั้ง
              </div>
              <?php } ?>
              <h1 class="title" style="margin-top:30px">
                ตะกร้าสินค้า
              </h1>
              <form action="../process/update.php" method="post">
                <table class="table" style="width:70%">
                  <thead>
                    <tr>
                      <th>ชื่อสินค้า</th>
                      <th>ราคา</th>
                      <th>จำนวน</th>
                      <th>ราคารวม</th>
                      <th>ลบ</th>
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
                    		<input type="hidden" name="txtProductID<?php echo $i;?>" value="<?php echo $_SESSION["strProductID"][$i];?>">
                    		<td><?php echo $objResult["product_name"];?></td>
                    		<td><?php echo $objResult["product_price"];?></td>
                    		<td><div style="width:60px"><input class="input" type="number" min="1" name="txtQty<?php echo $i;?>" value="<?php echo $_SESSION["strQty"][$i];?>"></div></td>
                    		<td><?php echo number_format($Total,2);?></td>
                    		<td><a href="../process/delete.php?Line=<?php echo $i;?>">x</a></td>
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
                      <div class="is-pulled-left">
                        <input class="button is-light" type="submit" value="อัพเดท">
                      </div>
                      <div class="is-pulled-right">
                        ราคารวมทั้งหมด : <?php echo number_format($SumTotal,2);?>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="columns">
                  <div class="column">
                    <div style="width:70%">
                      <div class="is-pulled-left" >
                        <a class="button is-primary is-inverted" href="allproduct.php">
                          <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;
                          กลับไปหน้าสินค้า
                        </a>
                      </div>
                      <div class="is-pulled-right">
                        <?php
                        	if($SumTotal > 0)
                        	{
                        ?>
                          <a class="button is-primary is-inverted" href="checkout.php">
                          	เริ่มทำการสั่งซื้อสินค้า&nbsp;
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                          </a>
                        <?php
                        	}
                        ?>
                        <?php
                        mysql_close();
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
            </form>
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


</body>
</html>
