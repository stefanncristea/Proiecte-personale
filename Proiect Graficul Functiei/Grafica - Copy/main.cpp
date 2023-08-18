#include <iostream>
#include <graphics.h>
#include <winbgim.h>
#include <cstring>
#include <math.h>
#include <Windows.h>
#include <stack>

#pragma comment(lib, "winmm.lib")

#include "play_music.h"
#include "play_music_off.h"
#include "afisare_menu.h"
#include "afisare_optiuni.h"
#include "afisare_on_off.h"
#include "afisare_limba.h"
#include "afisare_muzica.h"
#include "afisare_despre.h"
#include "afisare_incepe.h"
#include "animatie_monitor.h"
#include "calculeaza_coordonate.h"
#include "citeste_functie.h"
#include "button_effect.h"
#include "asimptote.h"
#include "butoane_min_max_asimptote.h"

#include "corectitudine.h"
#include "evaluator.h"
#include "desenare.h"

#define MAX 50

using namespace std;


// Variabile globale


bool MUZICA_ON = 0;
bool AnimatieMonitor = 0;
bool AnimatieMonitor_Played = 0;
bool OnButtonEffect=0;
bool errorf=0;
bool AsimptotaON =0, MaxON = 0, MinON = 0, AsimptotaButonApasat=0, MaxButonApasat=0, MinButonApasat=0;
bool ConstantaGasita=0;


short MuzicaAleasa = 2;
short ErrorType=0;
short ButonZoom =0; //0 SWITCH , 1 ZOOM IN , 2 ZOOM OUT , 3 EXIT FUNCTION


//int lungime = getmaxwidth(), latime = getmaxheight();

int lungime = getmaxwidth(), latime = getmaxheight();
int maxx = lungime, maxy = latime;
int midx = lungime / 2,  midy = latime / 2;


stack<int>Stiva;


char s[MAX];


int a=-10,b=10;
int n=0, i;
bool gasitli=0,gasitls=0;
long double limitainf,limitasup;

// Functii
void CLICK(int, int);
void Back();

