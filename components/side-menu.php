<aside class="menu">
  <p class="menu-label" style="font-size: 16px;">
    แนะนำ
  </p>
  <ul class="menu-list">
      <li><a href="productlist.php?id=22">Lip Inc</a></li>
  </ul>
  <p class="menu-label" style="font-size: 16px;">
    ประเภทสินค้า
  </p>
  <?php
    $sql = mysql_query("SELECT * FROM product_type");
    $num = mysql_num_rows($sql);
  ?>
  <ul class="menu-list">
    <?php while($user = mysql_fetch_array($sql)){ ?>
      <li><a href="protypelist.php?id=<?php echo $user["protype_id"]; ?>"><?php echo $user["protype_name"]; ?></a></li>
    <?php } ?>
  </ul>
  <p class="menu-label" style="font-size: 16px;">
    แบรนด์
  </p>
  <?php
    $sql = mysql_query("SELECT * FROM brand");
    $num = mysql_num_rows($sql);
  ?>
  <ul class="menu-list">
    <?php while($user = mysql_fetch_array($sql)){ ?>
      <li><a href="productlist.php?id=<?php echo $user["brand_id"]; ?>"><?php echo $user["brand_name"]; ?></a></li>
    <?php } ?>
  </ul>
</aside>
