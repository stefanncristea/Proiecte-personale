#include "BackTracking.h"
#include <iostream>
#include <vector>
using namespace std;

int BackTracking::tranzitie(int n, int m, int pas, int& cantn, int& cantm)
{
    //incercam sa umplem primul vas
    if (pas == 1)
    {
        if (cantn == n)
            return 0;
        else
        {
            cantn = n;
            return 1;
        }
    }

    //incercam sa umplem al doilea vas
    if (pas == 2)
    {
        if (cantm == m)
            return 0;
        else
        {
            cantm = m;
            return 1;
        }
    }

    //incercam sa mutam din primul in al doilea
    if (pas == 3)
    {
        if (cantm == m || cantn == 0)
            return 0;
        else
        {
            if (cantn + cantm > m)
            {
                int var = m - cantm;
                cantm = m;
                cantn -= var;
            }
            else
            {
                cantm += cantn;
                cantn = 0;
            }
            return 1;
        }
    }

    //incercam sa mutam din al doilea vas in primul
    if (pas == 4)
    {
        if (cantn == n || cantm == 0)
            return 0;
        else
        {
            if (cantn + cantm > n)
            {
                int var = n - cantn;
                cantn = n;
                cantm -= var;
            }
            else
            {
                cantn += cantm;
                cantm = 0;
            }
            return 1;
        }
    }

    //incercam sa golim primul vas
    if (pas == 5)
    {
        if (cantn == 0)
            return 0;
        else
        {
            cantn = 0;
            return 1;
        }
    }

    //incercam sa golim al doilea vas
    if (pas == 6)
    {
        if (cantm == 0)
            return 0;
        else
        {
            cantm = 0;
            return 1;
        }
    }
}

void BackTracking::Back(int n, int m, int k, int ok, int cantn, int cantm, vector<pair<int, int>> v, bool visit[][1000])
{

    if (ok == 0)
        return;
    if (visit[cantn][cantm] == 1)
        return;
    else
        visit[cantn][cantm] = 1;
    if (cantn == k || cantm == k)
    {
        cout << "HAHAH TE-AM GASIT!" << endl << cantn << " " << cantm << endl;
        for (vector<pair<int, int> >::iterator i = v.begin(); i != v.end(); i++)
        {
            cout << "Cantitatea ACUM in primul vas N este: " << i->first << endl;
            cout << "Cantitatea ACUM in al doilea vas M este: " << i->second << endl;
            cout << endl;
        }
        return;
    }
    for (int i = 1; i <= 6; i++)
    {
        int cantn1 = cantn, cantm1 = cantm;
        ok = tranzitie(n, m, i, cantn1, cantm1);
        v.push_back({ cantn1,cantm1 });
        Back(n, m, k, ok, cantn1, cantm1, v, visit);
        v.pop_back();
    }
}

void BackTracking::BKT(int n, int m, int k)
{
    bool visited[1000][1000] = { 0 };
    int cant1 = 0, cant2 = 0, ok = 1;
    vector<pair<int, int>> v;
    v.push_back({ 0,0 });
    Back(n, m, k, ok, cant1, cant2, v, visited);
}