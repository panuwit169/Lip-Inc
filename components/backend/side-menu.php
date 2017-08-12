<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>

            <li>
                <?php
                  $sql ="SELECT COUNT(*) FROM orders JOIN payment ON orders.order_id = payment.order_id WHERE payment.status = 'notcheck' ORDER BY payment.id ASC";
                  $result = mysql_query($sql,$con);
                  while($rs = mysql_fetch_array($result)){
                ?>
                <a href="order.php"><i class="fa fa-shopping-cart fa-fw"></i> รายการสั่งซื้อ <span class="badge" style="float:right"><?php echo $rs[0];?></span></a>
                <?php } ?>
            </li>

            <li>
                <a href="product.php"><i class="fa fa-table fa-fw"></i> จัดการสินค้า</a>
            </li>
            <li>
                <a href="user.php"> <i class="fa fa-user fa-fw"></i> จัดการลูกค้า</a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
