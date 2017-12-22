//Enable 74hc4051 to low
//3.3V for humid sensor


#include <ArduinoJson.h>
#include <Ticker.h>
#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <Wire.h>
#include <BH1750.h>
#include "Define.h"
#include "LCD.h"
#include "EEPROMHandle.h"

Ticker sysTick;

BH1750 lightMeterZone1;
BH1750 lightMeterZone2(0x5C);
DynamicJsonBuffer jsonBuffer;
//EEPROMHandle EHandle;

//char* ssid;
//char* password;
const char* host = "192.168.1.27";

volatile bool flagMeasure = 0;
volatile bool flagControl = 0;
volatile bool flagBackLight = 0;
volatile bool flagTimeOffBackLight = 0;
uint16_t measureTaskCount;
char controlTaskCount;

volatile unsigned long lastDebouncedTime = 0; 
volatile unsigned long startCountingTime;

String dataControl[10];

void setup() {
  bool newFlag = 0;
  Serial.begin(115200);   //Mở cổng Serial ở mức 115200
  //Set up I2C BH1750
  Wire.begin();
  lcd_init();

  Serial.println();
  Serial.println("Do you want to reset?");
  int currentTime = millis();
  while (millis() - currentTime < 5000)
  {
    char res = getChar();
    if (res == 'y' || res == 'Y') {
      newFlag = 1;
      break;
    }
    else if (res == 'n' || res == 'N') {
      break;
    }
  }
  if (newFlag == 1)
    configureNewWifi();
  else
    configureOldWifi();
  configureMeasure();
  DoControlFirstTime();
  
  //Kết nối với mạng wifi chung
//  Serial.println();
//  Serial.println();
//  Serial.print("Ket noi toi mang wifi ");
//  Serial.println(ssid);
//  lcd_write_str(0, 0, "Connect to Miki1");
//  WiFi.begin(ssid, password);
//  while (WiFi.status() != WL_CONNECTED) {
//    delay(500);
//    Serial.print(".");
//  }
//  lcd_write_str(0, 1, "Connected");
//  Serial.println();
//  Serial.print("IP address: ");
//  Serial.println(WiFi.localIP());
  sysTick.attach(SEQ_TIME_TICKER_SEC, tickHandler);
  delay(2000);
  lcd_clear_display();  
}

void tickHandler() 
{
  measureTaskCount++;
  controlTaskCount++;
  if (measureTaskCount >= MEASURE_TASK_PERIOD) {
    flagMeasure = 1;
  }
  if (controlTaskCount >= CONTROL_TASK_PERIOD) {
    flagControl = 1;
  }
}

//void configureButtonDisplay()
//{
//  pinMode(DISPLAY_PIN, INPUT);
//  attachInterrupt(digitalPinToInterrupt(DISPLAY_PIN), buttonDisplayHandler, HIGH);
//}
//
//void buttonDisplayHandler()
//{
//  if (millis() - lastDebouncedTime > DEBOUNCE_DELAY) {
//    flagBackLight = 1;
//    flagTimeOffBackLight = 1;
//  }
//  lastDebouncedTime = millis();
//}

void lcd_timing_backlight(int timeOff_s)
{
  uint16_t timeOff_ms = timeOff_s * 1000;
  if (flagTimeOffBackLight == 1) {
    lcd_onBacklight();
    startCountingTime = millis();
    flagTimeOffBackLight = 0;
  }
  if (millis() - startCountingTime >= timeOff_ms) {
    lcd_offBacklight();
    flagBackLight = 0;
    startCountingTime = 0;
  }
}

void loop() {
  if (flagMeasure == 1) {
    lcd_onBacklight();
    lcd_clear_display();
    flagBackLight = 1;
    flagTimeOffBackLight = 1;
    
    //Measure in Zone 1, display LCD and send the values to server
    int humidValue = measure(1, HUMID_PIN);
    uint16_t luxValue = measure(1, LUX_PIN);
    int tempValue = measure(1, TEMP_PIN);
    lcd_display_measure(1, tempValue, humidValue, luxValue);
    passValues(1, humidValue, luxValue, tempValue);
    
    //Measure in Zone 2, display LCD and send the values to server
    humidValue = measure(2, HUMID_PIN);
    luxValue = measure(2, LUX_PIN);
    tempValue = measure(2, TEMP_PIN);
    lcd_display_measure(2, tempValue, humidValue, luxValue);
    passValues(2, humidValue, luxValue, tempValue);

    flagMeasure = 0;
    measureTaskCount = 0;
  }
  if (flagBackLight == 1) {
    lcd_timing_backlight(5);
  }
  if (flagControl == 1) {
    DoControl();
    flagControl = 0;
    controlTaskCount = 0;
  }
}
