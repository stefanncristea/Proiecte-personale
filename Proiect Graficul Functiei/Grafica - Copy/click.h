#ifndef CLICK_H_INCLUDED
#define CLICK_H_INCLUDED

#include "afisare_despre.h"
#include "afisare_menu.h"
#include "afisare_optiuni.h"

void CLICK(int x, int y)
{
    if (ismouseclick(WM_LBUTTONUP))
    {

        if (Buton == MENU)
        {
            if (x >= coordIncepe.x1 && x <= coordIncepe.x2 && y >= coordIncepe.y1 && y <= coordIncepe.y2)
                Afisare_Incepe();

            if (x >= coordOptiuni.x1 && x <= coordOptiuni.x2 && y >= coordOptiuni.y1 && y <= coordOptiuni.y2)
                Afisare_Optiuni(Stiva, Buton, Limba, lungime, latime, MUZICA_ON);

            if (x >= coordDespre.x1 && x <= coordDespre.x2 && y >= coordDespre.y1 && y <= coordDespre.y2)
                Afisare_Despre(Stiva, Buton, Limba, lungime, latime);
        }

        else
        {
            if (x >= 0 && x <= lungime / 15 && y >= 0 && y <= latime / 12) // BUTONUL DE BACK
            {
                if(AnimatieMonitor==0)
                    Back();
            }



            else if(Buton == INCEPE) // MENU INCEPE
            {
                if (x >= 0 && x <= lungime && y >= 0 && y <= latime)
                    AnimatieMonitor=1;
            }

            else if (Buton == OPTIUNI) // MENU OPTIUNI
            {
                 if (x >= coordLimba.x1 && x <= coordLimba.x2 && y >= coordLimba.y1 && y <= coordLimba.y2) // BUTON LIMBI
                    Afisare_Limba();

                 if (x >= coordMuzica.x1 && x <= coordMuzica.x2 && y >= coordMuzica.y1 && y <= coordMuzica.y2)  // BUTON MUZICA
                    Afisare_Muzica();

                 if (x >= coordON_OFF.x1 && x <= coordON_OFF.x2 && y >= coordON_OFF.y1 && y <= coordON_OFF.y2) // BUTON ON/OFF
                 {
                    if(MUZICA_ON == 1)
                    {
                        Play_Music_OFF( MuzicaAleasa, MUZICA_ON );
                        Afisare_ON_OFF();
                    }
                    else
                    {
                        MUZICA_ON = 1;
                        Afisare_ON_OFF();
                    }

                    Play_Music( MuzicaAleasa, MUZICA_ON );

                 }
            }

            else if (Buton == LIMBA) // MENU LANGUAGE
            {
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
                }
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
                        }

                if(MuzicaAleasa!=2)
                    if (x >= coordJukebox_2.x1 && x <= coordJukebox_2.x2 && y >= coordJukebox_2.y1 && y <= coordJukebox_2.y2)
                        {
                            Play_Music_OFF( MuzicaAleasa, MUZICA_ON );
                                MUZICA_ON=1;
                                MuzicaAleasa=2;
                            Play_Music( MuzicaAleasa, MUZICA_ON );
                        }

                if(MuzicaAleasa!=3)
                    if (x >= coordJukebox_3.x1 && x <= coordJukebox_3.x2 && y >= coordJukebox_3.y1 && y <= coordJukebox_3.y2)
                        {
                            Play_Music_OFF( MuzicaAleasa, MUZICA_ON );
                                MUZICA_ON=1;
                                MuzicaAleasa=3;
                            Play_Music( MuzicaAleasa, MUZICA_ON );
                        }

                if(MuzicaAleasa!=4)
                    if (x >= coordJukebox_4.x1 && x <= coordJukebox_4.x2 && y >= coordJukebox_4.y1 && y <= coordJukebox_4.y2)
                        {
                            Play_Music_OFF( MuzicaAleasa, MUZICA_ON );
                                MUZICA_ON=1;
                                MuzicaAleasa=4;
                            Play_Music( MuzicaAleasa, MUZICA_ON );
                        }

                if(MuzicaAleasa!=5)
                    if (x >= coordJukebox_5.x1 && x <= coordJukebox_5.x2 && y >= coordJukebox_5.y1 && y <= coordJukebox_5.y2)
                        {
                            Play_Music_OFF( MuzicaAleasa, MUZICA_ON );
                                MUZICA_ON=1;
                                MuzicaAleasa=5;
                            Play_Music( MuzicaAleasa, MUZICA_ON );
                        }
            }

            else if (Buton == FUNCTIE)
            {

            }

        }

    }
}

#endif // CLICK_H_INCLUDED
