<!DOCTYPE html>
<?php
  ob_start();
  @session_start();
  include("../Env/config.php");
?>
<html>
  <head>
    <?php
      $root = $_SERVER['DOCUMENT_ROOT'];
      $file_path = $root . '/lip-inc/components/header.php';
      include($file_path);
    ?>
  </head>
  <body>
    <?php
      $root = $_SERVER['DOCUMENT_ROOT'];
      $file_path = $root . '/lip-inc/components/navbar.php';
      include($file_path);
    ?>

    <section class="hero is-medium is-primary is-bold ">
      <div class="hero-body">
       <div class="container ">
      <div class="columns">

        <div class="column is-6">

          <h1 class="title">
            About Us
          </h1>
          <h2 class="subtitle">
            Contact
          </h2>

        </div>
        <div class="column is-6">

          <h2 class="subtitle">

                <p>มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าพระนครเหนือ วิทยาเขตปราจีนบุรี</p>
                <hr>
                <p>129 ม.21 ตำบลเนินหอม อำเภอเมือง จังหวัดปราจีนบุรี 25230</p>
                <hr>
                <p>คณะเทคโนโลยีและการจัดการอุตสาหกรรม ภาควิชาเทคโนโลยีสารสนเทศ</p>
          </h2>
          </div>
        </div>
      </div>
       </div>
    </section>


    </body>

</html>
