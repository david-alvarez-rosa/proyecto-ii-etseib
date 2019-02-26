#include <iostream>
#include <vector>

using namespace std;

using VI = vector<int>;
using VVI = vector<VI>;


VVI table(3, VI(3,  -1));


void printMatrix() {
  for (int i = 0; i < 3; ++i) {
    for (int j = 0; j < 3; ++j) {
      if (table[i][j] == 1)
        cout << "O";
      else if (table[i][j] == 0)
        cout << "X";
      else
        cout << "·";
    cout << " \t";
    }
    cout << endl;
  }
}


int main() {
  cout << "Comienzo del juego:" << endl;
  bool finished = false;
  int n = -1;
  cout << table.size() << endl;
  cout << table[2].size() << endl;
  while (not finished) {
    ++n;
    int i; int j;
    if (n%2 == 0) {
      cout << "Jugador A:" << endl;
      cin >> i >> j;

      table[i - 1][j - 1] = 1;
      printMatrix();
      cout << table[2].size() << endl;
    }
    else {
      cout << "Jugador B:" << endl;
      cin >> i >> j;
      table[i - 1][j - 1] = 0;
      printMatrix();
    }
    cout << table[i - 1][j - 1] << endl;
    cout << i << " " << j << endl;

  }
}
