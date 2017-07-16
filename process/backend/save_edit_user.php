<meta charset="UTF8">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">

<?
ob_start();
@session_start();
include("../../Env/config.php");
$id = $_POST['id'];
$role = $_POST["role"];

    $strSQL = "UPDATE useraccount SET status = '".$role."' WHERE id='$id'";
		mysql_query($strSQL,$con);

echo "<meta http-equiv='refresh' content='1;URL=../../page/backend/pages/user.php'>";
mysql_close($con);
?>
