uint16_t measure(int zone, char pinType) {
  
  char pinValue = pinType + (zone-1)*3;
  digitalWrite(SELECT_PIN0, pinValue && 0x01);
  digitalWrite(SELECT_PIN1, (pinValue && 0x02) >> 1);
  digitalWrite(SELECT_PIN2, (pinValue && 0x04) >> 2);
  if (pinType == HUMID_PIN) {
    int value = analogRead(ANALOG_PIN);     // Ta sẽ đọc giá trị hiệu điện thế của cảm biến
    int percent = map(value, 1023, 0, 0, 100);
    Serial.print("Do am do duoc Zone " + String(zone) + ":");
    Serial.print(percent);//Xuất ra serial Monitor
    Serial.println("%");
    return percent;
  }
  else if (pinType == TEMP_PIN) {
    int value = analogRead(ANALOG_PIN);
    Serial.print("Nhiet do do duoc Zone " + String(zone) + ":");
    Serial.println(value);
    return value;
  }
  else if (pinType == LUX_PIN) {
    uint16_t lux;
    switch(zone) {
      case 1:
        lux = lightMeterZone1.readLightLevel();
        break;
      case 2:
        lux = lightMeterZone2.readLightLevel();
        break;
      default:
        break;      
    }
    Serial.print("Anh sang do duoc Zone " + String(zone) + ":");
    Serial.print(lux);
    Serial.println(" lx");
    return lux;
  }
}

void passValues(int zone, int humid, uint16_t lux, int temp) {
  Serial.print("Ket noi toi web ");
  Serial.println(host);
  WiFiClient client;
  const int httpPort = 80;
  if(!client.connect(host,httpPort)) {
    Serial.println("Khong the ket noi toi!!!");
  }
  String url = "/saveMeasurement.php?zone=" + String(zone) + "&humid=" + String(humid) + "&lux=" + String(lux) + "&temp=" + String(temp);
  Serial.println(url);
  client.print(String("GET " + url + " HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "Connection: close\r\n\r\n"));
}


