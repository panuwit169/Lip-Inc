<?php
	ob_start();
	session_start();

	$Line = $_GET["Line"];
	$_SESSION["strProductID"][$Line] = "";
	$_SESSION["strQty"][$Line] = "";

	echo "<meta http-equiv='refresh' content='1;URL=../page/show.php'>";
?>
