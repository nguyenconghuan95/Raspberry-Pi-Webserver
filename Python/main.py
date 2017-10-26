import time
import RPi.GPIO as GPIO
import LED
import MySQLdb
import setTime
import DS1307_driver
import I2C_LCD_driver
import threading

#Init DS1307, LCD
rtc = DS1307_driver.SDL_DS1307()
myLcd = I2C_LCD_driver.lcd()

killflag = None
def sql_connect():
    db = MySQLdb.connect('localhost', 'admin', 'admin', 'smartGarden')
    return db

def timingOn():
    db = sql_connect()
    realDay = setTime.getDay(rtc._read_day())
    realTime = "%02d:%02d" % (rtc._read_hours(), rtc._read_minutes())
    listDay = setTime.getSavedDay(db, 'On')
    listTimeOn = setTime.getSavedTimeOn(db)
    listDevice = setTime.getSavedDevice(db)
    i = 0
    for rowDay in listDay:
        day = rowDay[0]
        rowTimeOn = listTimeOn[i]
        timeOn = rowTimeOn[0]
        if (realDay == day)&(realTime == timeOn):
	    	rowDevice = listDevice[i]
	    	device = rowDevice[0]
	    	cursor = db.cursor()
	    	sql_str = "UPDATE led SET CHANGED=1 WHERE LED='%s'" % (device) 
	    	cursor.execute(sql_str)
	    	db.commit()
	    	LED.led_switch(db, 'On', device) 
        i += 1

def timingOff():
    db = sql_connect()
    realDay = setTime.getDay(rtc._read_day())
    realTime = "%02d:%02d" % (rtc._read_hours(), rtc._read_minutes())
    listDay = setTime.getSavedDay(db, 'Off')
    listTimeOff = setTime.getSavedTimeOff(db)
    listDevice = setTime.getSavedDevice(db)
    i = 0
    for rowDay in listDay:
        day = rowDay[0]
        rowTimeOff = listTimeOff[i]
        timeOff = rowTimeOff[0]
        time.sleep(1)
        if (realDay == day)&(realTime == timeOff):
			rowDevice = listDevice[i]
			device = rowDevice[0]
			cursor = db.cursor()
			sql_str = "UPDATE led SET CHANGED=1 WHERE LED='%s'" % (device)
			cursor.execute(sql_str)
			db.commit()
			LED.led_switch(db, 'Off', device)
        i += 1

class TimingThread(threading.Thread):
    def __init__(self, threadID, delay):
	threading.Thread.__init__(self)
	self.threadID = threadID
	self.delay = delay

    def run(self):
	while(1):
	    timingOn()
	    timingOff()
	    db = sql_connect()
	    setTime.setupTime(db)
	    time.sleep(self.delay)

class ControlThread(threading.Thread):
    def __init__(self, threadID, delay):
	threading.Thread.__init__(self)
	self.threadID = threadID
	self.delay = delay

    def run(self):
	while(1):
		db = sql_connect()
		time.sleep(self.delay)
		sql_str = "SELECT LED FROM led WHERE CHANGED=1"
		cursor = db.cursor()
		cursor.execute(sql_str)
		listDevice = cursor.fetchall()
		for rowDevice in listDevice:
			device = rowDevice[0]
			status = LED.led_status(db, device)
	    	LED.led_switch(db, status, device)

class DisplayLCDThread(threading.Thread):
    def __init__(self, threadID, delay):
	threading.Thread.__init__(self)
	self.threadID = threadID
        self.delay = delay

    def run(self):
	while(1):
	    time.sleep(self.delay)
	    setTime.showTime_LCD()

def Main():
    try:
		Thread1 = TimingThread(1, 1)
		Thread1.daemon = True
		Thread2 = ControlThread(2, 1)
		Thread2.daemon = True
		Thread3 = DisplayLCDThread(3, 1)
		Thread3.daemon = True
		Thread1.start()
		Thread2.start()
		Thread3.start()
		while True:
			time.sleep(100)
    except (KeyboardInterrupt, SystemExit):
		print "Quit"

if __name__ == '__main__':
    Main()

