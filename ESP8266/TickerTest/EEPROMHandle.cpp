#include "EEPROMHandle.h"

EEPROMHandle EHandle;

EEPROMHandle::EEPROMHandle()
{
}

String EEPROMHandle::readDataFromEEPROM(int pos, int num)
{
    String result = "";

    Serial.println("EEPROM reading from position " + pos);
    if (pos < 0 || pos > EEPROM_SIZE || (pos + num) > EEPROM_SIZE)
    {
        Serial.println("Oversize");
        return "";
    }
    else
    {
        for (int i = 0; i < num; i++)
            result += char(EEPROM.read(pos + i));
        Serial.println(result);
    }
    Serial.print("  >>> Done! Have read ");
    Serial.print(num);
    Serial.println("bytes");
    return result;
}

String EEPROMHandle::readDataFromEEPROM(int pos, char stopChar)
{
    String result;
    char cmp_char;
    int step = pos;

    Serial.println("EEPROM reading (stopChar) from position " + pos);
    if (pos < 0 || pos > EEPROM_SIZE)
    {
        Serial.println("Oversize");
        return "";
    }
    else
    {
        while (cmp_char != stopChar)
        {
            cmp_char = char(EEPROM.read(step++));
            result += cmp_char;
        }
        result.remove(result.length() - 1);
        Serial.println(result);
    }
    Serial.print("  >>> Done! Have read ");
    Serial.print(result.length());
    Serial.print("bytes until ");
    Serial.print(stopChar);
    Serial.println("character");
    return result;
}

void EEPROMHandle::writeDataToEEPROM(int pos, String data)
{
    int dataLength;

    dataLength = data.length();
    Serial.println("EEPROM writing from position " + pos);
    if (pos < 0 || pos > EEPROM_SIZE || (pos + dataLength) > EEPROM_SIZE)
    {
        Serial.println("Oversize");
    }
    else
    {
        for (int i = 0; i < dataLength; i++)
        {
            EEPROM.write(pos + i, data[i]);
            Serial.println(data[i]);
        }
        EEPROM.commit();
        Serial.print("  >>> Done! Have written ");
        Serial.print(dataLength);
        Serial.println(" bytes");
    }
}
void EEPROMHandle::writeDataToEEPROM(int pos, String data, int length)
{
    int dataLength;
    int lengthMin;

    dataLength = data.length();
    lengthMin = (length > dataLength) ? dataLength : length;
    Serial.println("EEPROM writing (length) from position " + pos);
    if (pos < 0 || pos > EEPROM_SIZE || (pos + length) > EEPROM_SIZE)
    {
        Serial.println("Oversize");
    }
    else
    {
        for (int i = 0; i < lengthMin; i++)
        {
            EEPROM.write(pos + i, data[i]);
            Serial.println(data[i]);
        }
        for (int i = lengthMin; i < length; i++)
        {
            EEPROM.write(pos + i, EMPTY_CHAR);
            Serial.println(EMPTY_CHAR);
        }
        EEPROM.commit();
        Serial.print("  >>> Done! Have written ");
        Serial.print(dataLength);
        Serial.println("bytes");
    }
}
void EEPROMHandle::clearEEPROM()
{
    Serial.println("\nClear EEPROM -> ");
    writeDataToEEPROM(0, "", EEPROM_SIZE);
}



