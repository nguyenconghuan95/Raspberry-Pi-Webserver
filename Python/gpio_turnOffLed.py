import RPi.GPIO as GPIO
import time

Led = 18

GPIO.setmode(GPIO.BCM)
GPIO.setup(Led, GPIO.LOW)

GPIO.cleanup()

