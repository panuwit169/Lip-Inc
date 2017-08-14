<?php
  session_start();
  include("../Env/config.php");

  $Total = 0;
  $SumTotal = 0;

  $strSQL = "
  INSERT INTO orders (OrderDate,Name,Address,Tel,Email)
  VALUES
  ('".date("Y-m-d H:i:s")."','".$_POST["txtName"]."','".$_POST["txtAddress"]."','".$_POST["txtTel"]."','".$_POST["txtEmail"]."')
  ";
  mysql_query($strSQL) or die(mysql_error());

  $strOrderID = mysql_insert_id();

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
