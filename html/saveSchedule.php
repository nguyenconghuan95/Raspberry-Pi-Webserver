<?php
    require_once "DB_mysql.php";
    require_once "config.inc.php";

	$db = new DB_mysql();

    $conn = $db -> db_connect();

    if (isset($_POST["addSchedule"])) {
        $sql = "INSERT INTO $tbl_schedule VALUES('".$_POST["dayOn"]."', '".$_POST["timeOn"]."', '".$_POST["dayOff"]."', '".$_POST["timeOff"]."', '".$_POST["device"]."')";
        if ($db -> db_query($conn, $sql)) {
            header('Location: index.php');
            exit;
        }
        else {
            echo("<script type='text/javascript> alert('Something wrong, can't add schedule!!!'); </script>");
        }
    }
    
        if (isset($_POST["deleteSchedule"])) {
            $sql = "DELETE FROM schedule WHERE DAY_ON='".$_POST["dayOn"]."' AND TIME_ON='".$_POST["timeOn"]."' AND DAY_OFF='".$_POST["dayOff"]."' AND TIME_OFF='".$_POST["timeOff"]."' AND DEVICE='".$_POST["device"]."'";
            if ($db -> db_query($conn, $sql)) {
                header('Location: index.php');
                exit;
            }
            else {
                echo("<script type='text/javascript> alert('Something wrong, can't delete schedule!!!'); </script>");
            }
        }
    
        if (isset($_GET["all"])) {
            $sql = "TRUNCATE TABLE schedule";
            if ($db -> db_query($conn, $sql)) {
                header('Location: index.php');
                exit;
            }
            else {
                echo("<script type='text/javascript> alert('Something wrong, can't delete schedule!!!'); </script>");
            }
        }

    
?>
