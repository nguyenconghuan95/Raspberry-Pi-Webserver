# Introduction
This project designed a system to collect and proccess data to control devices. It was built on two main parts: <br>
* **Raspberry Pi**: a Webserver to receive data from client and process to decide the control signal. It also create an user interface, let user control the system through WiFi.
* **ESP8266 nodeMCU**: collect data from sensor, send them to Webserver, receive and execute the control commands from Webserver. An ESP8266 can control maximum 2 zones and a system can have many ESP8266 modules.

# Getting Started
These instruction will show you how to make the project work

## Prerequisites
**Hardware**<br>
List of modules in this project:
* 1 x Raspberry Pi 3
* 1 x ESP8266 nodeMCU (if you have more than 2 zones, you will need more than 1)
* 2 x LCD-16x2
* 2 x LCD-to-I2C
* 1 x RTC DS1307
* 2 x BH1750
* 2 x humid sensors
* 6 x relay to control devices

**Software**<br>
The Webserver of this project was built on PHP, HTML, Javascript and save data to MySQL so you need to install PHP and MySQL on your server to make it work. <br>
To install PHP and MySQL you can see this tutorial [How To Install Linux, Apache, MySQL, PHP (LAMP)](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-04)<br>
To compile and upload code to ESP8266, you need Arduino IDE and ESP8266 board package installed. Download Arduino IDE from [here](https://www.arduino.cc/en/Main/Software) and see [ESP8266 nodeMCU with IDE tutorial](https://learn.adafruit.com/adafruit-huzzah-esp8266-breakout/using-arduino-ide) to install the package.


## 
