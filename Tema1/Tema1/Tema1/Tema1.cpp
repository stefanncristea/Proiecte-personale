#include "BackTracking.h"
#include "BFS.h"
#include "Hill.h"
#include "AStar.h"
#include <iostream>
using namespace std;



int main()
{
    int n, m, k, optiune;
    cout << "Introduceti cantitatea dorita pentru primul vas: ";
    cin >> n;
    cout << "Introduceti cantitatea dorita pentru al doilea vas: ";
    cin >> m;
    cout << "Introduceti cantitatea dorita in unul din cele doua vase: ";
    cin >> k;
    BFS a;
    //a.Algorithm(n, m, k);
    BackTracking b;
    //b.BKT(n, m, k);
    Hill c;
    //c.HillClimbing(n, m, k);
    AStar d;
    //d.AStelat(n, m, k);
    cout << endl << "Alegeti algoritmul pe care doriti sa-l aplicati:" << endl;
    cout << "->BFS" << endl << "->BackTracking" << endl << "->HillClimbing" << endl << "->A*" << endl;
    cout << "Observatie! Ca sa iesiti introduceti 0"<<endl;
    cin >> optiune;
    while (optiune != 0 && optiune < 5)
    {
        if(optiune == 1)
            a.Algorithm(n, m, k);
        if(optiune == 2)
            b.BKT(n, m, k);
        if(optiune == 3)
            c.HillClimbing(n, m, k);
        if(optiune == 4)
            d.AStelat(n, m, k);
        cout << endl << "Alegeti algoritmul pe care doriti sa-l aplicati:" << endl;
        cout << "->BFS" << endl << "->BackTracking" << endl << "->HillClimbing" << endl << "->A*" << endl;
        cout << "Observatie! Ca sa iesiti introduceti 0" << endl;
        cin >> optiune;
    }
}


