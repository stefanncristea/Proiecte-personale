#ifndef CALCULEAZA_COORDONATE_H_INCLUDED
#define CALCULEAZA_COORDONATE_H_INCLUDED

struct Coordonate_Butoane
{
    float x1, x2, y1, y2;
};
Coordonate_Butoane coordIncepe, coordIncepeInfo, coordDespre;
Coordonate_Butoane coordOptiuni, coordON_OFF;
Coordonate_Butoane coordLimba, coordLimba_Romana, coordLimba_Engleza, coordLimba_Franceza;
Coordonate_Butoane coordMuzica, coordJukebox_1, coordJukebox_2, coordJukebox_3, coordJukebox_4, coordJukebox_5;


void Calculeaza_Coordonate(int lungime, int latime)
{

    // Coordonate

        //Coordonate Incepe (Start)

            coordIncepe.x1 = lungime / 2.57;
            coordIncepe.x2 = lungime / 1.5;
            coordIncepe.y1 = latime / 3.15;
            coordIncepe.y2 = latime / 2.20;

            coordIncepeInfo.x1 = lungime / 1.05;
            coordIncepeInfo.x2 = lungime / 1.005;
            coordIncepeInfo.y1 = latime / 54;
            coordIncepeInfo.y2 = latime / 10.8;


        //Coordonate Optiuni (Options)

            coordOptiuni.x1 = lungime / 2.57;
            coordOptiuni.x2 = lungime / 1.5;
            coordOptiuni.y1 = latime / 1.8;
            coordOptiuni.y2 = latime / 1.5;

        //Coordonate Despre (About)

            coordDespre.x1 = lungime / 2.5;
            coordDespre.x2 = lungime / 1.5;
            coordDespre.y1 = latime / 1.3;
            coordDespre.y2 = latime / 1.15;

        //Coordonate Limba (Language)

            coordLimba.x1 = lungime / 3;
            coordLimba.x2 = lungime / 1.5;
            coordLimba.y1 = latime / 2.47;
            coordLimba.y2 = latime / 2;

        //Coordonate Muzica (Music)

            coordMuzica.x1 = lungime / 2.65;
            coordMuzica.x2 = lungime / 1.6;
            coordMuzica.y1 = latime / 1.78;
            coordMuzica.y2 = latime / 1.5;

        //Coordonate ON/OFF

            coordON_OFF.x1 = lungime / 2.25;
            coordON_OFF.x2 = lungime / 1.76;
            coordON_OFF.y1 = latime / 1.42;
            coordON_OFF.y2 = latime / 1.25;

        //Coordonate Limba_Omuleti

            coordLimba_Romana.x1 = lungime / 29.5;
            coordLimba_Romana.x2 = lungime / 4.57;
            coordLimba_Romana.y1 = latime / 2.37;
            coordLimba_Romana.y2 = latime / 1.5;

            coordLimba_Franceza.x1 = lungime / 2.35;
            coordLimba_Franceza.x2 = lungime / 1.65;
            coordLimba_Franceza.y1 = latime / 3.25;
            coordLimba_Franceza.y2 = latime / 1.5;

            coordLimba_Engleza.x1 = lungime / 1.25;
            coordLimba_Engleza.x2 = lungime / 1.015;
            coordLimba_Engleza.y1 = latime / 3.08;
            coordLimba_Engleza.y2 = latime / 1.54;

        //Coordonate Juke_Boxes

            coordJukebox_1.x1 = lungime / 2.95;
            coordJukebox_1.x2 = lungime / 2.32;
            coordJukebox_1.y1 = latime / 2.3;
            coordJukebox_1.y2 = latime / 1.23;

            coordJukebox_2.x1 = lungime / 2.08;
            coordJukebox_2.x2 = lungime / 1.75;
            coordJukebox_2.y1 = latime / 2.3;
            coordJukebox_2.y2 = latime / 1.23;

            coordJukebox_3.x1 = lungime / 1.65;
            coordJukebox_3.x2 = lungime / 1.44;
            coordJukebox_3.y1 = latime / 2.3;
            coordJukebox_3.y2 = latime / 1.23;

            coordJukebox_4.x1 = lungime / 1.35;
            coordJukebox_4.x2 = lungime / 1.20;
            coordJukebox_4.y1 = latime / 2.3;
            coordJukebox_4.y2 = latime / 1.23;

            coordJukebox_5.x1 = lungime / 1.15;
            coordJukebox_5.x2 = lungime / 1.045;
            coordJukebox_5.y1 = latime / 2.27;
            coordJukebox_5.y2 = latime / 1.23;

}


#endif // CALCULEAZA_COORDONATE_H_INCLUDED
