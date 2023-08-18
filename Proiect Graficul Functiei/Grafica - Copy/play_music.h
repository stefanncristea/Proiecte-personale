#ifndef PLAY_MUSIC_H_INCLUDED
#define PLAY_MUSIC_H_INCLUDED

void Play_Music(short &MuzicaAleasa,bool &MUZICA_ON)
{
    switch(MuzicaAleasa)
    {
        case 1:
            if(MUZICA_ON == 1)
                mciSendString("play Muzica/1Muzica.mp3 repeat", NULL, 0, NULL); // https://www.youtube.com/watch?v=KCNH2is3x_c
            else
                mciSendString("Close Muzica/1Muzica.mp3", NULL, 0, NULL);
        break;
        case 2:
            if(MUZICA_ON == 1)
                mciSendString("play Muzica/2Muzica.mp3 repeat", NULL, 0, NULL); // https://www.youtube.com/watch?v=5K7Frc2lTI8
            else
                mciSendString("Close Muzica/2Muzica.mp3", NULL, 0, NULL);
        break;
        case 3:
            if(MUZICA_ON == 1)
                mciSendString("play Muzica/3Muzica.mp3 repeat", NULL, 0, NULL); // https://www.youtube.com/watch?v=R1JPUqYU0DA
            else
                mciSendString("Close Muzica/3Muzica.mp3", NULL, 0, NULL);
        break;
        case 4:
            if(MUZICA_ON == 1)
                mciSendString("play Muzica/4Muzica.mp3 repeat", NULL, 0, NULL); // https://www.youtube.com/watch?v=caIBKOztlAo
            else
                mciSendString("Close Muzica/4Muzica.mp3", NULL, 0, NULL);
        break;
        case 5:
            if(MUZICA_ON == 1)
                mciSendString("play Muzica/5Muzica.mp3 repeat", NULL, 0, NULL); // https://www.youtube.com/watch?v=UdRkAMCm-1M
            else
                mciSendString("Close Muzica/5Muzica.mp3", NULL, 0, NULL);
        break;
    }
}

#endif // PLAY_MUSIC_H_INCLUDED
