
void configureOldWifi()
{
  String ssidString;
  String passString;
  ssidString = EHandle.readDataFromEEPROM(SSID_ADDR_START, EMPTY_CHAR);
  passString = EHandle.readDataFromEEPROM(PASS_ADDR_START, EMPTY_CHAR);
  Serial.println(ssidString);
  Serial.println(passString);
  lcd_write_str(0, 0, "SSID: " + ssidString);
  lcd_write_str(0, 1, "Pass: " + passString);
  delay(2000);
  char ssid[ssidString.length()+1];
  char password[passString.length()+1];
  ssidString.toCharArray(ssid, ssidString.length()+1);
  passString.toCharArray(password, passString.length()+1);
  connectWifi(ssid, password);
}

void configureNewWifi()
{
//  char* ssid = "Miki1";
//  char* password = "nghi123lun";
  String ssidString;
  String passString;
  ssidString = getSSID();
  passString = getPass();
  char ssid[ssidString.length()+1];
  char password[passString.length()+1];
  ssidString.toCharArray(ssid, ssidString.length()+1);
  passString.toCharArray(password, passString.length()+1);
  Serial.println(ssidString);
  Serial.println(passString);
  EHandle.clearEEPROM();
  EHandle.writeDataToEEPROM(SSID_ADDR_START, ssidString);
  EHandle.writeDataToEEPROM(PASS_ADDR_START, passString);
  connectWifi(ssid, password);  
}

void connectWifi(char* ssid, char* password)
{
  Serial.println();
  Serial.println();
  Serial.print("Ket noi toi mang wifi ");
  Serial.println(ssid);
  lcd_clear_display();
  lcd_write_str(0, 0,"Connecting...");
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  lcd_write_str(0, 1, "Connected");
  delay(2000);
  lcd_clear_display();
  Serial.println();
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());  
}

void display_LCD_SSID(String ssid)
{
  String ssidDisplay = "";
  String ssidDisplayPrefix = "SSID: ";
  if (ssid.length()<= 10) {
    ssidDisplay = ssidDisplayPrefix + ssid; 
  }
  else {
    int startPos = ssid.length() - 10;
    for (int i=startPos; i<ssid.length(); i++) {
      ssidDisplay = ssidDisplayPrefix + ssid[i];
    }
  }
  displaySSID(ssidDisplay);  
}

void displaySSID(String str)
{
  lcd_write_str(0, 0, str);
}

String getSSID()
{
  char space = ' ';
  String ssidString = "";
  String ssidDisplay = "";
  String ssidDisplayPrefix = "SSID: ";
  bool enterFlag = 0;
  lcd_clear_display();
  displaySSID(ssidDisplayPrefix);
  while(!enterFlag) {
    char character = char(getChar());
//    if (character != NULL) {
//      int ssidLength = ssidString.length();
//      switch(character)
//      {
//        case 0x10:
//                ssidString[ssidLength-1] = (char)(ssidString[ssidLength-1] & 0x5F);
//                display_LCD_SSID(ssidString);
//                break;
//        case 0x7F:
//                ssidString.remove(ssidLength-1);
//                lcd_clear_display();
//                display_LCD_SSID(ssidString);
//                break;
//        case 0x0D:
//                enterFlag = 1;
//                break;
//        case 0x20:
//                ssidString += space;
//                display_LCD_SSID(ssidString);
//                break;
//        default:
//                ssidString += character;
//                display_LCD_SSID(ssidString);
//      }
//    }

if (character != NULL) {
  if (character == '|') {
    enterFlag = 1;
  }
  else {
  ssidString += character;
  Serial.println(ssidString);
  display_LCD_SSID(ssidString);
  }
}

    yield();
  }
//  char ssid[ssidString.length()+1];
//  ssidString.toCharArray(ssid, ssidString.length()+1);
  return ssidString;
}

void display_LCD_Pass(String pass)
{
  String passDisplay = "Pass: ";
  if (pass.length()<= 10) {
    for (int i=0; i<pass.length(); i++) {
      passDisplay = passDisplay + pass[i];
    } 
  }
  else {
    for (int i=0; i<10; i++) {
      passDisplay = passDisplay + '*';
    }
  }
  displayPass(passDisplay);  
}

void displayPass(String str)
{
  lcd_write_str(0, 1, str);
}

String getPass()
{
  char space = ' ';
  String passString = "";
  String passPrefix = "Pass: ";
  bool enterFlag = 0;
//  lcd_clear_display();
  displayPass(passPrefix);
  while(!enterFlag) {
    char character = char(getChar());
//    if (character != NULL) {
//      int passLength = passString.length();
//      switch(character)
//      {
//        case 0x10:
//                passString[passLength-1] = (char)(passString[passLength-1] & 0x5F);
//                display_LCD_Pass(passString);
//                break;
//        case 0x7F:
//                passString.remove(passLength-1);
//                lcd_clear_display();
//                display_LCD_Pass(passString);
//                break;
//        case 0x0D:
//                enterFlag = 1;
//                break;
//        case 0x20:
//                passString += space;
//                display_LCD_Pass(passString);
//                break;
//        default:
//                passString += character;
//                display_LCD_Pass(passString);
//      }
//    }
    if (character != NULL) {
  if (character == '|') {
    enterFlag = 1;
  }
  else {
  passString += character;
  Serial.println(passString);
  display_LCD_Pass(passString);
  }
    yield();
  }
  }
  
//  char pass[passString.length()+1];
//  passString.toCharArray(pass, passString.length()+1);
  return passString;
}


