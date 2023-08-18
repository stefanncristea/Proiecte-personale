#ifndef ASIMPTOTE_H_INCLUDED
#define ASIMPTOTE_H_INCLUDED
#define infinit 999999

#include "desenare.h"

void AsimpVert(intervale vect[], valori v[], int b, char s[], int lungime, int latime)
{
    setcolor(GREEN);
    setlinestyle(0, 0, 3);
    char *p,aux[200];
    int i;

    long double zoomx;
    zoomx=(double)lungime/2/b;

    for(i=vect[b].a+1; i<=vect[b].b; i++)
        if(v[i].eroare==2)
        {
            while(v[i].eroare==2)
                i++;
            i--;
            line(v[i].x*zoomx+lungime/2,0,v[i].x*zoomx+lungime/2,834);
        }
        else if(v[i].eroare==1)
        {
            bool ok=1;
            while(v[i].eroare==1 && i<=vect[b].b)
                i++;
            i--;
            p=strchr(s,'/');
            while(p)
            {
                long double val;
                int errorx=0;
                int poz=p-s-1,lu=-1;
                if(s[poz]==')')
                {
                    while(s[poz]==')')
                    poz--;
                    while(s[poz]!='(')
                        aux[++lu]=s[poz--];
                    aux[++lu]=0;
                    strrev(aux);
                    val=solve(v[i].x,aux,errorx);
                }
                else
                {
                    while(poz>=0 && !strchr("+-*/^",s[poz]))
                        aux[++lu]=s[poz--];
                    aux[++lu]=0;
                    strrev(aux);
                    val=solve(v[i].x,aux,errorx);
                }
                if(val>-0.001 && val<0.001)
                    ok=0;
                p=strchr(p+1,'/');
            }
            if(ok)
                line(v[i].x*zoomx+lungime/2,0,v[i].x*zoomx+lungime/2,834);
        }
}

void GasireAsimpOriz(intervale vect[], valori v[], long double &limitainf, long double &limitasup, bool &gasitli, bool &gasitls)
{
    gasitli=0;
    gasitls=0;

    int i;
    bool gasit=0;
    long double minim,maxim,maxim1,minim1,cpmin,cpmax;

    minim=infinit;
    maxim=-infinit;
    minim1=infinit;
    maxim1=-infinit;

    for(i=vect[100].a+1; i<=vect[100].b; i++)
        if(!v[i].eroare)
        {
            gasit=1;
            maxim=max(v[i].y,maxim);
            minim=min(v[i].y,minim);
        }

    if(gasit)
    {
        for(i=vect[200].a+1; i<=vect[200].b; i++)
            if(!v[i].eroare)
            {
                gasit=1;
                maxim1=max(v[i].y,maxim1);
                minim1=min(v[i].y,minim1);
            }

        cpmin=minim;
        cpmax=maxim;
        minim=floor(minim);
        maxim=ceil(maxim);
        minim1=floor(minim1);
        maxim1=ceil(maxim1);

        if(minim1==minim && minim!=infinit)
            limitainf = cpmin-0.1,gasitli=1;
        if(maxim1==maxim && maxim!=-infinit)
            limitasup = cpmax+0.1,gasitls=1;
    }
}

void AsimpOriz(long double limitainf, long double limitasup, int b, bool gasitli, bool gasitls, int lungime, int latime)
{
    int i;
    long double zoomy;
    setcolor(RED);
    setlinestyle(0, 0, 3);
    zoomy=(double)latime/2/b;
    if(gasitli!=0)
        line(0, latime/2-limitainf*zoomy,lungime, latime/2-limitainf*zoomy);
    if(gasitls!=0)
        line(0, latime/2-limitasup*zoomy, lungime, latime/2-limitasup*zoomy);
}
#endif // ASIMPTOTE_H_INCLUDED
