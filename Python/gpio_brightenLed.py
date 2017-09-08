import RPi.GPIO as GPIO
import time

LED = 18

#set mode BCM numbering
GPIO.setmode(GPIO.BCM)
GPIO.setup(LED, GPIO.OUT)

p = GPIO.PWM(LED, 50)
p.start(0)

print("Press CTRL + C to exit")
try:
	while 1:
		for step in range(5, 11, 5): 
			for dc in range(0, 101, step):
				p.ChangeDutyCycle(dc)
				time.sleep(0.1)
			for dc in range(100, -1, -step):
				p.ChangeDutyCycle(dc)
				time.sleep(0.1)
except KeyboardInterrupt:
	pass
	p.stop()
	GPIO.cleanup()
