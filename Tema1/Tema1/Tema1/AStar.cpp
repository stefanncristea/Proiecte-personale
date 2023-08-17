#include "AStar.h"
#include <iostream>
#include <vector>
using namespace std;

int AStar::HeuristicS(path a, int k)
{
    return min(abs(a.staren - k), abs(a.starem - k));
}

void AStar::add(int n, int m, vector<path>& v, path a, bool visited[][1000])
{
    path next, tmp;
    next.expath.fd = a.d;
    next.expath.fstarem = a.starem;
    next.expath.fstaren = a.staren;
    next.staren = 0;
    next.starem = 0;
    next.d = 0;
    for (int i = 1; i <= 6; i++)
    {
        if (i == 1 && a.staren != n)
        {
            tmp = next;
            tmp.staren = n;
            tmp.starem = a.starem;
            tmp.d = a.d + 1;
            if (!visited[tmp.staren][tmp.starem])
            {
                v.push_back(tmp);
                visited[tmp.staren][tmp.starem] = 1;
            }
        }
        if (i == 2 && a.starem != m)
        {
            tmp = next;
            tmp.starem = m;
            tmp.staren = a.staren;
            tmp.d = a.d + 1;
            if (!visited[tmp.staren][tmp.starem])
            {
                v.push_back(tmp);
                visited[tmp.staren][tmp.starem] = 1;
            }
        }
        if (i == 3 && a.starem != m && a.staren != 0)
        {
            tmp = next;
            if (a.staren + a.starem > m)
            {
                int aux = m - a.starem;
                tmp.starem = m;
                tmp.staren = a.staren - aux;
            }
            else
            {
                tmp.starem += a.staren;
                tmp.staren = 0;
            }
            tmp.d = a.d + 1;

            if (!visited[tmp.staren][tmp.starem])
            {
                v.push_back(tmp);
                visited[tmp.staren][tmp.starem] = 1;
            }
        }
        if (i == 4 && a.staren != n && a.starem != 0)
        {
            tmp = next;
            if (a.staren + a.starem > n)
            {
                int aux = n - a.staren;
                tmp.staren = n;
                tmp.starem = a.starem - aux;
            }
            else
            {
                tmp.staren += a.starem;
                tmp.starem = 0;
            }
            tmp.d = a.d + 1;
            if (!visited[tmp.staren][tmp.starem])
            {
                v.push_back(tmp);
                visited[tmp.staren][tmp.starem] = 1;
            }
        }
        if (i == 5 && a.staren != 0)
        {
            tmp = next;
            tmp.staren = 0;
            tmp.starem = a.starem;
            tmp.d = a.d + 1;
            if (!visited[tmp.staren][tmp.starem])
            {
                v.push_back(tmp);
                visited[tmp.staren][tmp.starem] = 1;
            }
        }
        if (i == 6 && a.starem != 0)
        {
            tmp = next;
            tmp.starem = 0;
            tmp.staren = a.staren;
            tmp.d = a.d + 1;
            if (!visited[tmp.staren][tmp.starem])
            {
                v.push_back(tmp);
                visited[tmp.staren][tmp.starem] = 1;
            }
        }
    }
}

void AStar::AStelat(int n, int m, int k)
{
    bool visited[1000][1000] = { 0 };
    vector <path> v;
    path actual;
    actual.staren = 0;
    actual.starem = 0;
    actual.d = 1;
    path nod1, nod2;
    nod1 = nod2 = actual;
    nod1.staren = n, nod1.expath.fd = actual.d + 1, nod1.expath.fstaren = actual.staren, nod1.expath.fstarem = actual.starem;
    nod2.starem = m, nod1.expath.fd = actual.d + 1, nod1.expath.fstaren = actual.staren, nod1.expath.fstarem = actual.starem;
    v.push_back(actual);
    v.push_back(nod1);
    v.push_back(nod2);
    visited[0][0] = visited[0][m] = visited[n][0] = cautat[0][0] = 1;
    int gasit = 1;
    while (gasit == 1)
    {

        gasit = 0;
        int cmin = INT_MAX;
        path next;
        for (int i = 0; i < v.size(); i++)
            if (v[i].staren == k || v[i].starem == k)
            {
                cout << "----------------------------------------------" << endl;
                cout << "    Drumul de lungime minima a fost gasit!" << endl;
                cout << "----------------------------------------------" << endl;
                vector<path> cale;
                cale.push_back(v[i]);
                path last = v[i];
                for (int j = i - 1; j >= 0; j--)
                    if (last.expath.fd == v[j].d && last.expath.fstaren == v[j].staren && last.expath.fstarem == v[j].starem)
                    {
                        cale.push_back(v[j]);
                        last = v[j];
                    }
                cale.push_back(actual);
                for (int j = cale.size() - 1; j >= 0; j--)
                {
                    cout << "Cantitatea acum in primul vas este: " << cale[j].staren << endl;
                    cout << "Cantitatea acum in al doilea vas este: " << cale[j].starem << endl;
                }
                return;
            }
        int lu = v.size();
        for (int i = 1; i < lu; i++)
        {

            if (cmin > HeuristicS(v[i], k) + v[i].d && this->cautat[v[i].staren][v[i].starem] == 0)
            {
                cmin = HeuristicS(v[i], k) + v[i].d;
                next = v[i];
            }
        }
        if (cmin != INT_MAX)
        {
            gasit = 1;
            this->cautat[next.staren][next.starem] = 1;
            add(n, m, v, next, visited);
        }
    }
    cout << endl << "----------------------------------------------------"<<endl;
    cout << "    Nu a putut fi gasita nicio solutie!";
    cout << endl << "----------------------------------------------------";
}
