<?php
    require_once "DB_mysql.php";
    require_once "config.inc.php";
    //Create Connection
    $db = new DB_mysql();

    $conn = $db -> db_connect();

    if (isset($_GET["enableZone1"])) {
        $sql = "UPDATE $tbl_limit SET ManualControlFlag=1 WHERE Zone=1";
        $db -> db_query($conn, $sql);
    }
    else if (isset($_GET["disableZone1"])) {
        $sql = "UPDATE $tbl_limit SET ManualControlFlag=0 WHERE Zone=1";
        $db -> db_query($conn, $sql);
    }
    else if (isset($_GET["enableZone2"])) {
        $sql = "UPDATE $tbl_limit SET ManualControlFlag=1 WHERE Zone=2";
        $db -> db_query($conn, $sql);
    }
    else if (isset($_GET["disableZone2"])) {
        $sql = "UPDATE $tbl_limit SET ManualControlFlag=0 WHERE Zone=2";
        $db -> db_query($conn, $sql);
    }

    $db -> db_close($conn);

    header('Location: index.php');
    exit;
?>
    