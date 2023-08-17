#pragma once
#include <vector>
#include <iostream>
using namespace std;

class Hill
{
public:
	struct stari
	{
		int n, m, staren, starem, k;
	};
	int Heuristic(stari a);
	stari actions(stari a, bool visited[][1000]);
	void HillClimbing(int n, int m, int k);
};

