int measure(int zone, char type) {
  char pinValue = type + (zone-1)*3;
  digitalWrite(12, pinValue && 0x01);
  digitalWrite(12, (pinValue && 0x02) >> 1);
  digitalWrite(14, (pinValue && 0x04) >> 2);
  if (type == 0x01) {
    int value = analogRead(A0);     // Ta sẽ đọc giá trị hiệu điện thế của cảm biến
    int percent = map(value, 1023, 0, 0, 100);
    Serial.print("Do am do duoc Zone " + String(zone) + ":");
    Serial.print(percent);//Xuất ra serial Monitor
    Serial.println("%");
    return percent;
  }
  else if (type == 0x02) {
    int value = analogRead(A0);
    Serial.print("Nhiet do do duoc Zone" + String(zone) + ":");
    Serial.println(value);
    return value;
  }
  else if (type == 0x03) {
    uint16_t lux = lightMeter.readLightLevel();
    Serial.print("Anh sang do duoc Zone" + String(zone) + ":");
    Serial.print(lux);
    Serial.println(" lx");
    return lux;
  }
}

