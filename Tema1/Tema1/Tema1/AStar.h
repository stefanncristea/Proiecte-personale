#pragma once
#include <vector>
#include <iostream>
using namespace std;

class AStar
{
public:
    bool cautat[100][100] = { 0 };
    struct path
    {
        int staren, starem, d;
        struct
        {
            int fstaren, fstarem, fd;
        }expath;
    };
    int HeuristicS(path a, int k);
    void add(int n, int m, vector<path>& v, path a, bool visited[][1000]);
	void AStelat(int n, int m, int k);
};
