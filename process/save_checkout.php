<?php
  session_start();
  include("../Env/config.php");

  $Total = 0;
  $SumTotal = 0;

  $province = $_POST["province"];
  $amphur = $_POST["amphur"];
  $district = $_POST["district"];
  $postcode = $_POST["postcode"];

  $strSQL = "INSERT INTO orders (order_id,OrderDate,user_id,Name,Address,province,amphur,district,postcode,Tel,Email) VALUES (
    CONCAT(
            DATE_FORMAT(NOW(), 'OD%d%m%Y'),
            LPAD(
                IFNULL(
                    (SELECT
                        SUBSTR(order_id, 11)
                        FROM orders AS alias
                        WHERE SUBSTR(order_id, 1, 10) = DATE_FORMAT(NOW(), 'OD%d%m%Y')
                        ORDER BY order_id DESC
                        LIMIT 1
                    )
                    + 1,
                    1
                ),
                6,
                '0'
            )
        ),'".date("Y-m-d H:i:s")."','".$_SESSION['user_id']."','".$_POST["txtName"]."','".$_POST["txtAddress"]."','".$province."','".$amphur."','".$district."','".$postcode."','".$_POST["txtTel"]."','".$_POST["txtEmail"]."')";
  mysql_query($strSQL,$con) or die(mysql_error());
  $strOrderID="";
  $get_id = "SELECT CONCAT(DATE_FORMAT(NOW(), 'OD%d%m%Y'), (SELECT SUBSTR(order_id, 11) FROM orders AS alias WHERE SUBSTR(order_id, 1, 10) = DATE_FORMAT(NOW(), 'OD%d%m%Y') ORDER BY order_id DESC LIMIT 1))";

  $sql = mysql_query($get_id,$con) or die(mysql_error());
  $num = mysql_num_rows($sql);
  while($user = mysql_fetch_array($sql)){
    $strOrderID = $user[0];
  }
  for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
  {
    if($_SESSION["strProductID"][$i] != "")
    {
  		  $strSQL = "
  			INSERT INTO orders_detail (order_id,product_id,qty)
  			VALUES
  			('".$strOrderID."','".$_SESSION["strProductID"][$i]."','".$_SESSION["strQty"][$i]."')
  		  ";
  		  mysql_query($strSQL) or die(mysql_error());
    }
  }
  for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
  {
    if($_SESSION["strProductID"][$i] != "")
    {
      $_SESSION["strProductID"][$i] = "";
      $_SESSION["strQty"][$i] = "";
      $_SESSION["intLine"]=0;
    }
  }
  mysql_close();
  echo "<meta http-equiv='refresh' content='1;URL=../page/view_order.php?OrderID=".$strOrderID."'>";

?>
