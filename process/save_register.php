<meta charset="UTF8">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<?
  include("../Env/config.php");
  $name = $_POST["name"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $address = $_POST["address"];

//$BDate = date("Y-m-d");
 $sql = "INSERT INTO useraccount (username,password,status,name,address) VALUES
('$username','$password','2','$name','$address')";
//echo $sql;
mysql_query($sql,$con);
echo "<meta http-equiv='refresh' content='1;URL=../page/login.php?id=success'>";
?>
