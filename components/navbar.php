<nav class="nav has-shadow">
  <div class="container">
    <div class="nav-left">
      <a class="nav-item" href="index.php">
       <img src="../assets/logo.jpg" style="max-height: 2.55rem;">
      </a>
      <a href="index.php" class="nav-item is-tab is-hidden-mobile is-active">หน้าแรก</a>
      <a href="allproduct.php" class="nav-item is-tab is-hidden-mobile">สินค้า</a>
      <a href="payment.php" class="nav-item is-tab is-hidden-mobile">แจ้งการชำระเงิน</a>
    </div>
    <span class="nav-toggle">
      <span></span>
      <span></span>
      <span></span>
    </span>
    <div class="nav-right nav-menu">
      <a href="index.php" class="nav-item is-tab is-hidden-tablet is-active">หน้าแรก</a>
      <a href="allproduct.php" class="nav-item is-tab is-hidden-tablet">สินค้า</a>
      <a href="payment.php" class="nav-item is-tab is-hidden-tablet">แจ้งการชำระเงิน</a>
      <?php
      $total = 0;
      for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
      {
        if($_SESSION["strProductID"][$i] != "")
        {
          $total += $_SESSION["strQty"][$i];
        }
      }
      ?>
      <a href="show.php" class="nav-item is-tab"><i class="fa fa-shopping-basket" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo $total;?></a>
      <?php if(isset($_SESSION['ses_id'])){ ?>
        <div class="nav-item is-tab">
          <a href="options.php">
            <?php echo $_SESSION['username'];?>
          </a>
        </div>
        <a href="../process/logout.php" class="nav-item is-tab">ออกจากระบบ</a>
      <?php } else { ?>
        <a href="login.php" class="nav-item is-tab">เข้าสู่ระบบ</a>
      <?php } ?>
    </div>
  </div>
</nav>
