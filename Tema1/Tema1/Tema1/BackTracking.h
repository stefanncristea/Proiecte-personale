#pragma once
#include <queue>
#include <iostream>

class BackTracking
{
public:
	int tranzitie(int n, int m, int pas, int& cantn, int& cantm);
	void Back(int n, int m, int k, int ok, int cantn, int cantm, std::vector<std::pair<int, int>> v, bool visit[][1000]);
	void BKT(int n, int m, int k);
};

