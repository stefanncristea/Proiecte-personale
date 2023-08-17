#include "BFS.h"
#include <queue>
#include <iostream>
using namespace std;

struct drum
{
    int cantn, cantm, nr, calen[1000], calem[1000];
};

void BFS::tranzit(drum& actual, int decizie, int n, int m)
{
    //turnam pe jos primul vas
    if (decizie == 1)
    {
        actual.nr++;
        actual.cantn = 0;
        actual.calen[actual.nr] = 0;
        actual.calem[actual.nr] = actual.cantm;
    }

    //turnam pe jos al doilea vas
    if (decizie == 2)
    {
        actual.nr++;
        actual.cantn = 0;
        actual.calen[actual.nr] = 0;
        actual.calem[actual.nr] = actual.cantm;
    }

    //turnam din primul in al doilea
    if (decizie == 3)
    {
        actual.nr++;
        if (actual.cantm + actual.cantn > m)
        {
            int var = m - actual.cantm;
            actual.cantm = m;
            actual.cantn -= var;
        }
        else
        {
            actual.cantm += actual.cantn;
            actual.cantn = 0;
        }
        actual.calen[actual.nr] = actual.cantn;
        actual.calem[actual.nr] = actual.cantm;
    }

    //turnam al doilea vas in primul
    if (decizie == 4)
    {
        actual.nr++;
        if (actual.cantn + actual.cantm > n)
        {
            int var = n - actual.cantn;
            actual.cantn = n;
            actual.cantm -= var;
        }
        else
        {
            actual.cantn += actual.cantm;
            actual.cantm = 0;
        }
        actual.calen[actual.nr] = actual.cantn;
        actual.calem[actual.nr] = actual.cantm;
    }

    //umplem primul vas
    if (decizie == 5)
    {
        actual.nr++;
        actual.cantn = n;
        actual.calen[actual.nr] = n;
        actual.calem[actual.nr] = actual.cantm;
    }

    //umplem al doilea vas
    if (decizie == 6)
    {
        actual.nr++;
        actual.cantm = m;
        actual.calem[actual.nr] = m;
        actual.calen[actual.nr] = actual.cantn;
    }
}


void BFS::Algorithm(int n, int m, int k)
{

    bool visited[1000][1000] = { 0 };

    queue <drum> q;
    int gasit = 0, nrmetode = 0;
    drum act;
    act.cantn = 0;
    act.cantm = 0;
    visited[0][0] = 1;
    act.nr = 1;
    act.calen[act.nr] = 0;
    act.calem[act.nr] = 0;
    q.push(act);
    while (q.empty() == false)
    {
        int stop = 0;
        drum actual = q.front();
        if (actual.cantn == k || actual.cantm == k)
        {
            stop = 1;
            nrmetode++;
            cout << "----------Surpriza! S-a gasit o metoda! Iata drumul: ---------" << endl;
            for (int i = 1; i <= actual.nr; i++)
            {
                cout << "Cantitatea ACUM in primul vas N este: " << actual.calen[i] << endl;
                cout << "Cantitatea ACUM in al doilea vas M este: " << actual.calem[i] << endl;
                cout << endl;
            }

        }
        for (int i = 1; i <= 6 && !stop; i++)
        {
            if ((i == 1 && actual.cantn == 0) || (i == 2 && actual.cantm == 0) || (i == 3 && (actual.cantm == m || actual.cantn == 0)) || (i == 4 && (actual.cantn == n || actual.cantm == 0)) || (i == 5 && actual.cantn == n) || (i == 6 && actual.cantm == m))
            {

            }
            else
            {
                drum var = actual;
                tranzit(var, i, n, m);
                if (!visited[var.cantn][var.cantm])
                {
                    visited[var.cantn][var.cantm] = 1;
                    q.push(var);
                }
            }
        }
        q.pop();
    }

    cout << "NUMARUL DE METODE PENTRU A REZOLVA ACEASTA PROBLEMA ESTE: " << nrmetode;
}
