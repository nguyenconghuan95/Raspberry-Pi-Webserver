<?php
    require_once "DB_mysql.php";
    require_once "config.inc.php";

	$db = new DB_mysql();

    $conn = $db -> db_connect();

    if (isset($_GET["first"])) {
        $sql = "SELECT LED, STATUS FROM $tbl_device";
        $result = $db -> db_query($conn, $sql);
        
        $data = array();
        foreach ($result as $row) {
            $data[] = $row;
        }
    
        $sql = "UPDATE $tbl_device SET CHANGED=0 WHERE CHANGED=1";
        $db -> db_query($conn, $sql);
    
        $db -> db_close($conn);
    
        print json_encode($data);
    }
    else {
        $sql = "SELECT LED, STATUS FROM $tbl_device WHERE CHANGED=1";
        $result = $db -> db_query($conn, $sql);
        
        $data = array();
        foreach ($result as $row) {
            $data[] = $row;
        }
    
        $sql = "UPDATE $tbl_device SET CHANGED=0 WHERE CHANGED=1";
        $db -> db_query($conn, $sql);
    
        $db -> db_close($conn);
    
        print json_encode($data);
    }

    
?>
