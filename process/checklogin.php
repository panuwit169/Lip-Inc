<?php
session_start();
include("../Env/config.php");
$username = $_POST['username'];
$password = $_POST['password'];

  $sql = mysql_query("SELECT * FROM useraccount WHERE username = '$username' AND password = '$password' ");

  $num = mysql_num_rows($sql);
  if($num <= 0){
    echo "<meta http-equiv='refresh' content='1;URL=../page/login.php?id=fail'>";
  }
  else{
    while($user = mysql_fetch_array($sql)){
      if($user['status'] == 1)
      {
        $_SESSION['ses_id'] = session_id();
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['status'] = 1;

        echo "<meta http-equiv='refresh' content='1;URL=../page/backend/pages/index.php'>";
      }
      else {
        $_SESSION['ses_id'] = session_id();
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['status'] = 2;
        echo "<meta http-equiv='refresh' content='1;URL=../page/index.php'>";
      }
    }
  }

 ?>
