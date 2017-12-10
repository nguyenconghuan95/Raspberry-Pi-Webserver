#ifndef _LCD_H_
#define _LCD_H

#include <LiquidCrystal_I2C.h>



void lcd_init();
void lcd_display_measure(int zone, int temp, int humid, uint16_t lux);
void lcd_onBacklight();
void lcd_offBacklight();
void lcd_display_wifiSetup();
void lcd_write_oneChar(int pos, int row, char symbol);
void lcd_delete_oneChar(int pos, int row);
void lcd_scrollLeft() ;


#endif
