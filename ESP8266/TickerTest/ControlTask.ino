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

void switch_device(String deviceName, String state) 
{
  int pin;
  int value;
  if (deviceName == "light1") pin=12;
  else if( deviceName == "light2") pin=13;
  else if (deviceName == "hose1") pin=14;
  else if (deviceName == "hose2") pin=15;
  else if (deviceName == "sunshade1") pin=1;
  else if (deviceName == "sunshade2") pin=3;
    
  if(state == "On") value=HIGH;
  else if(state == "Off") value=LOW;
  
  digitalWrite(pin, value);
}

