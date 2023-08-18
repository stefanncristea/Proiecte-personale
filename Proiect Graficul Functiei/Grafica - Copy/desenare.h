#ifndef DESENARE_H_INCLUDED
#define DESENARE_H_INCLUDED

#define MAX 50

struct valori
{
    long double x, y;
    int eroare;
} v[10000];

struct intervale
{
    int a,b;
}vect[300];

void CalculFx(char s[],int &n)
{
    int errorx=0;
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

void Desenare(int a, int b, char s[], int lungime, int latime , bool MinON, bool MaxON)
{

    int n = -1, p1, p2, a2=a/2, b2=b/2, contor_min=0, contor_max=0;
    char sir2[201];
    long double ymax = -1, cp, cons, cok = 0, cnr = 0, cgas = 0, zoomx, zoomy, pctmin= +infinit, pctmax= -infinit;
    bool errorx = 0;

    for(int i=vect[b].a+1;i<=vect[b].b;i++)
    if(!v[i].eroare)
        {
            if(v[i].y>pctmax)
                pctmax=v[i].y, contor_max=i;

            if(v[i].y<pctmin)
                pctmin=v[i].y, contor_min=i;
        }


    pctmax=ceil(pctmax);
    pctmin=floor(pctmin);

    //if(pctmax!=-infinit)
       // cout<<pctmax<<" ";
    //if(pctmin!=infinit)
        //cout<<pctmin;

    //Intervalele inferioare , superioare
    char a_char[MAX + sizeof(char)];
    char b_char[MAX + sizeof(char)];
    sprintf(a_char, "%d", a);
    sprintf(b_char, "%d", b);

    //Mijloacele intervalelor
    char a2_char[MAX + sizeof(char)];
    char b2_char[MAX + sizeof(char)];
    sprintf(a2_char, "%d", a2);
    sprintf(b2_char, "%d", b2);
        if(a%2!=0)
        {
            strcat(a2_char,".5");
            strcat(b2_char,".5");
        }

    // Fundalul Negru
    setfillstyle(SOLID_FILL, COLOR(0, 0, 0));
    bar(0, 0, lungime, latime);

    // Dotted line + Axele Ox si Oy
    setlinestyle(1, 0, 1);
    setcolor(WHITE);
    line(lungime/2, 0, lungime/2, latime);
    line(0, latime/2, lungime, latime/2);

    //765,417
    zoomx = lungime/2 / b;
    zoomy = latime/2 / b;

    // GALBEN + Intervalele [ , ] + Mijlocurile
    setcolor(COLOR(169,169,169));

    outtextxy(lungime/2-10, latime/2+10,"0");

    outtextxy(20, latime/2+10,a_char);
    outtextxy(lungime-70, latime/2+10,b_char);

    outtextxy(lungime/2 - lungime/4, latime/2+10, a2_char);
    outtextxy(lungime/2 + lungime/4, latime/2+10, b2_char);


    setcolor(COLOR(255,215,0));
    //setcolor(COLOR(255,20,147)); // PINK
    setlinestyle(0, 0, 3);

    int i=vect[b].a+1;
    while (v[i].eroare && i<=vect[b].b)
        i++;

    if (i<=vect[b].b)
        p1 = i;

        i++;

    while (i<=vect[b].b)
    {

        if(MaxON)
            if(i==contor_max)
            {
                setcolor(COLOR(255,20,147)); // PINK
                circle(v[i].x * zoomx + lungime / 2, latime / 2 - v[i].y * zoomy , 10);
                setcolor(COLOR(255,215,0));
            }

        if(MinON)
            if(i==contor_min)
            {
                setcolor(COLOR(0,255,0)); //NEON GREEN
                circle(v[i].x * zoomx + lungime / 2, latime / 2 - v[i].y * zoomy , 10);
                setcolor(COLOR(255,215,0));
            }

        if (v[i].eroare)
        {
            while (i<=vect[b].b && v[i].eroare)
                i++;
            if (i<=vect[b].b)
                p1 = i;
        }
        else
        {
            line(v[p1].x * zoomx + lungime / 2, latime / 2 - v[p1].y * zoomy, v[i].x * zoomx + lungime / 2, latime / 2 - v[i].y * zoomy);

            p1 = i;
        }

        i++;
    }
}

#endif // DESENARE_H_INCLUDED
