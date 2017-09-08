<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
        <title>GPIO Modes</title>
    </head>
    <body style="background-color: #A9A9A9">
        <h1 style="color: white; text-align: center;">RASPBERRY GPIO TEST</h1>
        <?php
            system("gpio mode 1 out");
            system("gpio write 1 1");
            sleep(1);
            system("gpio write 1 0");
	    system("sudo python /var/www/Python/gpio_turnOffLed.py");
        ?>
        <button style="border-radius: 10px;" onclick="toggleLed();">Toggle Led</button>
        <br>
        <button style="border-radius: 10px;" onclick="brightenLed();">Brighten and Dim Led</button>
	<br>
	<button style="border-radius: 10px;" onclick="turnOffLed();">Turn Off Led</button>
        <script src="lightLed.js"></script>
	<br>
	<a href="setTime.html"><button style="border-radius: 10px;">Set Time</button></a>
    </body>
</html>

