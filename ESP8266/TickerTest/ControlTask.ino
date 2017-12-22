void DoControlFirstTime()
{
  String data;
  int i;
  Serial.print("Ket noi toi web: ");
  Serial.println(host);
  WiFiClient client;
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) {
    Serial.println("Khong the ket noi toi " + String(host));
  }
  String url = "/getControl.php?first";
  client.print(String("GET " + url + " HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "Connection: close\r\n\r\n"));
  delay(100);
  while (client.available()) {
    String line = client.readStringUntil('\n');
    if (String(line[0]) == String("[")) {
      data = line;
      Serial.println(data);
    }
  }
  memset(dataControl, '\0', 10);
  parseJson(data, '{', '}');
  
  for (i=0; i<10 && dataControl[i].length() > 2; i++) {
    JsonObject& root = jsonBuffer.parseObject(dataControl[i]);
    String device = root["LED"];
    String state = root["STATUS"];
    switch_device(device, state);
    Serial.println("Turned " + state + " " + device + "!!!");
  }
  
}

void DoControl()
{
  String data;
  int i;
  Serial.print("Ket noi toi web: ");
  Serial.println(host);
  WiFiClient client;
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) {
    Serial.println("Khong the ket noi toi " + String(host));
  }
  String url = "/getControl.php";
  client.print(String("GET " + url + " HTTP/1.1\r\n" + "Host: " + host + "\r\n" + "Connection: close\r\n\r\n"));
  delay(100);
  while (client.available()) {
    String line = client.readStringUntil('\n');
    if (String(line[0]) == String("[")) {
      data = line;
      Serial.println(data);
    }
  }
  for (i=0; i<10; i++) {
    memset(&dataControl[i], '\0', dataControl[i].length());
  }
  parseJson(data, '{', '}');
  for (i=0; i<10 && dataControl[i].length() > 2; i++) {
    Serial.println(dataControl[i]);
    JsonObject& root = jsonBuffer.parseObject(dataControl[i]);
    String device = root["LED"];
    String state = root["STATUS"];
    switch_device(device, state);
    Serial.println("Turned " + state + " " + device + "!!!");
  }
}

void switch_device(String deviceName, String state) 
{
  int pin;
  int value;
  if (deviceName == "light1") pin=2;
  else if( deviceName == "light2") pin=13;
  else if (deviceName == "hose1") pin=16;
  else if (deviceName == "hose2") pin=14;
  else if (deviceName == "sunshade1") pin=0;
  else if (deviceName == "sunshade2") pin=12;
    
  if(state == "On") value=LOW;
  else if(state == "Off") value=HIGH;
  
  digitalWrite(pin, value);
}

