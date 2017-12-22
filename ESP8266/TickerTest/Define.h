#ifndef __DEFINE_H__
#define __DEFINE_H__

#define ANALOG_PIN            A0
#define SELECT_PIN0           1
#define SELECT_PIN1           3
#define SELECT_PIN2           15
//#define DISPLAY_PIN           15
#define HUMID_PIN             0x01
#define TEMP_PIN              0x02
#define LUX_PIN               0x03


#define MIN_VALUE_KEY_0       710
#define MAX_VALUE_KEY_0       770     
#define MIN_VALUE_KEY_1       90
#define MAX_VALUE_KEY_1       94 
#define MIN_VALUE_KEY_2       96
#define MAX_VALUE_KEY_2       100
#define MIN_VALUE_KEY_3       102
#define MAX_VALUE_KEY_3       107  
#define MIN_VALUE_KEY_4       122
#define MAX_VALUE_KEY_4       127
#define MIN_VALUE_KEY_5       136
#define MAX_VALUE_KEY_5       140  
#define MIN_VALUE_KEY_6       150
#define MAX_VALUE_KEY_6       154
#define MIN_VALUE_KEY_7       196
#define MAX_VALUE_KEY_7       200
#define MIN_VALUE_KEY_8       226
#define MAX_VALUE_KEY_8       230
#define MIN_VALUE_KEY_9       267
#define MAX_VALUE_KEY_9       271
#define MIN_VALUE_KEY_HASH    1020  
#define MAX_VALUE_KEY_HASH    1024 
#define MIN_VALUE_KEY_STAR    470
#define MAX_VALUE_KEY_STAR    485
#define NUMBER_OF_KEYS        12

#define SEQ_TIME_TICKER_SEC   1
#define ONEKEY_PUSH_PERIOD    2000
#define DEBOUNCE_DELAY        8000
#define MEASURE_TASK_PERIOD   20
#define CONTROL_TASK_PERIOD   2

#define EEPROM_SIZE           512
#define SSID_ADDR_START       1
#define SSID_ADDR_LENGTH      32
#define PASS_ADDR_START       35
#define PASS_ADDR_LENGTH      64
#define EMPTY_CHAR            '*'

#endif
