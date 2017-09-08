<?php
    if ($_GET["act"] == "toggle") {
	system("sudo python /var/www/Python/gpio_toggleLed.py");
    }
    else if ($_GET["act"] == "brighten") {
	system("sudo python /var/www/Python/gpio_brightenLed.py");
    }
    else if ($_GET["act"] == "turnOff") {
	system("sudo python /var/www/Python/gpio_turnOffLed.py");
    }
?>