// PROGRAMUL PRINCIPAL
int main()
{
    initwindow(lungime, latime, "Graficul Functiei");
    Calculeaza_Coordonate(lungime, latime);
    //mciSendString("play Muzica/2Muzica.mp3 repeat", NULL, 0, NULL); // PORNESTE muzica


    Afisare_Menu( Buton, Limba, lungime, latime );

    registermousehandler(WM_LBUTTONUP, CLICK);

    do
    {
        while(AnimatieMonitor==0)
        {
            BUTTON_EFFECT(mousex(),mousey(),lungime,latime,MUZICA_ON,OnButtonEffect);
            delay(30);
        }

        if(AnimatieMonitor==1)
        {
            Citeste_Functie(s, lungime/2.32, latime/3.8, lungime, latime, errorf, ErrorType);
            AnimatieMonitor=1;
            if(!scrierecorecta(s,errorf,ErrorType))
            {
                Buton = FUNCTIE;
                Stiva.push(Buton);


                if(AnimatieMonitor_Played==0)
                {
                    //Animatie_Monitor(AnimatieMonitor, lungime, latime);
                    //delay(800);
                    AnimatieMonitor_Played=1;
                }

                CalculFx(s,n);
                Intervale();

                int cok=0,cnr=0;
                bool cgas=0;

                for (int i = 2; i <= n; i++)
                    if (!v[i].eroare)
                    {
                        if (v[i].y == v[1].y)
                            cok++;
                        cnr++;
                    }
                if (cok == cnr)
                    cgas = 1;

                GasireAsimpOriz(vect, v, limitainf, limitasup, gasitli, gasitls);

                a=-10,b=10,ButonZoom=0;

                Desenare(a,b,s,lungime,latime, MinON, MaxON);
                if(AsimptotaON && !cgas)
                    AsimpVert(vect, v, b, s, lungime, latime),     AsimpOriz(limitainf, limitasup, b, gasitli, gasitls, lungime, latime);

                Butoane_Min_Max_Asimptote(lungime, latime, AsimptotaON, MaxON, MinON);


                while(ButonZoom!=3)
                {
                    if(ButonZoom== 2)
                    {
                        if(a>-10 && b<10)
                            b+=1,a-=1;
                        else
                        {
                            a-=10;
                            b+=10;
                        }
                        GasireAsimpOriz(vect, v, limitainf, limitasup, gasitli, gasitls);
                        Desenare(a,b,s,lungime,latime, MinON, MaxON);

                        if(AsimptotaON && !cgas)
                            AsimpVert(vect, v, b, s, lungime, latime),     AsimpOriz(limitainf, limitasup, b, gasitli, gasitls, lungime, latime);

                        Butoane_Min_Max_Asimptote(lungime, latime, AsimptotaON, MaxON, MinON);

                        ButonZoom = 0;
                    }



                    if(ButonZoom == 1)
                    {
                        if(a>=-10 && b<=10 && a!=-1)
                            b-=1,a+=1;
                        else if(a<=-10)
                        {
                            a+=10;
                            b-=10;
                        }

                        GasireAsimpOriz(vect, v, limitainf, limitasup, gasitli, gasitls);
                        Desenare(a,b,s,lungime,latime, MinON, MaxON);
                        if(AsimptotaON && !cgas)
                            AsimpVert(vect, v, b, s, lungime, latime),     AsimpOriz(limitainf, limitasup, b, gasitli, gasitls, lungime, latime);

                        Butoane_Min_Max_Asimptote(lungime, latime, AsimptotaON, MaxON, MinON);

                        ButonZoom = 0;
                    }

                    if(AsimptotaButonApasat == 1)
                    {

                        GasireAsimpOriz(vect, v, limitainf, limitasup, gasitli, gasitls);
                        Desenare(a,b,s,lungime,latime, MinON, MaxON);
                        if(AsimptotaON && !cgas)
                            AsimpVert(vect, v, b, s, lungime, latime),     AsimpOriz(limitainf, limitasup, b, gasitli, gasitls, lungime, latime);

                        Butoane_Min_Max_Asimptote(lungime, latime, AsimptotaON, MaxON, MinON);

                        AsimptotaButonApasat = 0;
                    }

                    if(MaxButonApasat == 1)
                    {

                        GasireAsimpOriz(vect, v, limitainf, limitasup, gasitli, gasitls);
                        Desenare(a,b,s,lungime,latime, MinON, MaxON);
                        if(AsimptotaON && !cgas)
                            AsimpVert(vect, v, b, s, lungime, latime),     AsimpOriz(limitainf, limitasup, b, gasitli, gasitls, lungime, latime);

                        Butoane_Min_Max_Asimptote(lungime, latime, AsimptotaON, MaxON, MinON);

                        MaxButonApasat = 0;
                    }

                    if(MinButonApasat == 1)
                    {

                        GasireAsimpOriz(vect, v, limitainf, limitasup, gasitli, gasitls);
                        Desenare(a,b,s,lungime,latime, MinON, MaxON);
                        if(AsimptotaON && !cgas)
                            AsimpVert(vect, v, b, s, lungime, latime),     AsimpOriz(limitainf, limitasup, b, gasitli, gasitls, lungime, latime);

                        Butoane_Min_Max_Asimptote(lungime, latime, AsimptotaON, MaxON, MinON);

                        MinButonApasat = 0;
                    }



                    delay(500);
                }

            }

            strcpy(s,"");

            AnimatieMonitor=0;
        }


    }
    while(1);

    getch();
    closegraph();
    return 0;
}

