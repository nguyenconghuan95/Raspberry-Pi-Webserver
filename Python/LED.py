import time
import RPi.GPIO as GPIO
import MySQLdb

GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)
GPIO.setup(18, GPIO.OUT)
GPIO.setup(23, GPIO.OUT)


def led_getPin(device):
	if (device == 'light1'):
		return 18
	elif (device == 'light2'):
		return 23
	elif (device == 'hose1'):
		return 24
	elif (device == 'hose2'):
		return 25
	elif (device == 'sunshade1'):
		return 26
	elif (device == 'sunshade2'):
		return 27

def led_switch(db, str, device):
	cursor = db.cursor()
	query_str = "SELECT CHANGED FROM led WHERE LED='" + device +"'"
	cursor.execute(query_str)
	change = cursor.fetchone()
	change = change[0]
	pin = led_getPin(device)
	if ((str == 'On')&(change == 1)):
		GPIO.output(pin, GPIO.HIGH)
		query_str = "UPDATE led SET CHANGED=0 WHERE LED='" + device + "'"
		cursor.execute(query_str)
		db.commit()
		print("Turned On Led "+ device + " !!!\n")
	if ((str =='Off')&(change == 1)):
		GPIO.output(pin, GPIO.LOW)
		query_str = "UPDATE led SET CHANGED=0 WHERE LED='" + device + "'"
		cursor.execute(query_str)
		db.commit()
		print("Turned Off Led " + device + " !!!\n")

def led_status(db, device):
    cursor = db.cursor()
    query_str = "SELECT STATUS FROM led WHERE LED='" + device + "'"
    cursor.execute(query_str)
    status = cursor.fetchone()
    status = status[0]
    return status

