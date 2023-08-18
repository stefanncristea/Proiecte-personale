#include <iostream>
#include <cstring>
#include <cmath>
#include <cstdlib>
#include <climits>
#include <stack>
#include <graphics.h>
#include "evaluator.h"
#include "corectitudine.h"
#include "desenare.h"
#include "asimptote.h"
#define infinit 999999
using namespace std;


int main()
{
    int n=0;
    stack <long double> q;
    bool errorx=0,errorf=0;
    char s[200];
    cout<<"Introduceti functia dorita: ";
    cin.get(s,205);
    scrierecorecta(s,errorf);
    if(!errorf)
    {
        int i;
        bool gasitli=0,gasitls=0;
        long double li,ls;
        CalculFx(s,n);
        Intervale();
        GasireAsimpOriz(vect,v,li,ls,gasitli,gasitls);
        //for(int i=1;i<=n;i++)
            //cout<<v[i].x<<"         "<<v[i].y<<"       "<<v[i].eroare<<'\n';
        int a=-10,b=10;//capetele intervalului
        long double zoomy,maxim=-1;
        char ch='-';
        InitGraph();//initializam graficul
        Desenare(a,b,s);
        AsimpVert(vect,v,b,s);
        AsimpOriz(li,ls,b,gasitli,gasitls);
        cin>>ch;
        while(ch!='.')
        {
            if(ch=='-')
            {
                a-=10;
                b+=10;
                Desenare(a,b,s);
                AsimpVert(vect,v,b,s);
                AsimpOriz(li,ls,b,gasitli,gasitls);
            }
            else if(b!=10)
            {
                a+=10;
                b-=10;
                Desenare(a,b,s);
                AsimpVert(vect,v,b,s);
                AsimpOriz(li,ls,b,gasitli,gasitls);
            }
            cin>>ch;
        }
    }
    return 0;
}
