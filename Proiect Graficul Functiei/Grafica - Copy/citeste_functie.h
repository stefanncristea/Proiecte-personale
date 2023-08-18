#ifndef CITESTE_FUNCTIE_H_INCLUDED
#define CITESTE_FUNCTIE_H_INCLUDED

#define MAX 50

#include "evaluator.h"
#include "corectitudine.h"
#include "afisare_menu.h"

using namespace std;

void Citeste_Functie(char s[MAX],int x, int y, int lungime, int latime, bool &errorf, short &ErrorType)
{
            strcpy(s,"");

            char s2[MAX];
                strcpy(s2,"");

            char s3[MAX];
                strcpy(s3,"");

            char s_aux[MAX];
                strcpy(s_aux,"");

            char t[2];
            char tasta;
            short rand = 1;
            bool LIMITA_CHENAR = 0;

    setcolor(COLOR(153,255,255)) , settextstyle(3, HORIZ_DIR, 4);

    do
    {

        if(strlen(s)==0)
            {
                Limba== RO ? setcolor(COLOR(153,255,255)) : Limba== ENG ? setcolor(COLOR(255,0,0)) : Limba== FR ? setcolor(COLOR(255,0,127)) : setcolor(COLOR(153,255,255));
                outtextxy(x,y,"_");
            }

        tasta=getch();

        if(strlen(s)==0)
            setcolor(BLACK) , outtextxy(x,y,"_");

        if (tasta==8) // backspace
        {
                    if(strlen(s3)==0 && rand==3)
                    {
                        y=y-latime/21.6;
                        rand=2;
                    }

                    if(strlen(s2)==0 && rand==2)
                    {
                        y=y-latime/21.6;
                        rand=1;
                    }

            if (strlen(s)>0 && rand==1)
            {
                setcolor(BLACK);
                outtextxy(x,y,s);
                s[strlen(s)-1]='\0';
                outtextxy(x,y,s);
                Limba== RO ? setcolor(COLOR(153,255,255)) : Limba== ENG ? setcolor(COLOR(153,0,0)) : Limba== FR ? setcolor(COLOR(204,0,102)) : setcolor(COLOR(153,255,255));
                outtextxy(x,y,s);
            }

            if (strlen(s2)>0 && rand==2)
            {
                setcolor(BLACK);
                outtextxy(x,y,s2);
                s2[strlen(s2)-1]='\0';
                outtextxy(x,y,s2);
                Limba== RO ? setcolor(COLOR(153,255,255)) : Limba== ENG ? setcolor(COLOR(153,0,0)) : Limba== FR ? setcolor(COLOR(255,0,127)) : setcolor(COLOR(153,255,255));
                outtextxy(x,y,s2);
            }

            if (strlen(s3)>0 && rand==3)
            {
                setcolor(BLACK);
                outtextxy(x,y,s3);
                s3[strlen(s3)-1]='\0';
                outtextxy(x,y,s3);
                Limba== RO ? setcolor(COLOR(153,255,255)) : Limba== ENG ? setcolor(COLOR(153,0,0)) : Limba== FR ? setcolor(COLOR(255,0,127)) : setcolor(COLOR(153,255,255));
                outtextxy(x,y,s3);
            }

         }
        else if(tasta != 27 && tasta != 13 && LIMITA_CHENAR == 0)
        {
            t[0]=tasta; t[1]='\0';
            switch(rand)
            {
                case 1:
                    strcat(s,t);
                    Limba== RO ? setcolor(COLOR(26,169,243)) : Limba== ENG ? setcolor(COLOR(255,0,0)) : Limba== FR ? setcolor(COLOR(255,0,127)) : setcolor(COLOR(153,255,255));
                    outtextxy(x,y,s);
                    break;
                case 2:
                    strcat(s2,t);
                    Limba== RO ? setcolor(COLOR(26,169,243)) : Limba== ENG ? setcolor(COLOR(255,0,0)) : Limba== FR ? setcolor(COLOR(255,0,127)) : setcolor(COLOR(153,255,255));
                    outtextxy(x,y,s2);
                    break;
                case 3:
                    strcat(s3,t);
                    Limba== RO ? setcolor(COLOR(26,169,243)) : Limba== ENG ? setcolor(COLOR(255,0,0)) : Limba== FR ? setcolor(COLOR(255,0,127)) : setcolor(COLOR(153,255,255));
                    outtextxy(x,y,s3);
                    break;
            }
        }

        if(rand==1)
            strcpy(s_aux,s);
        if(rand==2)
            strcpy(s_aux,s) , strcat(s_aux,s2);
        if(rand==3)
            strcpy(s_aux,s) , strcat(s_aux,s2), strcat(s_aux,s3);

        if(scrierecorecta(s_aux,errorf,ErrorType))
        {
            switch(ErrorType)
            {
                case 1:
                break;
                case 2:
                    switch(Limba)
                    {
                        case RO:
                            readimagefile("Jpg/Romana/EroriFunctie/Incepe_Romana_Error_Variable.jpg", 0, 0, lungime/3, latime);
                            break;
                        case ENG:
                            readimagefile("Jpg/Engleza/EroriFunctie/Incepe_Engleza_Error_Variable.jpg", 0, 0, lungime/3, latime);
                            break;
                        case FR:
                            readimagefile("Jpg/Franceza/EroriFunctie/Incepe_Franceza_Error_Variable.jpg", 0, 0, lungime/3, latime);
                            break;
                    }
                    break;
                case 3:
                    switch(Limba)
                    {
                        case RO:
                            readimagefile("Jpg/Romana/EroriFunctie/Incepe_Romana_Error_Typed.jpg", 0, 0, lungime/3, latime);
                            break;
                        case ENG:
                            readimagefile("Jpg/Engleza/EroriFunctie/Incepe_Engleza_Error_Typed.jpg", 0, 0, lungime/3, latime);
                            break;
                        case FR:
                            readimagefile("Jpg/Franceza/EroriFunctie/Incepe_Franceza_Error_Typed.jpg", 0, 0, lungime/3, latime);
                            break;
                    }
                    break;
                case 4:
                    switch(Limba)
                    {
                        case RO:
                            readimagefile("Jpg/Romana/EroriFunctie/Incepe_Romana_Error_Unknown.jpg", 0, 0, lungime/3, latime);
                            break;
                        case ENG:
                            readimagefile("Jpg/Engleza/EroriFunctie/Incepe_Engleza_Error_Unknown.jpg", 0, 0, lungime/3, latime);
                            break;
                        case FR:
                            readimagefile("Jpg/Franceza/EroriFunctie/Incepe_Franceza_Error_Unknown.jpg", 0, 0, lungime/3, latime);
                            break;
                    }
                    break;
                case 5:
                    switch(Limba)
                    {
                        case RO:
                            readimagefile("Jpg/Romana/EroriFunctie/Incepe_Romana_Error_Typed.jpg", 0, 0, lungime/3, latime);
                            break;
                        case ENG:
                            readimagefile("Jpg/Engleza/EroriFunctie/Incepe_Engleza_Error_Typed.jpg", 0, 0, lungime/3, latime);
                            break;
                        case FR:
                            readimagefile("Jpg/Franceza/EroriFunctie/Incepe_Franceza_Error_Typed.jpg", 0, 0, lungime/3, latime);
                            break;
                    }
                    break;
            }
        }
        else
        {
            switch(Limba)
            {
                case RO:
                    readimagefile("Jpg/Romana/EroriFunctie/Incepe_Romana_Error_Default.jpg", 0, 0, lungime/3, latime);
                    break;
                case ENG:
                    readimagefile("Jpg/Engleza/EroriFunctie/Incepe_Engleza_Error_Default.jpg", 0, 0, lungime/3, latime);
                    break;
                case FR:
                    readimagefile("Jpg/Engleza/EroriFunctie/Incepe_Franceza_Error_Default.jpg", 0, 0, lungime/3, latime);
                    break;
            }
        }

        if(textwidth(s)>lungime/5.81 && rand==1)
            y=y+latime/21.6, rand=2;

        else if(textwidth(s2)>lungime/5.81 && rand==2)
            y=y+latime/21.6, rand=3;

        if(textwidth(s3)>=lungime/5.81)
            LIMITA_CHENAR=1;
        else
            LIMITA_CHENAR=0;

    }while (tasta!=13&&tasta!=27);

    if(tasta==13 || tasta == 27){
            switch(Limba)
            {
                case RO:
                    readimagefile("Jpg/Romana/Incepe_Romana.jpg", 0, 0, lungime, latime);
                    break;
                case ENG:
                    readimagefile("Jpg/Engleza/Incepe_Engleza.jpg", 0, 0, lungime, latime);
                    break;
                case FR:
                    readimagefile("Jpg/Franceza/Incepe_Franceza.jpg", 0, 0, lungime, latime);
                    break;
            }
        }

    strcpy(s,s_aux);

    if(strcmp(s,"") && (tasta==13 || tasta==27) )
        ErrorType=2;

    scrierecorecta(s,errorf,ErrorType);
}

#endif // CITESTE_FUNCTIE_H_INCLUDED
