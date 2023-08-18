#ifndef PLAY_MUSIC_OFF_H_INCLUDED
#define PLAY_MUSIC_OFF_H_INCLUDED

#include "play_music.h"

void Play_Music_OFF(short &MuzicaAleasa,bool &MUZICA_ON)
{
    MUZICA_ON = 0;
    Play_Music(MuzicaAleasa, MUZICA_ON);
    MUZICA_ON = 1;
    Play_Music(MuzicaAleasa, MUZICA_ON);
    MUZICA_ON = 0;
    Play_Music(MuzicaAleasa, MUZICA_ON);
}

#endif // PLAY_MUSIC_OFF_H_INCLUDED
