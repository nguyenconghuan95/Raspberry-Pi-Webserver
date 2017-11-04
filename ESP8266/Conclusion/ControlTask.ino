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
  delay(100);
  while (client.available()) {
    String line = client.readStringUntil('\r');
    if (String(line[1]) == String("[")) {
      String data = line;
      Serial.println(data);
    }
  }
}
