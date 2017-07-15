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
              Register an Account
            </h1>
            <form class="" action="../process/save_register.php" method="post">
              <div class="box">
                <label class="label">Name</label>
                <p class="control">
                  <input class="input" type="text" name="name" placeholder="Name" required="">
                </p>
                <label class="label">Username</label>
                <p class="control">
                  <input class="input" type="text" name="username" placeholder="Username" required="">
                </p>
                <hr>
                <label class="label">Password</label>
                <p class="control">
                  <input class="input" type="password" name="password" placeholder="Password" required="">
                </p>
                <hr>
                <p class="control">
                  <input type="submit" class="button is-primary" value="Register">
                  <a href="../page/login.php" class="button is-default">Cancel</a>
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