void CLICK(int x, int y)
{
    if (ismouseclick(WM_LBUTTONUP))
    {

        if (Buton == MENU)
        {
            if (x >= coordIncepe.x1 && x <= coordIncepe.x2 && y >= coordIncepe.y1 && y <= coordIncepe.y2)
                Afisare_Incepe (Stiva, Buton, Limba, lungime, latime);

            if (x >= coordOptiuni.x1 && x <= coordOptiuni.x2 && y >= coordOptiuni.y1 && y <= coordOptiuni.y2)
                Afisare_Optiuni (Stiva, Buton, Limba, lungime, latime, MUZICA_ON);

            if (x >= coordDespre.x1 && x <= coordDespre.x2 && y >= coordDespre.y1 && y <= coordDespre.y2)
                Afisare_Despre (Stiva, Buton, Limba, lungime, latime);
        }

        else
        {
            if (x >= 0 && x <= lungime / 15 && y >= 0 && y <= latime / 12) // BUTONUL DE BACK
            {
                Back();
                ButonZoom = 3;
                AnimatieMonitor=0;
                strcpy(s,"");
                if(MUZICA_ON==0)
                    mciSendString("play Muzica/2ButtonEffect.mp3 ", NULL, 0, NULL);

            }

            else if(Buton == INCEPE) // MENU INCEPE
            {
                if (x >= lungime/2.9 && x <= lungime/1.5 && y >= latime/5.4 && y <= latime/2.33)
                    AnimatieMonitor=1;
            }

            else if (Buton == OPTIUNI) // MENU OPTIUNI
            {
                if (x >= coordLimba.x1 && x <= coordLimba.x2 && y >= coordLimba.y1 && y <= coordLimba.y2) // BUTON LIMBI
                {
                    Afisare_Limba (Stiva, Buton, Limba, lungime, latime);

                    if(MUZICA_ON==0)
                        mciSendString("play Muzica/2ButtonEffect.mp3 ", NULL, 0, NULL);
                }


                if (x >= coordMuzica.x1 && x <= coordMuzica.x2 && y >= coordMuzica.y1 && y <= coordMuzica.y2)  // BUTON MUZICA
                {
                    Afisare_Muzica (Stiva, Buton, Limba, lungime, latime);

                    if(MUZICA_ON==0)
                        mciSendString("play Muzica/2ButtonEffect.mp3 ", NULL, 0, NULL);
                }

                if (x >= coordON_OFF.x1 && x <= coordON_OFF.x2 && y >= coordON_OFF.y1 && y <= coordON_OFF.y2) // BUTON ON/OFF
                {
                    if(MUZICA_ON == 1)
                    {
                        Play_Music_OFF ( MuzicaAleasa, MUZICA_ON );
                        Afisare_ON_OFF ( Limba, MUZICA_ON, lungime, latime );

                        if(MUZICA_ON==0)
                            mciSendString("play Muzica/2ButtonEffect.mp3 ", NULL, 0, NULL);
                    }
                    else
                    {
                        MUZICA_ON = 1;
                        Afisare_ON_OFF ( Limba, MUZICA_ON, lungime, latime );
                    }

                    Play_Music ( MuzicaAleasa, MUZICA_ON );

                }
            }

            else if (Buton == FUNCTIE) // FUNCTIA GRAFICULUI
            {


                if (x >= lungime-lungime/12 && x <= lungime-lungime/24 && y >= latime-latime/15 && y <= latime)
                {
                    ButonZoom = 2;
                }

                if (x >= lungime-lungime/40 && x <= lungime && y >= latime-latime/15 && y <= latime)
                {
                    ButonZoom = 1;
                }

                if (x >= 10 && x <= lungime-lungime/1.13 && y >= latime-latime/13.9 && y <= latime-10)
                {
                    AsimptotaButonApasat=1;

                    if(AsimptotaON==1)
                        AsimptotaON=0;
                    else
                        AsimptotaON=1;
                }

                if (x >= lungime-lungime/1.21 && x <= lungime-lungime/1.3 && y >= latime-latime/13.9  && y <= latime-10)
                {
                    MinButonApasat=1;

                    if(MinON==1)
                        MinON=0;
                    else
                        MinON=1;
                }


                if (x >= lungime-lungime/1.13 && x <= lungime-lungime/1.2 && y >= latime-latime/13.9 && y <= latime-10)
                {
                    MaxButonApasat=1;

                    if(MaxON==1)
                        MaxON=0;
                    else
                        MaxON=1;
                }
            }

            else if (Buton == LIMBA) // MENU LANGUAGE
            {

                if(x >= coordLimba_Romana.x1 && x <= coordLimba_Romana.x2 && y >= coordLimba_Romana.y1 && y <= coordLimba_Romana.y2) // BUTON ROMANA
                {
                    Limba = RO;
                    readimagefile("Jpg/Romana/Limba_Romana.jpg", 0, 0, maxx, maxy);
                }

                if(x >= coordLimba_Franceza.x1 && x <= coordLimba_Franceza.x2 && y >= coordLimba_Franceza.y1 && y <= coordLimba_Franceza.y2)// BUTON FRANCEZA
                {
                    Limba = FR;
                    readimagefile("Jpg/Franceza/Limba_Franceza.jpg", 0, 0, maxx, maxy);
                }

                if(x >= coordLimba_Engleza.x1 && x <= coordLimba_Engleza.x2 && y >= coordLimba_Engleza.y1 && y <= coordLimba_Engleza.y2) // BUTON ENGLEZA
                {
                    Limba = ENG;
                    readimagefile("Jpg/Engleza/Limba_Engleza.jpg", 0, 0, maxx, maxy);
                }

                if(MUZICA_ON==0)
                    mciSendString("play Muzica/2ButtonEffect.mp3 ", NULL, 0, NULL);

            }

            else if (Buton == MUZICA) // MENU MUZICA
            {
                if(MuzicaAleasa!=1)
                    if (x >= coordJukebox_1.x1 && x <= coordJukebox_1.x2 && y >= coordJukebox_1.y1 && y <= coordJukebox_1.y2)
                    {
                        Play_Music_OFF( MuzicaAleasa, MUZICA_ON );
                        MUZICA_ON=1;
                        MuzicaAleasa=1;
                        Play_Music( MuzicaAleasa, MUZICA_ON );

                        if(MUZICA_ON==0)
                            mciSendString("play Muzica/2ButtonEffect.mp3 ", NULL, 0, NULL);
                    }

                if(MuzicaAleasa!=2)
                    if (x >= coordJukebox_2.x1 && x <= coordJukebox_2.x2 && y >= coordJukebox_2.y1 && y <= coordJukebox_2.y2)
                    {
                        Play_Music_OFF( MuzicaAleasa, MUZICA_ON );
                        MUZICA_ON=1;
                        MuzicaAleasa=2;
                        Play_Music( MuzicaAleasa, MUZICA_ON );

                        if(MUZICA_ON==0)
                            mciSendString("play Muzica/2ButtonEffect.mp3 ", NULL, 0, NULL);
                    }

                if(MuzicaAleasa!=3)
                    if (x >= coordJukebox_3.x1 && x <= coordJukebox_3.x2 && y >= coordJukebox_3.y1 && y <= coordJukebox_3.y2)
                    {
                        Play_Music_OFF( MuzicaAleasa, MUZICA_ON );
                        MUZICA_ON=1;
                        MuzicaAleasa=3;
                        Play_Music( MuzicaAleasa, MUZICA_ON );

                        if(MUZICA_ON==0)
                            mciSendString("play Muzica/2ButtonEffect.mp3 ", NULL, 0, NULL);
                    }

                if(MuzicaAleasa!=4)
                    if (x >= coordJukebox_4.x1 && x <= coordJukebox_4.x2 && y >= coordJukebox_4.y1 && y <= coordJukebox_4.y2)
                    {
                        Play_Music_OFF( MuzicaAleasa, MUZICA_ON );
                        MUZICA_ON=1;
                        MuzicaAleasa=4;
                        Play_Music( MuzicaAleasa, MUZICA_ON );

                        if(MUZICA_ON==0)
                            mciSendString("play Muzica/2ButtonEffect.mp3 ", NULL, 0, NULL);
                    }

                if(MuzicaAleasa!=5)
                    if (x >= coordJukebox_5.x1 && x <= coordJukebox_5.x2 && y >= coordJukebox_5.y1 && y <= coordJukebox_5.y2)
                    {
                        Play_Music_OFF( MuzicaAleasa, MUZICA_ON );
                        MUZICA_ON=1;
                        MuzicaAleasa=5;
                        Play_Music( MuzicaAleasa, MUZICA_ON );

                        if(MUZICA_ON==0)
                            mciSendString("play Muzica/2ButtonEffect.mp3 ", NULL, 0, NULL);
                    }
            }


        }

    }
}


void Back()
{
    Stiva.pop();
    if (!Stiva.empty())
        switch (Stiva.top())
        {
        case OPTIUNI:
            Afisare_Optiuni (Stiva, Buton, Limba, lungime, latime, MUZICA_ON);
            Stiva.pop();
            break;
        case DESPRE:
            Afisare_Despre (Stiva, Buton, Limba, lungime, latime);
            Stiva.pop();
            break;
        case LIMBA:
            Afisare_Limba (Stiva, Buton, Limba, lungime, latime);
            break;
        case MUZICA:
            Afisare_Muzica(Stiva, Buton, Limba, lungime, latime);
            break;
        case INCEPE:
            Afisare_Incepe(Stiva, Buton, Limba, lungime, latime);
            Stiva.pop();
            break;
        }
    else
        Afisare_Menu( Buton, Limba, lungime, latime );
}



























