#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <ESP8266WebServer.h>
#include <Wire.h>
#include <BH1750.h>

#define MeasureTaskPeriod     2400
#define GetControlTaskPeriod  2
#define FirstZoneHumid        0x01
#define FirstZoneTemp         0x02
#define SecondZoneHumid       0x03
#define SecondZoneTemp        0x04

BH1750 lightMeter;

const char* ssid = "Miki1";
const char* password = "nghi123lun";
const char* host = "192.168.1.27";

bool MeasureTaskFlag = 0;
bool GetControlTaskFlag = 0;
uint16_t MeasureTaskCount = 0;
char GetControlTaskCount = 0; 

//Function timing the other functions
void timing(void) 
{
  delay(250);
  MeasureTaskCount++;
  GetControlTaskCount++;
  if (MeasureTaskCount >= MeasureTaskPeriod) {
    MeasureTaskFlag = 1;
  }
  else if (GetControlTaskCount >= GetControlTaskPeriod) {
    GetControlTaskFlag = 1;
  }
}

//Functions measure the parameter
int measureHumid(char zone) 
{
  if (zone == 1) {
    digitalWrite(12, FirstZoneHumid && 0x01);         
    digitalWrite(13, (FirstZoneHumid && 0x02) >> 1);
    digitalWrite(14, (FirstZoneHumid && 0x04) >> 2); 
  }
  else {
    digitalWrite(12, SecondZoneHumid && 0x01);
    digitalWrite(13, (SecondZoneHumid && 0x02) >> 1);
    digitalWrite(14, (SecondZoneHumid && 0x04) >> 2);
  }
  int value = analogRead(A0);     // Ta sẽ đọc giá trị hiệu điện thế của cảm biến
  int percent = map(value, 1023, 0, 0, 100);
  Serial.print("Do am do duoc: ");
  Serial.print(percent);//Xuất ra serial Monitor
  Serial.println("%");
  return percent;
}

int measureTemp(char zone) 
{
  if (zone == 1) {
    digitalWrite(12, FirstZoneTemp && 0x01);
    digitalWrite(13, (FirstZoneTemp && 0x02) >> 1);
    digitalWrite(14, (FirstZoneTemp && 0x04) >> 2); 
  }
  else {
    digitalWrite(12, SecondZoneTemp && 0x01);
    digitalWrite(13, (SecondZoneTemp && 0x02) >> 1);
    digitalWrite(14, (SecondZoneTemp && 0x04) >> 2);
  }
  int value = analogRead(A0);
  Serial.print("Nhiet do do duoc: ");
  Serial.println(value);
  return value;
}

uint16_t measureLux(char zone) 
{
  uint16_t lux = lightMeter.readLightLevel();
  Serial.print("Light: ");
  Serial.print(lux);
  Serial.println(" lx");
  return lux;
}

void passValues(char zone, int humid, uint16_t lux, int temp) 
{
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

void GetControl()
{
  Serial.print("Ket noi toi web: ");
  Serial.println(host);
  WiFiClient client;
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) {
    Serial.println("Khong the ket noi toi " + String(host));
  }
  String url = "/getControl.php";
  client.print(String("GET " + url + " HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "Connection: close\r\n\r\n"));
  while (client.available()) {
    String line = client.readStringUntil('\r');
    Serial.println(line); 
  }
}

void setup() 
{
  Serial.begin(115200);//Mở cổng Serial ở mức 115200
  //setup chân lấy ADC
  pinMode (12, OUTPUT);
  pinMode(13, OUTPUT);
  pinMode(14, OUTPUT);
  pinMode(A0, INPUT);

  //Set up I2C BH1750
  Wire.begin();
  lightMeter.begin();
  
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
  if (MeasureTaskFlag) {
    int humidValue = measureHumid(1);
    uint16_t luxValue = measureLux(1);
    int tempValue = measureTemp(1);
    passValues(1, humidValue, luxValue, tempValue);
    passValues(2, humidValue, luxValue, tempValue);
    MeasureTaskFlag = 0;
    MeasureTaskCount = 0;    
  }
  else if (GetControlTaskFlag) {
    
  }
}
