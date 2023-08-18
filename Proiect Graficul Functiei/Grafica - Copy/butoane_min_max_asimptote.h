#ifndef BUTOANE_MIN_MAX_ASIMPTOTE_H_INCLUDED
#define BUTOANE_MIN_MAX_ASIMPTOTE_H_INCLUDED


Butoane_Min_Max_Asimptote(int lungime, int latime, bool AsimptotaON, bool MaxON, bool MinON)
{
            readimagefile("Jpg/Romana/Functie/Sageata_Functie.gif", 0, 0, 70, 50);
            readimagefile("Jpg/Romana/Functie/Minus_Plus.gif", lungime-lungime/12.75, latime-latime/13.9, lungime, latime);

            if(AsimptotaON)
                readimagefile("Jpg/Romana/Functie/Asimptote_ON.gif", 10, latime-latime/13.9, lungime-lungime/1.13, latime-10);
            else
                readimagefile("Jpg/Romana/Functie/Asimptote.gif", 10, latime-latime/13.9, lungime-lungime/1.13, latime-10);

            if(MaxON)
                readimagefile("Jpg/Romana/Functie/Max_ON.gif", lungime-lungime/1.135, latime-latime/13.9, lungime-lungime/1.07, latime-10);
            else
                readimagefile("Jpg/Romana/Functie/Max.gif", lungime-lungime/1.135, latime-latime/13.9, lungime-lungime/1.07, latime-10);

            if(MinON)
                readimagefile("Jpg/Romana/Functie/Min_ON.gif", lungime-lungime/1.21, latime-latime/13.9, lungime-lungime/1.3, latime-10);
            else
                readimagefile("Jpg/Romana/Functie/Min.gif", lungime-lungime/1.21, latime-latime/13.9, lungime-lungime/1.3, latime-10);
}


#endif // BUTOANE_MIN_MAX_ASIMPTOTE_H_INCLUDED
