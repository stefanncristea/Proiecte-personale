#ifndef AFISARE_ON_OFF_H_INCLUDED
#define AFISARE_ON_OFF_H_INCLUDED

void Afisare_ON_OFF( Limbi Limba, bool MUZICA_ON, int maxx, int maxy )
{
    switch (Limba)
    {
    case RO:
        if (MUZICA_ON)
            readimagefile("Jpg/Romana/Optiuni_Romana_On.jpg", 0, 0, maxx, maxy);
        else
            readimagefile("Jpg/Romana/Optiuni_Romana_Off.jpg", 0, 0, maxx, maxy);
        break;

    case ENG:
        if (MUZICA_ON)
            readimagefile("Jpg/Engleza/Optiuni_Engleza_On.jpg", 0, 0, maxx, maxy);
        else
            readimagefile("Jpg/Engleza/Optiuni_Engleza_Off.jpg", 0, 0, maxx, maxy);
        break;

    case FR:
        if (MUZICA_ON)
            readimagefile("Jpg/Franceza/Optiuni_Franceza_On.jpg", 0, 0, maxx, maxy);
        else
            readimagefile("Jpg/Franceza/Optiuni_Franceza_Off.jpg", 0, 0, maxx, maxy);
        break;
    }
}

#endif // AFISARE_ON_OFF_H_INCLUDED
