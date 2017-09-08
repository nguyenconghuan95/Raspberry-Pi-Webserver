 <?php
    system("sudo date --set '".$_POST["month"]." ".$_POST["day"]." ".$_POST["hour"].":".$_POST["minute"]." UTC'");
    echo($_POST["month"]." ".$_POST["day"]." ".$_POST["hour"].":".$_POST["minute"]);
    echo("Set time successfully!!!");
    sleep(2);
    header("Location: index.php");
?>
