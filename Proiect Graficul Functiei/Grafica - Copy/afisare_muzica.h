#ifndef AFISARE_MUZICA_H_INCLUDED
#define AFISARE_MUZICA_H_INCLUDED

void Afisare_Muzica( std::stack<int>&Stiva, Butoane &Buton , Limbi &Limba , int maxx, int maxy )
{
    Buton = MUZICA;
    Stiva.push(Buton);
    switch (Limba)
    {
    case RO:
        readimagefile("Jpg/Romana/Muzica_Romana.jpg", 0, 0, maxx, maxy);
        Limba = RO;
        break;

    case ENG:
        readimagefile("Jpg/Engleza/Muzica_Engleza.jpg", 0, 0, maxx, maxy);
        Limba = ENG;
        break;

    case FR:
        readimagefile("Jpg/Franceza/Muzica_Franceza.jpg", 0, 0, maxx, maxy);
        Limba = FR;
        break;
    }
}


#endif // AFISARE_MUZICA_H_INCLUDED
