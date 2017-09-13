 <?php

    system("sudo date --set '".$_POST["date"]." ".$_POST["time"]." UTC'");
    echo("<br>Set date and time successfully!!!<br><br>");
    echo("<a href='index.php'><button style='border-radius: 10px'>Back</button></a>");
?>
