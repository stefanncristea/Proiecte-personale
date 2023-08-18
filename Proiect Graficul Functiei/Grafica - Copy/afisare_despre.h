#ifndef AFISARE_DESPRE_H_INCLUDED
#define AFISARE_DESPRE_H_INCLUDED

void Afisare_Despre( std::stack<int>&Stiva, Butoane &Buton , Limbi &Limba , int maxx, int maxy)
{

    Buton = DESPRE;
    Stiva.push(Buton);
    switch (Limba)
    {
    case RO:
        readimagefile("Jpg/Romana/Despre_Romana.jpg", 0, 0, maxx, maxy);
        break;

    case ENG:
        readimagefile("Jpg/Engleza/Despre_Engleza.jpg", 0, 0, maxx, maxy);
        break;

    case FR:
        readimagefile("Jpg/Franceza/Despre_Franceza.jpg", 0, 0, maxx, maxy);
        break;
    }
}


#endif // AFISARE_DESPRE_H_INCLUDED
