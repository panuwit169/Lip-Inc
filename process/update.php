<?php
ob_start();
session_start();
$product_name = "";
include("../Env/config.php");
  for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
  {
	  if($_SESSION["strProductID"][$i] != "")
	  {
      $strSQL = "SELECT * FROM product WHERE product_id = '".$_SESSION["strProductID"][$i]."'";
      $objQuery = mysql_query($strSQL)  or die(mysql_error());
      $objResult = mysql_fetch_array($objQuery);
      $stock_id = $objResult["product_num"];
      if($_POST["txtQty".$i] > $objResult["product_num"])
      {
        $product_name .= $objResult["product_name"]." , ";
        $error="true";
      }
      else
      {
			  $_SESSION["strQty"][$i] = $_POST["txtQty".$i];
	    }
    }
  }
  if($error=="true"){
    echo "<meta http-equiv='refresh' content='1;URL=../page/show.php?over=true&product=$product_name'>";
  }
  else{
    echo "<meta http-equiv='refresh' content='1;URL=../page/show.php'>";
  }
?>
