<?php
session_start();
unset($_SESSION['ses_id']);
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['status']);

echo "<meta http-equiv='refresh' content='1;URL=../page/index.php'>";

 ?>
