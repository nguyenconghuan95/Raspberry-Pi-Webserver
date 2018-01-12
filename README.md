# Introduction
This project designed a system to collect and proccess data to control devices. It was built base on two main parts: <br>
* Raspberry Pi 3: a Webserver to receive data from client and process to decide the control signal. It also create an user interface, let user control the system through WiFi
* ESP8266 nodeMCU: collect data from sensor, send them to Webserver, receive and execute the control commands from Webserver. An ESP8266 can control maximum 2 zones and a system can have many ESP8266

# Getting Started
These instruction will show you how to make the project work

## Prerequisites
**Software**<br>
The Webserver of this project was built base on PHP, HTML, Javascript and save data to MySQL so you need to install PHP and MySQL on your server to make it work. <br>
To install PHP and MySQL you can see this tutorial [How To Install Linux, Apache, MySQL, PHP (LAMP)](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-04)

## 
