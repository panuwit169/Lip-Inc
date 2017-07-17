<!DOCTYPE html>
<html>
<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  $file_path = $root . '/lip-inc/components/header.php';
  include($file_path);
?>
<body>
  <section class="hero is-fullheight is-dark is-bold">
    <div class="hero-body">
      <div class="container">
        <div class="columns is-vcentered">
          <div class="column is-4 is-offset-4">
            <h1 class="title">
              สมัครสมาชิก
            </h1>
            <form class="" action="../process/save_register.php" method="post">
              <div class="box">
                <label class="label">ชื่อ</label>
                <p class="control">
                  <input class="input" type="text" name="name" placeholder="ชื่อ-สกุล" required="">
                </p>
                <label class="label">ชื่อผู้ใช้</label>
                <p class="control">
                  <input class="input" type="text" name="username" placeholder="ไม่เกิน 8 ตัวอักษร" required="">
                </p>
                <label class="label">รหัสผ่าน</label>
                <p class="control">
                  <input class="input" type="password" name="password" placeholder="ไม่เกิน 8 ตัวอักษร" required="">
                </p>
                <hr>
                <label class="label">ที่อยู่</label>
                <p class="control">
                  <textarea class="input" name="address" style="margin-bottom: 10px;height:100px" cols="0" rows="5" required></textarea>
                </p>
                <p class="control">
                  <input type="submit" class="button is-primary" value="สมัคร">
                  <a href="../page/login.php" class="button is-default">ยกเลิก</a>
                </p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </section>
</body>
</html>
