#include <LiquidCrystal_I2C.h>
#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <ESP8266WebServer.h>
#include <Wire.h>
#include <BH1750.h>

#define MeasureTaskPeriod     80
#define GetControlTaskPeriod  2
#define humidPin          0x01
#define tempPin           0x02
#define luxPin            0x03

BH1750 lightMeter;
LiquidCrystal_I2C lcd(0x27, 16, 2);

const char* ssid = "Miki1";
const char* password = "nghi123lun";
const char* host = "192.168.1.27";

bool MeasureTaskFlag = 0;
bool GetControlTaskFlag = 0;
bool LCDTurnOffFlag = 0;
uint16_t MeasureTaskCount = 0;
char GetControlTaskCount = 0; 

void timing(void) 
{
  delay(250);
//  static int LCDTurnOffCount;
  MeasureTaskCount++;
  GetControlTaskCount++;
  if (MeasureTaskCount >= MeasureTaskPeriod) {
    MeasureTaskFlag = 1;
  }
  else if (GetControlTaskCount >= GetControlTaskPeriod) {
    GetControlTaskFlag = 1;
  }
}

void passValues(char zone, int humid, uint16_t lux, int temp) {
  Serial.print("Ket noi toi web ");
  Serial.println(host);
  WiFiClient client;
  const int httpPort = 80;
  if(!client.connect(host,httpPort)) {
    Serial.println("Khong the ket noi toi!!!");
  }
  String url = "/saveMeasurement.php?zone=1&temp=33.21&zone=" + String(zone) + "&humid=" + String(humid) + "&lux=" + String(lux) + "&temp=" + String(temp);
  client.print(String("GET " + url + " HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "Connection: close\r\n\r\n"));
}


void setup() 
{
  Serial.begin(115200);   //Mở cổng Serial ở mức 115200
  //setup chân lấy ADC
  pinMode (12, OUTPUT);
  pinMode(13, OUTPUT);
  pinMode(14, OUTPUT);
  pinMode(A0, INPUT);

  //Set up I2C BH1750
  Wire.begin();
  lightMeter.begin();

  lcd_init();
  
  //Kết nối với mạng wifi chung
  Serial.println();
  Serial.println();
  Serial.print("Ket noi toi mang wifi ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println();
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
}
 
void loop() 
{
  timing();
  //Turn off LCD of measureTask
  lcd_timingOff_backlight(8);
  if (MeasureTaskFlag) {
    
    //Measure in Zone 1, display LCD and send the values to server
    int humidValue = measure(1, humidPin);
    uint16_t luxValue = measure(1, luxPin);
    int tempValue = measure(1, tempPin);
    lcd.clear();
    lcd_display_measure(1, tempValue, humidValue, luxValue);
    passValues(1, humidValue, luxValue, tempValue);
    
    //Measure in Zone 2, display LCD and send the values to server
    humidValue = measure(2, humidPin);
    luxValue = measure(2, luxPin);
    tempValue = measure(2, tempPin);
    lcd_display_measure(2, tempValue, humidValue, luxValue);
    passValues(2, humidValue, luxValue, tempValue);
    
    LCDTurnOffFlag = 1;
    MeasureTaskFlag = 0;
    MeasureTaskCount = 0;    
  }
  else if (GetControlTaskFlag) {
    
  }
}
