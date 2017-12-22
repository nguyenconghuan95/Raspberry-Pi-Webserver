#ifndef __EEPROM_HANDLE_H__
#define __EEPROM_HANDLE_H__

#include "Arduino.h"
#include "EEPROM.h"
#include "Define.h"

class EEPROMHandle
{
  public:
    EEPROMHandle();
    String readDataFromEEPROM(int pos, int num);
    String readDataFromEEPROM(int pos, char stopChar);
    void writeDataToEEPROM(int pos, String data);
    void writeDataToEEPROM(int pos, String data, int length);
    void clearEEPROM();
};

extern EEPROMHandle EHandle;

#endif


