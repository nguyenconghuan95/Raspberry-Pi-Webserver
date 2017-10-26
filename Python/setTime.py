import DS1307_driver 
import MySQLdb 
import I2C_LCD_driver

rowNumber = 0
#Init DS1307, LCD
rtc = DS1307_driver.SDL_DS1307()
myLcd = I2C_LCD_driver.lcd()

#Create connection to MySQL
def sql_connect():
    db = MySQLdb.connect('localhost', 'admin', 'admin', 'smartGarden')
    return db
    

#Set time for DS1307
def getDay(day):
    if (day == 1):
	return "Sun"
    elif (day == 2):
	return "Mon"
    elif (day == 3):
	return "Tue"
    elif (day == 4):
	return "Wed"
    elif (day == 5):
	return "Thu"
    elif (day == 6):
	return "Fri"
    elif (day == 7):
	return "Sat"

def getYear(year):
    return (year + 2000)

#Functions to get the data from MySQL database
def getSavedDay(db, status):
    cursor = db.cursor()
    if (status == 'On'):
	cursor.execute("SELECT DAY_ON FROM schedule")
    elif (status == 'Off'):
	cursor.execute("SELECT DAY_OFF FROM schedule")
    listDay = cursor.fetchall()
    return listDay

def getSavedTimeOn(db):
    cursor = db.cursor()
    cursor.execute("SELECT TIME_ON FROM schedule")
    listTimeOn = cursor.fetchall()
    return listTimeOn

def getSavedTimeOff(db):
    cursor = db.cursor()
    cursor.execute("SELECT TIME_OFF FROM schedule")
    listTimeOff = cursor.fetchall()
    return listTimeOff

def getSavedType(db):
    cursor = db.cursor()
    cursor.execute("SELECT TYPE FROM schedule")
    listType = cursor.fetchall()
    return listType

def getSavedDevice(db):
    cursor = db.cursor()
    cursor.execute("SELECT DEVICE FROM schedule")
    listDevice = cursor.fetchall()
    return listDevice

def updateLedStatus(db, status, device):
    cursor = db.cursor()
    sql_str = "UPDATE led SET STATUS='%s' WHERE LED='%s'" %(status, device)
    cursor.execute(sql_str)
    db.commit()
    cursor.close()

#Functions to setup time for DS1307
def getDaySetup(db):
    cursor = db.cursor()
    cursor.execute("SELECT DAY FROM dateSetup")
    day = cursor.fetchone()
    day = day[0]
    if (day == 'Sun'):
	return 1
    elif (day == 'Mon'):
	return 2
    elif (day == 'Tue'):
	return 3
    elif (day == 'Wed'):
	return 4
    elif (day == 'Thu'):
	return 5
    elif (day == 'Fri'):
	return 6
    elif (day == 'Sat'):
	return 7

def getDateSetup(db):
    cursor = db.cursor()
    cursor.execute("SELECT DATE FROM dateSetup")
    date = cursor.fetchone()
    date = date[0]
    date = date[8] + date[9]
    return date

def getMonthSetup(db):
    cursor = db.cursor()
    cursor.execute("SELECT DATE FROM dateSetup")
    month = cursor.fetchone()
    month = month[0]
    month = month[5] + month[6]
    return month

def getYearSetup(db):
    cursor = db.cursor()
    cursor.execute("SELECT DATE FROM dateSetup")
    year = cursor.fetchone()
    year = year[0]
    year = year[0] + year[1] + year[2] + year[3]
    return year

def getHourSetup(db):
    cursor = db.cursor()
    cursor.execute("SELECT TIME FROM dateSetup")
    time = cursor.fetchone()
    hour = time[0]
    hour = hour[0] + hour[1]
    return hour

def getMinuteSetup(db):
    cursor = db.cursor()
    cursor.execute("SELECT TIME FROM dateSetup")
    time = cursor.fetchone()
    minute = time[0]
    minute = minute[3] + minute[4]
    return minute

def getChangedSetup(db):
    cursor = db.cursor()
    cursor.execute("SELECT CHANGED FROM dateSetup")
    changed = cursor.fetchone()
    changed = changed[0]
    return changed

def setupTime(db):
    if (getChangedSetup(db)):
	cursor = db.cursor()
	cursor.execute("UPDATE dateSetup SET CHANGED=0 WHERE ID=1")
	db.commit()
	second = 0
	minute = int(getMinuteSetup(db))
	hour = int(getHourSetup(db))
	day = int(getDaySetup(db))
	date = int(getDateSetup(db))
	month = int(getMonthSetup(db))
	year = int(getYearSetup(db)) % 100
	rtc.write_all(second, minute, hour, day, date , month, year)

#Function to print the time to LCD	    
def showTime_LCD():
    day = getDay(rtc._read_day())
    year = getYear(rtc._read_year())
    date = rtc._read_date()
    month = rtc._read_month()
    time = "%s %02d-%02d-%04d" % (day, date, month, year)
    myLcd.lcd_display_string(time, 1, 1)
    hour = rtc._read_hours()
    min = rtc._read_minutes()
    sec = rtc._read_seconds()
    time = "%02d:%02d:%02d" % (hour, min, sec)
    myLcd.lcd_display_string(time, 2, 4)

#Setup timing functions
def getType_exe():				#get type to execute
    global rowNumber
    listType = getSavedType(db)
    rowType = listType[number]
    return rowType[0]

def getDevice_exe():				#get device to execute
    global rowNumber
    listDevice = getSavedDevice(db)
    rowDevice =listDevice[rowNumber]
    return rowDeviec[0]


db = sql_connect()
setupTime(db)
showTime_LCD()
