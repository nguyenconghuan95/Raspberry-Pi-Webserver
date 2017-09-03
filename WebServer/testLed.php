<?php
    if (isset($_GET["action"])) {
        if ($_GET["action"] == "toggle") {
            system("sudo python var/www/python/gpio_toggleLed.py");
        }
        else if ($_GET["action"] == "brighten") {
            system("sudo python var/www/python/gpio_brightenLed.py");
        }
    }
    else {
        echo("Failed to execute python code!!!");
    }
?>
