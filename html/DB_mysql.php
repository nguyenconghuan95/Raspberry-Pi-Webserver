<?php
class DB_mysql 
{
    protected static $conn;
    public function db_connect() 
    {
        require ("config.inc.php");
        $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);
        if ($conn === false) {
            return mysqli_connect_error();
        }
        else {
            return $conn;
        }
    }

    public function db_query($conn, $sql) {
        $result = mysqli_query($conn, $sql);
        return $result;
    }

    public function db_select_all($conn, $tbl) {
        $sql = "SELECT * FROM $tbl";
        $result = $this -> db_query($conn, $sql);
        return $result;
    }

    public function db_select_fetch_assoc($conn, $sql) {
        $result = $this -> db_query($conn, $sql);
        if ($result === false) {
            return false;
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function db_select_fetch_array($conn, $sql) {
        $result = $this -> db_query($conn, $sql);
        return mysqli_fetch_array($result);
    }

    public function db_close($conn) {
        mysqli_close($conn);
    }
}