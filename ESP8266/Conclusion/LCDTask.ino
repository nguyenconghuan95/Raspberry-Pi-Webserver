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

