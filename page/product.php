<?php
  ob_start();
  @session_start();
  include("../Env/config.php");
  $id = $_GET["id"];
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

  <?php
    $sql = mysql_query("SELECT * FROM product JOIN brand ON product.brand_id = brand.brand_id where product_id = $id ");
    $num = mysql_num_rows($sql);
    while($user = mysql_fetch_array($sql)){
  ?>

  <div class="section product-header">
    <div class="container">
      <div class="columns">
        <div class="column">
          <span class="title is-3"><strong><?php echo $user["brand_name"]; ?>&nbsp;</strong>- <?php echo $user["product_name"]; ?></span>
          <span class="title is-3 has-text-muted"></span>
        </div>
      </div>
    </div>
  </div>
  <div class="section">
    <div class="container">
      <div class="columns">
        <div class="column is-6">
          <div class="image is-2by2">
            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $user['product_img'] ).'"/>' ?>
          </div>
        </div>
        <div class="column is-5 is-offset-1">
          <?php if($_GET['over'] == "true") {?>
            <div class="notification is-warning">
              <div class="has-text-centered">
                ขออภัย ! คุณได้กรอกจำนวนสินค้าเกินจำนวนในคลังสินค้า ลองใหม่อีกครั้ง
              </div>
            </div>
          <?php } ?>
          <div class="title is-2"><strong><?php echo $user["brand_name"]; ?>&nbsp;</strong>- <?php echo $user["product_name"]; ?></div>
          <p class="title is-3 has-text-muted">฿ <?php echo $user["product_price"]; ?></p>
          <hr>
          <p><?php echo $user["product_detail"]; ?></p>
          <br>
          <br>
          <p>
            <form action="../process/order.php" method="post">
              <input type="hidden" name="txtProductID" value="<?php echo $user["product_id"];?>" size="2">
              <input type="number" class="input has-text-centered" name="txtQty" value="1" style="width:60px;">
              &nbsp; &nbsp; &nbsp;
              <?php if($user["product_num"] == 0){ ?>
                <a class="button is-danger is-disabled" title="Disabled button" disabled>สินค้าหมด</a>
              <?php } else {?>
                <input type="submit" class="button is-primary" value="เพิ่มลงตะกร้า">
              <?php } ?>
	          </form>
          </p>
          <br>
        </div>
      </div>
    </div>
  </div>

  <?php } ?>

  <?php
    $root = $_SERVER['DOCUMENT_ROOT'];
    $file_path = $root . '/lip-inc/components/footer.php';
    include($file_path);
  ?>
<script async type="text/javascript" src="../js/bulma.js"></script>
</body>
</html>
