<meta charset="utf-8">
<?php
  $servername = "localhost";
  $username = "root";
  $password = "1234";
  $db = "cosmetic";

  $con = mysql_connect($servername,$username,$password);
  mysql_select_db($db,$con);
  mysql_query("SET NAMES utf8");
?>
