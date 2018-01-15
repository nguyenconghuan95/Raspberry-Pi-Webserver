<?php
    require_once "DB_mysql.php";
    require_once "config.inc.php";

	$db = new DB_mysql();

    $conn = $db -> db_connect();

    $sql = "SELECT ZONE, TIME, TEMPERATURE FROM $tbl_measurement";
    $result = $db -> db_query($conn, $sql);

    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }
    $db -> db_close($conn);

    print json_encode($data);
?>

