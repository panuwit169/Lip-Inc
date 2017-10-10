<meta charset="UTF8">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<?
  include("../Env/config.php");
  $name = $_POST["name"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $email = $_POST["email"];
  $address = $_POST["address"];
  $tel = $_POST["tel"];
  $province = $_POST["province"];
  $amphur = $_POST["amphur"];
  $district = $_POST["district"];
  $postcode = $_POST["postcode"];

  // $strSQL = "SELECT * FROM province WHERE PROVINCE_ID = $province";
  // $objQuery = mysql_query($strSQL)  or die(mysql_error());
  // $objResult = mysql_fetch_array($objQuery);
  // $province2 = $objResult["PROVINCE_NAME"];
  //
  // $strSQL2 = "SELECT * FROM amphur WHERE AMPHUR_ID = $amphur";
  // $objQuery2 = mysql_query($strSQL2)  or die(mysql_error());
  // $objResult2 = mysql_fetch_array($objQuery2);
  // $amphur2 = $objResult2["AMPHUR_NAME"];
  //
  // $strSQL3 = "SELECT * FROM district WHERE DISTRICT_CODE = $district";
  // $objQuery3 = mysql_query($strSQL3)  or die(mysql_error());
  // $objResult3 = mysql_fetch_array($objQuery3);
  // $district2 = $objResult3["DISTRICT_NAME"];

//$BDate = date("Y-m-d");
 $sql = "INSERT INTO useraccount (username,password,status,name,address,email,tel,province,amphur,district,postcode) VALUES
('$username','$password','2','$name','$address','$email','$tel','$province','$amphur','$district','$postcode')";
//echo $sql;
mysql_query($sql,$con);
echo "<meta http-equiv='refresh' content='1;URL=../page/login.php?id=success'>";
?>
