#include "Hill.h"
#include <vector>
#include <iostream>
#include <climits>
using namespace std;

int Hill::Heuristic(stari a)
{
    return min(abs(a.k - a.staren), abs(a.k - a.starem));
}

Hill::stari Hill::actions(stari a, bool visited[][1000])
{
    int minim = INT_MAX;
    stari var = a;
    for (int i = 1; i <= 6; i++)
    {
        stari next = a;
        if (i == 1)
        {
            next.staren = a.n;
            if (Heuristic(next) <= minim && !visited[next.staren][next.starem])
            {
                minim = Heuristic(next);
                var = next;
            }
        }
        if (i == 2)
        {
            next.starem = a.m;
            if (Heuristic(next) <= minim && !visited[next.staren][next.starem])
            {
                minim = Heuristic(next);
                var = next;
            }
        }
        if (i == 3)
        {
            if (next.starem + next.staren > a.m)
            {
                int tmp = next.m - next.starem;
                next.starem = next.m;
                next.staren -= tmp;
            }
            else
            {
                next.starem += next.staren;
                next.staren = 0;
            }
            if (Heuristic(next) <= minim && !visited[next.staren][next.starem])
            {
                minim = Heuristic(next);
                var = next;
            }
        }
        if (i == 4)
        {
            if (next.starem + next.staren > a.n)
            {
                int tmp = next.n - next.staren;
                next.staren = next.n;
                next.starem -= tmp;
            }
            else
            {
                next.staren += next.starem;
                next.starem = 0;
            }
            if (Heuristic(next) <= minim && !visited[next.staren][next.starem])
            {
                minim = Heuristic(next);
                var = next;
            }
        }
        if (i == 5)
        {
            next.staren = 0;
            if (Heuristic(next) <= minim && !visited[next.staren][next.starem])
            {
                minim = Heuristic(next);
                var = next;
            }
        }
        if (i == 6)
        {
            next.starem = 0;
            if (Heuristic(next) <= minim && !visited[next.staren][next.starem])
            {
                minim = Heuristic(next);
                var = next;
            }
        }
    }
    return var;
}


void Hill::HillClimbing(int n, int m, int k)
{
    int ok = 1, gasit = 0;
    bool visited[1000][1000] = { 0 };
    stari actual;
    actual.n = n;
    actual.m = m;
    actual.staren = 0;
    actual.starem = 0;
    actual.k = k;
    visited[actual.staren][actual.starem] = 1;
    vector<stari> v;
    v.push_back(actual);
    while(ok && !gasit)
    {
        if (actual.staren == k || actual.starem == k)
        {
            gasit = 1;
            break;
        }
        stari next = actions(actual, visited);
        if (next.starem == actual.starem && next.staren == actual.staren)
            ok = 0;
        else
        {
            actual = next;
            v.push_back(actual);
            visited[actual.staren][actual.starem] = 1;
        }
    }
    if (gasit)
    {
        for (int i = 0; i < v.size(); i++)
        {
            cout << "Cantitatea ACUM in primul vas N este: " << v[i].staren << endl;
            cout << "Cantitatea ACUM in al doilea vas M este: " << v[i].starem << endl;
            cout << endl;
        }
        return;
    }
    if (!ok)
        cout << "Nu s-a gasit o solutie! Incearca mai tarziu...";
    

}