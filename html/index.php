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
        ?>
    <button style="border-radius: 10px;" onclick="turn('On', 'Led1');">Turn On Led 1</button>&nbsp;&nbsp;&nbsp;&nbsp;
	<button style="border-radius: 10px;" onclick="turn('Off', 'Led1');">Turn Off Led 1</button>
	<br>
	<button style="border-radius: 10px;" onclick="turn('On', 'Led2');">Turn On Led 2</button>&nbsp;&nbsp;&nbsp;&nbsp;
    <button style="border-radius: 10px;" onclick="turn('Off', 'Led2');">Turn Off Led 2</button>
    <script src="lightLed.js"></script>
	<br>
	<a href="showMeasure.php"><button style="border-radius: 10px;">Measurement</button></a>
	<br>
	<a href="setTime.html"><button style="border-radius: 10px;">Set Time</button></a>
	<br>
	<a href="schedule.php"><button style="border-radius: 10px;">Schedule</button></a>
    </body>
</html>

