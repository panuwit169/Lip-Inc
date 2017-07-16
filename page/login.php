<!DOCTYPE html>
<html>
<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  $file_path = $root . '/lip-inc/components/header.php';
  include($file_path);
?>
<body>
  <div class="login-wrapper columns">
    <div class="column is-8 is-hidden-mobile hero-banner">
      <section class="hero is-fullheight is-dark">
        <div class="hero-body">
          <div class="container section">
            <div class="has-text-right">
              <h1 class="title is-1">เข้าสู่ระบบ</h1> <br>
              <p class="title is-3">Lipinc Swallow Honest Shop</p>
            </div>
          </div>
        </div>
        <div class="hero-footer">
          <p class="has-text-centered">Image © Glenn Carstens-Peters via unsplash</p>
        </div>
      </section>
    </div>
    <div class="column is-4">
      <section class="hero is-fullheight">
        <div class="hero-heading">
          <div class="section has-text-centered">
            <?php if($_GET['id'] == "fail") {?>
              <div class="notification is-warning">
                ชื่อผู้ใช้ หรือ รหัสผ่าน ไม่ถูกต้อง. กรุณาลองใหม่อีกครั้ง.
              </div>
            <?php } else if($_GET['id'] == "success") { ?>
              <div class="notification is-success">
                สมัครสมาชิกเรียบร้อยแล้ว
              </div>
              <?php } ?>
            <img src="../assets/logo.jpg" >
          </div>
        </div>
        <div class="hero-body">
          <div class="container">
            <div class="columns">
              <div class="column is-8 is-offset-2">
                <h1 class="avatar has-text-centered section">

                </h1>
                <form action = "../process/checklogin.php" method="post" >
                  <div class="login-form">
                    <p class="control has-icon has-icon-right" style="margin-bottom: 10px;">
                      <input class="input email-input" type="text" name="username" id="username" placeholder="ชื่อผู้ใช้" required="">
                      <span class="icon user">
                        <i class="fa fa-user"></i>
                      </span>
                    </p>
                    <p class="control has-icon has-icon-right">
                      <input class="input password-input" type="password" name="password" id="password" placeholder="รหัสผ่าน" required="">
                      <span class="icon user">
                        <i class="fa fa-lock"></i>
                      </span>
                    </p>
                    <p class="control login">
                      <button class="button is-success is-outlined is-large is-fullwidth">เข้าสู่ระบบ</button>
                    </p>
                  </div>
                </form>
                <div class="section forgot-password">
                  <p class="has-text-centered">
                    <a href="index.php">หน้าหลัก</a>
                    <a href="register.php">สมัครสมาชิก</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>

</body>
</html>
