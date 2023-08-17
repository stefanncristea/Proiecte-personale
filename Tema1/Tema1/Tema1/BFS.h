#pragma once
class BFS
{
public:
	struct drum
	{
		int cantn, cantm, nr, calen[1000], calem[1000];
	};



	void Algorithm(int n, int m, int k);
	void tranzit(drum& actual, int decizie, int n, int m);
};

