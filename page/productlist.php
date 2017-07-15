<!DOCTYPE html>
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
                แบรนด์
              </h1>
              <h2 class="subtitle">

              </h2>
              <div class="columns is-multiline">
                <?php
                  $sql = mysql_query("SELECT * FROM product JOIN brand ON product.brand_id = brand.brand_id where brand.brand_id = $id");
                  $num = mysql_num_rows($sql);
                  while($user = mysql_fetch_array($sql)){
                ?>
                <div class="column is-3" style="width: 350px;">
                  <div class="card" style="height: 100%">
                    <a href="product.php?id=<?php echo $user['product_id'];?>">
                      <div class="card-image">
                        <figure class="image is-1by1" style="margin:20px">
                          <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $user['product_img'] ).'"/>' ?>
                        </figure>
                      </div>
                      <div class="card-content" style="padding: 0px 0 20px 0">
                        <div class="media">
                          <div class="media-content" style="margin: 0px 0 10px 0">
                            <div class="has-text-centered">
                              <p class="title is-5" style="margin: 10px 0"><?php echo $user["brand_name"]; ?></p>
                              <p class="title is-6"><?php echo $user["product_name"]; ?></p>
                            </div>
                          </div>
                        </div>
                        <div class="content">
                          <?php if($user["product_num"] == 0){?>
                            <div class="has-text-centered">
                              <a class="button is-danger is-disabled" title="Disabled button" disabled>สินค้าหมด</a>
                            </div>
                          <?php } else {?>
                          <div class="has-text-centered">
                            <a class="button is-primary is-outlined" href="../process/order2.php?ProductID=<?php echo $user["product_id"];?>">เพิ่มลงตะกร้า<i class="fa fa-shopping-basket" style="margin-left:10px"></i> </a>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
                <?php } ?>
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
