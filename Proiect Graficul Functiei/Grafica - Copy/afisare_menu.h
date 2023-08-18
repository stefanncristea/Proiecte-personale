#ifndef AFISARE_MENU_H_INCLUDED
#define AFISARE_MENU_H_INCLUDED

enum Butoane { MENU = 1, INCEPE, DESPRE, OPTIUNI, LIMBA, MUZICA, FUNCTIE };
Butoane Buton = MENU;

enum Limbi { RO = 1, FR, ENG };
Limbi Limba = RO;

void Afisare_Menu(Butoane &Buton, Limbi &Limba, int maxx, int maxy)
{
    Buton = MENU;
    switch (Limba)
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
}

#endif // AFISARE_MENU_H_INCLUDED
