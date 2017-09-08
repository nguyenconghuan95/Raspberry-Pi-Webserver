import RPi.GPIO as GPIO
import time

Led = 18

GPIO.setmode(GPIO.BCM)
GPIO.setup(Led, GPIO.OUT)

GPIO.PWM(Led, 50).stop()
GPIO.output(Led, GPIO.LOW)
print("Press CTRL+C to exit")

while 1:
	GPIO.output(Led, not GPIO.input(Led))
	time.sleep(1)
 
