/*******************************************************************************
 *  Các Key từ 1-9 và '*' và '#' tương ứng với các giá trị từ 0-11             *
 *  Character từng Key nằm trong mảng với thứ tự tương ứng với giá trị của Key *
 *******************************************************************************/

enum State {PUSHED, ON_HOLD, UNPUSHED};

int readKeyPushed()
{
  int value = analogRead(A0);
  if (value >= MIN_VALUE_KEY_0 && value <= MAX_VALUE_KEY_0)
    return 0;
  else if (value >= MIN_VALUE_KEY_1 && value <= MAX_VALUE_KEY_1)
    return 1;
  else if (value >= MIN_VALUE_KEY_2 && value <= MAX_VALUE_KEY_2)
    return 2;
  else if (value >= MIN_VALUE_KEY_3 && value <= MAX_VALUE_KEY_3)
    return 3;
  else if (value >= MIN_VALUE_KEY_4 && value <= MAX_VALUE_KEY_4)
    return 4;
  else if (value >= MIN_VALUE_KEY_5 && value <= MAX_VALUE_KEY_5)
    return 5;
  else if (value >= MIN_VALUE_KEY_6 && value <= MAX_VALUE_KEY_6)
    return 6;
  else if (value >= MIN_VALUE_KEY_7 && value <= MAX_VALUE_KEY_7)
    return 7;
  else if (value >= MIN_VALUE_KEY_8 && value <= MAX_VALUE_KEY_8)
    return 8;
  else if (value >= MIN_VALUE_KEY_9 && value <= MAX_VALUE_KEY_9)
    return 9;
  else if (value >= MIN_VALUE_KEY_STAR && value <= MAX_VALUE_KEY_STAR)
    return 10;
  else if (value >= MIN_VALUE_KEY_HASH && value <= MAX_VALUE_KEY_HASH)
    return 11;
  else
    return NULL;
}

int numberOfElementsIn(char k[][9], int row) 
{
  int count = 0;
  while (k[row][count] != NULL) {
    count++;
  }
  return count;
}

int getChar()
{
  int incomingByte;
  if (Serial.available() > 0) {
                // đọc chữ liệu
                incomingByte = Serial.read();

                // trả về những gì nhận được
                Serial.print("Toi nhan duoc: ");
                if (incomingByte == -1) {
                  Serial.println("Toi khong nhan duoc gi ca");
                  return NULL;
                } else  {
                  Serial.println(char(incomingByte));
                  return incomingByte;
                }
        }
//  unsigned long lastPushTime = millis();
//  int valueKey = readKeyPushed();
//  char realChar;
//
//  char Char[12][9] = {{0x20, '0'},
//                      {'1', '!', '@', '$', '%', '^', '&', '?', '~'},
//                      {'a', 'b', 'c', '2'},
//                      {'d', 'e', 'f', '3'},
//                      {'g', 'h', 'i', '4'},
//                      {'j', 'k', 'l', '5'},
//                      {'m', 'n', 'o', '6'},
//                      {'p', 'q', 'r', 's', '7'},
//                      {'t', 'u', 'v', '8'},
//                      {'w', 'x', 'y', 'z', '9'},
//                      {0x7F, 0x10, '*'},
//                      {'#', 0x0D}};
//
//  int i = valueKey;
//  int j = 0;
//  if (valueKey != NULL) {
//    State buttonState = PUSHED;
//    realChar = Char[i][j];
//    buttonState = ON_HOLD;
//    while (millis() - lastPushTime < ONEKEY_PUSH_PERIOD) {
//      delay(100);
//      valueKey = readKeyPushed();
//      switch (buttonState) {
//        case PUSHED:
//        {
//          if (valueKey == i) {
//            lastPushTime = millis();
//            (j < numberOfElementsIn(Char, i)) ? j++ : j=0;
//            realChar = Char[i][j];
//          }
//          buttonState = ON_HOLD;
//          break;
//        }
//        case ON_HOLD:
//        {
//          if (valueKey == NULL)
//            buttonState = UNPUSHED;
//          break;
//        }
//        case UNPUSHED:
//        {
//          if (valueKey != NULL)
//            buttonState = PUSHED;
//          break;
//        }
//     }
//     if ((valueKey != i) && (valueKey != NULL))
//       break;     
//    }
//    return realChar;
//  }
//  else
//    return NULL;
}

