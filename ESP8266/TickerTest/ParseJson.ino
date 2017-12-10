void parseJson(String input, char startSymbol, char stopSymbol)
{
  int datalength = input.length();
  bool dataGet = 0;
  int dataNum = 0;
  for(int i = 0; i < datalength; i++) {
    if (input[i] == startSymbol) {
       dataGet = 1;
    }
    else if (input[i] == stopSymbol) {
      dataGet = 0;
      dataControl[dataNum] += input[i];
      dataNum++;
    }
    if (dataGet == 1) {
      dataControl[dataNum] += input[i];
    }
  }
}



