#ifndef DESENARE_H_INCLUDED
#define DESENARE_H_INCLUDED
#include <cmath>

struct valori
{
    long double x,y;
    bool eroare;
} v[10000];

struct intervale
{
    int a,b;
}vect[300];

void CalculFx(char s[],int &n)
{
    bool errorx=0;
    long double pas=0.2;
    char sir2[200];
    n=0;
    for(long double i=-200; i<=200.1; i+=pas)
    {
        strcpy(sir2,s);
        v[++n].y=solve(i,sir2,errorx);
        v[n].x=i;
        v[n].eroare=errorx;
        errorx=0;
        if(floor(i)==-100)
            pas=0.1;
        if(floor(i)==-50)
            pas=0.02;
        if(floor(i)==50)
            pas=0.1;
        if(floor(i)==100)
            pas=0.2;
    }
}

void Intervale()
{
    int i;
    vect[1].a=3450,vect[1].b=3551;
    vect[10].a=3000,vect[10].b=4001;
    vect[50].a=1000,vect[50].b=6001;
    vect[100].a=500;vect[100].b=6501;
    for(i=2;i<=9;i++)
        vect[i].a=vect[i-1].a-50,vect[i].b=vect[i-1].b+50;
    for(i=20;i<=40;i+=10)
        vect[i].a=vect[i-10].a-500,vect[i].b=vect[i-10].b+500;
    for(i=60;i<=90;i+=10)
        vect[i].a=vect[i-10].a-100,vect[i].b=vect[i-10].b+100;
    for(i=110;i<=200;i+=10)
        vect[i].a=vect[i-10].a-50,vect[i].b=vect[i-10].b+50;
}

void InitGraph()
{
    int lungime=getmaxwidth(),latime=getmaxheight();
    initwindow(lungime,latime,"Graficul functiei");
}

void Desenare(int a,int b,char s[])
{
    int lungime=getmaxwidth(),latime=getmaxheight(),n=0,p1;
    char sir2[201];
    long double ymax=-1,cp,cons,cok=0,cnr=0,cgas=0,zoomx,zoomy,pctmin,pctmax;
    bool errorx=0;
    pctmax=-infinit;
    pctmin=+infinit;
    for(int i=vect[b].a+1;i<=vect[b].b;i++)
    if(!v[i].eroare)
            pctmax=max(pctmax,v[i].y),pctmin=min(pctmin,v[i].y);
    //pctmax=ceil(pctmax);
    //pctmin=floor(pctmin);
    if(pctmax!=-infinit)
        cout<<pctmax;
    if(pctmin!=infinit)
        cout<<pctmin;

    setcolor(RED);
    setfillstyle(SOLID_FILL, COLOR(0,10,10));
    bar(0,0,lungime,latime);
    line(lungime/2,0,lungime/2,latime);
    line(0,latime/2,lungime,latime/2);
    setcolor(WHITE);
    setlinestyle(0,0,1);
    zoomx=765.0/b;
    zoomy=417.0/b;



    for(int i=1; i<=n; i++)
        if(!v[i].eroare)
        {
            if(v[i].y==cons)
                cok++;
            cnr++;
        }
    //for(int i=0;i<=n;i++)
    //cout<<v[i].x<<"         "<<v[i].y<<"            "<<v[i].eroare<<endl;
    if(cok==cnr)
        cgas=1;
    if(cgas==1)
        ymax=abs(cons*2);
    int i=vect[b].a+1;
    while(v[i].eroare==1 && i<=vect[b].b)
        i++;
    if(i<=vect[b].b)
        p1=i;
    i++;
    while(i<=vect[b].b)
    {
        if(v[i].eroare==1)
        {
            while(i<=vect[b].b && v[i].eroare==1)
                i++;
            if(i<=vect[b].b)
                p1=i;
        }
        else
        {
            line(v[p1].x*zoomx+lungime/2,latime/2-v[p1].y*zoomy,v[i].x*zoomx+lungime/2,latime/2-v[i].y*zoomy);
            p1=i;
        }
        i++;
    }
}
#endif // DESENARE_H_INCLUDED
