<?php
	require_once "DB_mysql.php";
    require_once "config.inc.php";

	$db = new DB_mysql();

    $conn = $db -> db_connect();
    
	$sql = "UPDATE $tbl_limit SET " .$_POST['limPara']. "=" .$_POST['limValue']. " WHERE ZONE=" .$_POST['limZone'];
    $db -> db_query($conn, $sql);
    $db -> db_close($conn);
?>
