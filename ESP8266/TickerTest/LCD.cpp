#include "LCD.h"

LiquidCrystal_I2C lcd(0x27, 16, 2);

void lcd_init() {
  lcd.init();
  lcd.begin(16, 2);
  lcd.backlight();
  lcd.display();
  lcd.noCursor();
  lcd.clear();
}

void lcd_display_measure(int zone, int temp, int humid, uint16_t lux) {  
  lcd.backlight();
  lcd.setCursor(0, zone - 1);
  String str = String(zone) + (char)20 + String(temp) + (char)223 + "C " + String(humid) + "% " + String(lux) + "Lx";
  lcd.print(str); 
}

void lcd_display_wifiSetup()
{
  lcd.setCursor(0, 0);
  lcd.print("SSID: ");
  lcd.setCursor(0, 1);
  lcd.print("Pass: ");
}

void lcd_write_oneChar(int pos, int row, char symbol)
{
  lcd.setCursor(pos, row);
  lcd.print(symbol);
}

void lcd_delete_oneChar(int pos, int row)
{
  lcd.setCursor(pos, row);
  lcd.print(" ");
}

void lcd_onBacklight() {
  lcd.backlight();
}

void lcd_scrollLeft() 
{
  lcd.scrollDisplayLeft();
}

void lcd_offBacklight() {
  lcd.noBacklight();
}


