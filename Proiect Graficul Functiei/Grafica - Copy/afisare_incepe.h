#ifndef AFISARE_INCEPE_H_INCLUDED
#define AFISARE_INCEPE_H_INCLUDED

using namespace std;

void Afisare_Incepe( std::stack<int>&Stiva, Butoane &Buton , Limbi &Limba , int maxx, int maxy )
{
    Buton = INCEPE;
    Stiva.push(Buton);
    switch (Limba)
    {
    case RO:
        readimagefile("Jpg/Romana/Incepe_Romana.jpg", 0, 0, maxx, maxy);
        readimagefile("Jpg/Romana/EroriFunctie/Incepe_Romana_Error_Default.jpg", 0, 0, maxx/3, maxy);
        break;

    case ENG:
        readimagefile("Jpg/Engleza/Incepe_Engleza.jpg", 0, 0, maxx, maxy);
        readimagefile("Jpg/Engleza/EroriFunctie/Incepe_Engleza_Error_Default.jpg", 0, 0, maxx/3, maxy);
        break;

    case FR:
        readimagefile("Jpg/Franceza/Incepe_Franceza.jpg", 0, 0, maxx, maxy);
        readimagefile("Jpg/Franceza/EroriFunctie/Incepe_Franceza_Error_Default.jpg", 0, 0, maxx/3, maxy);
        break;
    }

}

#endif // AFISARE_INCEPE_H_INCLUDED
