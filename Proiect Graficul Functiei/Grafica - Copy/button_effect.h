#ifndef BUTTON_EFFECT_H_INCLUDED
#define BUTTON_EFFECT_H_INCLUDED

#include "calculeaza_coordonate.h"

void BUTTON_EFFECT(int x, int y, int maxx , int maxy , bool MUZICA_ON, bool &OnButtonEffect)
{

        if (Buton == MENU)
        {
                if (x >= coordIncepe.x1 && x <= coordIncepe.x2 && y >= coordIncepe.y1 && y <= coordIncepe.y2)
                {
                    if(OnButtonEffect==0)
                    {
                        switch(Limba)
                        {
                            case RO:
                                readimagefile("Jpg/EfecteButoane/Romana/Menu_Romana_Buton_Incepe.jpg", 0, 0, maxx, maxy);
                                break;
                            case ENG:
                                readimagefile("Jpg/EfecteButoane/Engleza/Menu_Engleza_Buton_Start.jpg", 0, 0, maxx, maxy);
                                break;
                            case FR:
                                readimagefile("Jpg/EfecteButoane/Franceza/Menu_Franceza_Buton_Debut.jpg", 0, 0, maxx, maxy);
                                break;
                        }

                        mciSendString("play Muzica/1ButtonEffect.mp3 ", NULL, 0, NULL);
                        OnButtonEffect=1;
                    }
                }
                else if (x >= coordOptiuni.x1 && x <= coordOptiuni.x2 && y >= coordOptiuni.y1 && y <= coordOptiuni.y2)
                {
                    if(OnButtonEffect==0)
                    {
                        switch(Limba)
                        {
                            case RO:
                                readimagefile("Jpg/EfecteButoane/Romana/Menu_Romana_Buton_Optiuni.jpg", 0, 0, maxx, maxy);
                                break;
                            case ENG:
                                readimagefile("Jpg/EfecteButoane/Engleza/Menu_Engleza_Buton_Options.jpg", 0, 0, maxx, maxy);
                                break;
                            case FR:
                                readimagefile("Jpg/EfecteButoane/Franceza/Menu_Franceza_Buton_Options.jpg", 0, 0, maxx, maxy);
                                break;
                        }

                        mciSendString("play Muzica/1ButtonEffect.mp3 ", NULL, 0, NULL);
                        OnButtonEffect=1;
                    }
                }
                else if (x >= coordDespre.x1 && x <= coordDespre.x2 && y >= coordDespre.y1 && y <= coordDespre.y2)
                {
                    if(OnButtonEffect==0)
                    {
                        switch(Limba)
                        {
                            case RO:
                                readimagefile("Jpg/EfecteButoane/Romana/Menu_Romana_Buton_Despre.jpg", 0, 0, maxx, maxy);
                                break;
                            case ENG:
                                readimagefile("Jpg/EfecteButoane/Engleza/Menu_Engleza_Buton_About.jpg", 0, 0, maxx, maxy);
                                break;
                            case FR:
                                readimagefile("Jpg/EfecteButoane/Franceza/Menu_Franceza_Buton_Environ.jpg", 0, 0, maxx, maxy);
                                break;
                        }

                        mciSendString("play Muzica/1ButtonEffect.mp3 ", NULL, 0, NULL);
                        OnButtonEffect=1;
                    }
                }
                else
                {
                    if(OnButtonEffect==1)
                    {
                        switch(Limba)
                        {
                            case RO:
                                readimagefile("Jpg/Romana/Menu_Romana.jpg", 0, 0, maxx, maxy);
                                break;
                            case ENG:
                                readimagefile("Jpg/Engleza/Menu_Engleza.jpg", 0, 0, maxx, maxy);
                                break;
                            case FR:
                                readimagefile("Jpg/Franceza/Menu_Franceza.jpg", 0, 0, maxx, maxy);
                                break;
                        }

                        OnButtonEffect=0;
                    }
                }
        }

        else
        {
            //if (x >= 0 && x <= lungime / 15 && y >= 0 && y <= latime / 12) // BUTONUL DE BACK
                if (Buton == INCEPE)
                {
                    if (x >= coordIncepeInfo.x1 && x <= coordIncepeInfo.x2 && y >= coordIncepeInfo.y1 && y <= coordIncepeInfo.y2 )
                    {
                        if(OnButtonEffect==0)
                        {
                            switch(Limba)
                            {
                                case RO:
                                    readimagefile("Jpg/Romana/Incepe_Romana_Hint.jpg", 0, 0, maxx, maxy);
                                    break;
                                case ENG:
                                    readimagefile("Jpg/Engleza/Incepe_Engleza_Hint.jpg", 0, 0, maxx, maxy);
                                    break;
                                case FR:
                                    readimagefile("Jpg/Franceza/Incepe_Franceza_Hint.jpg", 0, 0, maxx, maxy);
                                    break;
                            }
                            OnButtonEffect=1;
                        }
                    }

                    else
                    {
                        if(OnButtonEffect==1)
                        {
                            switch(Limba)
                            {
                                case RO:
                                    readimagefile("Jpg/Romana/Incepe_Romana.jpg", 0, 0, maxx, maxy);
                                    break;
                                case ENG:
                                    readimagefile("Jpg/Engleza/Incepe_Engleza.jpg", 0, 0, maxx, maxy);
                                    break;
                                case FR:
                                    readimagefile("Jpg/Franceza/Incepe_Franceza.jpg", 0, 0, maxx, maxy);
                                    break;
                            }
                            OnButtonEffect=0;
                        }
                    }
                }


                else if (Buton == OPTIUNI) // MENU OPTIUNI
                {
                         if (x >= coordLimba.x1 && x <= coordLimba.x2 && y >= coordLimba.y1 && y <= coordLimba.y2 ) // BUTON LIMBI
                         {
                             if(OnButtonEffect==0)
                             {
                                 switch(Limba)
                                 {
                                    case RO:
                                        if(MUZICA_ON == 1)
                                            readimagefile("Jpg/EfecteButoane/Romana/Optiuni_Romana_On_Buton_Limba.jpg", 0, 0, maxx, maxy);
                                        else
                                            readimagefile("Jpg/EfecteButoane/Romana/Optiuni_Romana_Off_Buton_Limba.jpg", 0, 0, maxx, maxy);
                                        break;
                                    case ENG:
                                        if(MUZICA_ON == 1)
                                            readimagefile("Jpg/EfecteButoane/Engleza/Optiuni_Engleza_On_Buton_Language.jpg", 0, 0, maxx, maxy);
                                        else
                                            readimagefile("Jpg/EfecteButoane/Engleza/Optiuni_Engleza_Off_Buton_Language.jpg", 0, 0, maxx, maxy);
                                        break;
                                    case FR:
                                        if(MUZICA_ON == 1)
                                            readimagefile("Jpg/EfecteButoane/Franceza/Optiuni_Franceza_On_Buton_Langue.jpg", 0, 0, maxx, maxy);
                                        else
                                            readimagefile("Jpg/EfecteButoane/Franceza/Optiuni_Franceza_Off_Buton_Langue.jpg", 0, 0, maxx, maxy);
                                        break;
                                 }

                                 mciSendString("play Muzica/1ButtonEffect.mp3 ", NULL, 0, NULL);
                                 OnButtonEffect=1;
                             }

                         }

                         else if (x >= coordMuzica.x1 && x <= coordMuzica.x2 && y >= coordMuzica.y1 && y <= coordMuzica.y2)  // BUTON MUZICA
                         {
                             if(OnButtonEffect==0)
                             {
                                switch(Limba)
                                {
                                    case RO:
                                        if(MUZICA_ON == 1)
                                            readimagefile("Jpg/EfecteButoane/Romana/Optiuni_Romana_On_Buton_Muzica.jpg", 0, 0, maxx, maxy);
                                        else
                                            readimagefile("Jpg/EfecteButoane/Romana/Optiuni_Romana_Off_Buton_Muzica.jpg", 0, 0, maxx, maxy);
                                        break;
                                    case ENG:
                                        if(MUZICA_ON == 1)
                                            readimagefile("Jpg/EfecteButoane/Engleza/Optiuni_Engleza_On_Buton_Music.jpg", 0, 0, maxx, maxy);
                                        else
                                            readimagefile("Jpg/EfecteButoane/Engleza/Optiuni_Engleza_Off_Buton_Music.jpg", 0, 0, maxx, maxy);
                                        break;
                                    case FR:
                                        if(MUZICA_ON == 1)
                                            readimagefile("Jpg/EfecteButoane/Franceza/Optiuni_Franceza_On_Buton_Musique.jpg", 0, 0, maxx, maxy);
                                        else
                                            readimagefile("Jpg/EfecteButoane/Franceza/Optiuni_Franceza_Off_Buton_Musique.jpg", 0, 0, maxx, maxy);
                                        break;
                                }

                                 mciSendString("play Muzica/1ButtonEffect.mp3 ", NULL, 0, NULL);
                                 OnButtonEffect=1;
                             }
                         }

                         else if (x >= coordON_OFF.x1 && x <= coordON_OFF.x2 && y >= coordON_OFF.y1 && y <= coordON_OFF.y2) // BUTON ON/OFF
                         {
                            if(OnButtonEffect==0)
                            {
                                switch(Limba)
                                {
                                    case RO:
                                        if(MUZICA_ON == 1)
                                            readimagefile("Jpg/EfecteButoane/Romana/Optiuni_Romana_On_Buton_ON.jpg", 0, 0, maxx, maxy);
                                        else
                                            readimagefile("Jpg/EfecteButoane/Romana/Optiuni_Romana_Off_Buton_OFF.jpg", 0, 0, maxx, maxy);
                                        break;
                                    case ENG:
                                        if(MUZICA_ON == 1)
                                            readimagefile("Jpg/EfecteButoane/Engleza/Optiuni_Engleza_On_Buton_ON.jpg", 0, 0, maxx, maxy);
                                        else
                                            readimagefile("Jpg/EfecteButoane/Engleza/Optiuni_Engleza_Off_Buton_OFF.jpg", 0, 0, maxx, maxy);
                                        break;
                                    case FR:
                                        if(MUZICA_ON == 1)
                                            readimagefile("Jpg/EfecteButoane/Franceza/Optiuni_Franceza_On_Buton_ON.jpg", 0, 0, maxx, maxy);
                                        else
                                            readimagefile("Jpg/EfecteButoane/Franceza/Optiuni_Franceza_Off_Buton_OFF.jpg", 0, 0, maxx, maxy);
                                        break;
                                }

                                mciSendString("play Muzica/1ButtonEffect.mp3 ", NULL, 0, NULL);
                                OnButtonEffect=1;
                            }
                         }

                        else
                        {
                            if(OnButtonEffect==1)
                            {
                                switch(Limba)
                                {
                                        case RO:
                                            if(MUZICA_ON == 1)
                                                readimagefile("Jpg/Romana/Optiuni_Romana_On.jpg", 0, 0, maxx, maxy);
                                            else
                                                readimagefile("Jpg/Romana/Optiuni_Romana_Off.jpg", 0, 0, maxx, maxy);
                                            break;
                                        case ENG:
                                            if(MUZICA_ON == 1)
                                                readimagefile("Jpg/Engleza/Optiuni_Engleza_On.jpg", 0, 0, maxx, maxy);
                                            else
                                                readimagefile("Jpg/Engleza/Optiuni_Engleza_Off.jpg", 0, 0, maxx, maxy);
                                            break;
                                        case FR:
                                            if(MUZICA_ON == 1)
                                                readimagefile("Jpg/Franceza/Optiuni_Franceza_On.jpg", 0, 0, maxx, maxy);
                                            else
                                                readimagefile("Jpg/Franceza/Optiuni_Franceza_Off.jpg", 0, 0, maxx, maxy);
                                            break;
                                }

                                OnButtonEffect=0;
                            }
                        }
                }




            else if (Buton == LIMBA) // MENU LANGUAGE
            {
                    if(x >= coordLimba_Romana.x1 && x <= coordLimba_Romana.x2 && y >= coordLimba_Romana.y1 && y <= coordLimba_Romana.y2) // BUTON ROMANA
                    {
                        if(OnButtonEffect==0)
                        {
                            switch(Limba)
                            {
                                case RO:
                                    readimagefile("Jpg/EfecteButoane/Romana/Limba_Romana_Roman.jpg", 0, 0, maxx, maxy);
                                    break;
                                case ENG:
                                    readimagefile("Jpg/EfecteButoane/Romana/Limba_Engleza_Roman.jpg", 0, 0, maxx, maxy);
                                    break;
                                case FR:
                                    readimagefile("Jpg/EfecteButoane/Romana/Limba_Franceza_Roman.jpg", 0, 0, maxx, maxy);
                                    break;
                            }
                            OnButtonEffect=1;
                        }
                    }

                    else if(x >= coordLimba_Engleza.x1 && x <= coordLimba_Engleza.x2 && y >= coordLimba_Engleza.y1 && y <= coordLimba_Engleza.y2) // BUTON FRANCEZA
                    {
                        if(OnButtonEffect==0)
                        {
                            switch(Limba)
                            {
                                case RO:
                                    readimagefile("Jpg/EfecteButoane/Engleza/Limba_Romana_Englez.jpg", 0, 0, maxx, maxy);
                                    break;
                                case ENG:
                                    readimagefile("Jpg/EfecteButoane/Engleza/Limba_Engleza_Englez.jpg", 0, 0, maxx, maxy);
                                    break;
                                case FR:
                                    readimagefile("Jpg/EfecteButoane/Engleza/Limba_Franceza_Englez.jpg", 0, 0, maxx, maxy);
                                    break;
                            }
                            OnButtonEffect=1;
                        }
                    }

                    else if(x >= coordLimba_Franceza.x1 && x <= coordLimba_Franceza.x2 && y >= coordLimba_Franceza.y1 && y <= coordLimba_Franceza.y2) // BUTON ENGLEZA
                    {
                        if(OnButtonEffect==0)
                        {
                            switch(Limba)
                            {
                                case RO:
                                    readimagefile("Jpg/EfecteButoane/Franceza/Limba_Romana_Francez.jpg", 0, 0, maxx, maxy);
                                    break;
                                case ENG:
                                    readimagefile("Jpg/EfecteButoane/Franceza/Limba_Engleza_Francez.jpg", 0, 0, maxx, maxy);
                                    break;
                                case FR:
                                    readimagefile("Jpg/EfecteButoane/Franceza/Limba_Franceza_Francez.jpg", 0, 0, maxx, maxy);
                                    break;
                            }

                            OnButtonEffect=1;
                        }
                    }

                    else
                    {
                        if(OnButtonEffect==1)
                        {
                            switch(Limba)
                            {
                                case RO:
                                    readimagefile("Jpg/Romana/Limba_Romana.jpg", 0, 0, maxx, maxy);
                                    break;
                                case ENG:
                                    readimagefile("Jpg/Engleza/Limba_Engleza.jpg", 0, 0, maxx, maxy);
                                    break;
                                case FR:
                                    readimagefile("Jpg/Franceza/Limba_Franceza.jpg", 0, 0, maxx, maxy);
                                    break;
                            }

                            OnButtonEffect=0;
                        }
                    }
            }

        }

}

#endif // BUTTON_EFFECT_H_INCLUDED
