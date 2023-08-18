#ifndef AFISARE_LIMBA_H_INCLUDED
#define AFISARE_LIMBA_H_INCLUDED

void Afisare_Limba( std::stack<int>&Stiva, Butoane &Buton , Limbi &Limba , int maxx, int maxy )
{
    Buton = LIMBA;
    Stiva.push(Buton);
    switch (Limba)
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
}


#endif // AFISARE_LIMBA_H_INCLUDED
