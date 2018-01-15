<?php
   require_once "DB_mysql.php";
   require_once "config.inc.php";

   $db = new DB_mysql();

   $conn = $db -> db_connect();

	echo $_GET["device"];
    echo("Connect Successful!!!<br>");
	$sql = "UPDATE $tbl_device SET STATUS='". $_POST["action"] ."' WHERE LED='". $_POST["device"] ."'";
	$sql1 = "UPDATE $tbl_device SET CHANGED=1 WHERE LED='". $_POST["device"] . "'";
	$db -> db_query($conn, $sql);
	$db -> db_query($conn, $sql1);
    $db -> db_close($conn);
?>
