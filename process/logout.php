<?php
session_start();
unset($_SESSION['ses_id']);
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['status']);
unset($_SESSION['user_id']);
unset($_SESSION['name']);

echo "<meta http-equiv='refresh' content='1;URL=../page/index.php'>";

 ?>
