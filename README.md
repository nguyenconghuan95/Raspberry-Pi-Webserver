# Overview
This project designed a system to collect and proccess data to control devices. It was built on two main parts: <br>
* **Raspberry Pi**: a Webserver to receive data from client and process to decide the control signal. It also create an user interface, let user control the system through WiFi.
* **ESP8266 nodeMCU**: collect data from sensor, send them to Webserver, receive and execute the control commands from Webserver. An ESP8266 can control maximum 2 zones and a system can have many ESP8266 modules.

# Getting Started
These instructions will show you how to make the project work

## Prerequisites
### Hardware
List of modules in this project:
* 1 x Raspberry Pi 3
* 1 x ESP8266 nodeMCU (if you have more than 2 zones, you will need more than 1 module)
* 2 x LCD-16x2
* 2 x LCD-to-I2C
* 1 x RTC DS1307
* 2 x BH1750
* 2 x humid sensors
* 6 x relay to control devices

### Software
The Webserver of this project was built on PHP, HTML, Javascript, Python and save data to MySQL so you need to install PHP and MySQL on your server to make it work. <br>
To install PHP and MySQL you can see this tutorial [How To Install Linux, Apache, MySQL, PHP (LAMP)](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-04)<br>
To compile and upload code to ESP8266, you need Arduino IDE and ESP8266 board package installed. Download Arduino IDE from [here](https://www.arduino.cc/en/Main/Software) and see [ESP8266 nodeMCU with Arduino IDE tutorial](https://learn.adafruit.com/adafruit-huzzah-esp8266-breakout/using-arduino-ide) to install the package.


## Installation
Clone this repository, code in html and Python folder is the code for Webserver, copy these two folders to your Webserver folder. Compile and upload TickerTest file in ESP8266 folder to your ESP8266 module.

## Usage
### Hardware
Connection between the modules
<p align='center'>
  <img width='480' height='360' src="https://github.com/nguyenconghuan95/Raspberry-Pi-Webserver/blob/master/img/raspCapture.PNG"><br>
  <i>Schematic for connection between Raspberry Pi and modules</i><br>
  <img width='480' height='360' src="https://github.com/nguyenconghuan95/Raspberry-Pi-Webserver/blob/master/img/espCapture.PNG"><br>
  <i>Schematic for connection between ESP8266 nodeMCU and modules</i>
</p>

### Software
First, set up static IP address for your server, you can see in this tutorial ["How do I set up static IP address?"](https://raspberrypi.stackexchange.com/questions/37920/how-do-i-set-up-networking-wifi-static-ip-address). After doing this step, replace the IP address in TickerTest file by the one you have changed <br>
Second, to make Webserver run with the hardware, run the main.py file in Python folder with command
```
python main.py
```
After doing these steps, the project is ready to work. The User Interface of the webserver with 5 main functions: show the measurement by graph, manual control, synchronize time, setup timer to ON/OFF device, set the limit parameters.
<p align='center'>
  <img width='360' height='200' src="https://github.com/nguyenconghuan95/Raspberry-Pi-Webserver/blob/master/img/web_part1.PNG"><br>
  <i>UI part 1</i><br>
  <img width='360' height='200' src="https://github.com/nguyenconghuan95/Raspberry-Pi-Webserver/blob/master/img/web_part2.PNG"><br>
  <i>UI part 2</i>
</p>


