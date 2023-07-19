#include <stdio.h>
#include <sys/socket.h>
#include <netinet/ip.h>
#include <sys/types.h>
#include <unistd.h>
#include <strings.h>
#include <stdlib.h>
#include <signal.h>
#include <wait.h>
#include <string.h>
#include <dirent.h>
#include <sys/stat.h>
#include <sys/errno.h>
#include <pwd.h>
#include <grp.h>
#include <time.h>
#include <openssl/aes.h>


int clientnr;

int nrlinii(char* NumeFisier)
{
    FILE *f = fopen(NumeFisier, "r");
    int nr_linii = 0,i;
    for(i = getc(f); i != EOF; i = getc(f) )
        if(i == '\n')
            nr_linii++;
    fclose(f);
    nr_linii++;
    return nr_linii;
}

void put_in_blacklist(char nume[])
{
    FILE *p = fopen("blacklist.txt", "a");
    char username[100];
    username[0] = 0;
    strcpy(username, nume);
    if(p == NULL)
        printf("%s\n", "Din motive tehnice, utilizatorul nu a putut fi pus pe lista neagra...");
    fprintf(p, "\n%s", nume);
    fclose(p);
}

int login(char nume[], char parola[])
{
    FILE *f = fopen("login.txt", "r");
    int nr_linii = nrlinii("login.txt"), i;
    char fnume[200],fparola[200];
    for(i = 0; i < nr_linii; i++)
    {
        fnume[0]=0;c
        fparola[0]=0;
        fscanf(f, "%s %s", fnume, fparola);
        if(strcmp(fnume, nume)==0 && strcmp(fparola, parola) == 0)
        {
            fclose(f);
            return 1;
        }
        fnume[0]=0;
        fparola[0]=0;
    }
    fclose(f);
    return 0;
}

int verif_blacklist(char nume[])
{
    FILE *f = fopen("blacklist.txt", "r");
    char username[50];
    int nr_linii = nrlinii("blacklist.txt");
    for(int i = 0; i < nr_linii; i++)
        {
            username[0] = 0;
            fscanf(f, "%s", username);
            if(strcmp(nume, username) == 0)
            {
                fclose(f);
                return 1;
            }
        }
    fclose(f);
    return 0;
}


int is_directory(char locatie[], char mesaj[])
{
    char cale[2000];
    cale[0] = 0;
    DIR *d = opendir(locatie);
    struct stat det;
    struct dirent *direc;
    if(d != NULL)
    {
        direc = readdir(d);
        while(direc = readdir(d))
        {
            if(strcmp(direc->d_name, mesaj) == 0)
            {
                strcpy(cale, locatie);
                strcat(cale, "/");
                strcat(cale, mesaj);
                stat(cale, &det);
                if(S_ISDIR(det.st_mode) != 0)
                {
                    closedir(d);
                    return 1;
                }
                else if(S_ISREG(det.st_mode) != 0)
                {
                    closedir(d);
                    return 0;
                }
            }
        }
        closedir(d);
    }
    else
        return 2;
    return 0;
}

int make_folder(char locatie[], char denumire[])
{
    char cale[2000];
    strcpy(cale, locatie);
    strcat(cale, denumire);
    if(mkdir(cale, 0777) == -1)
        return 0;
    else
        return 1;
}

int del_file(char locatie[], char mesaj[])
{
    char cale[2000];
    strcat(locatie, mesaj);
    strcpy(cale, locatie);
    if(unlink(cale) != 0 && is_directory(locatie, mesaj) == 0)
        return 0;
    return 1;
}

int new_fname(char locatie[], char numeinitial[], char numefinal[])
{
    char cale[2000], calenoua[2000], retinl[1000], retinn[200];
    cale[0] = calenoua[0] = retinl[0] = retinn[0] = 0;
    strcpy(retinl, locatie);
    strcpy(retinn, numeinitial);

    strcpy(cale, locatie);
    strcpy(calenoua, locatie);
    strcat(cale, numeinitial);
    strcat(calenoua, numefinal);
    printf("%s\n", cale);
    printf("%s\n", calenoua);

    if(rename(cale, calenoua) < 0)
        return 0;

    return 1;
}

int f_there(char locatie[], char mesaj[])
{
    DIR *d = opendir(locatie);
    struct dirent *direct;
    if(d != NULL)
    {
        while(direct = readdir(d))
            if(strcmp(mesaj, direct->d_name) == 0)
                return 1;
        closedir(d);
    }
    return 0;
}

int transfer_f(char locatie1[], char numeut[] , char numef[], char locatie2[])
{
    char verif[100];
    verif[0] = 0;
    strcpy(verif, "home/");
    strcat(verif, numeut);
    //nu este fisier
    if(is_directory(locatie1, numef) == 1)
        return 0;
    //nu exista locatia finala a fisierului
    if(strstr(locatie2, verif) == NULL)
        return -1;
    //fisierul ce se vrea a fi transferat nu exista in locatia data
    if(f_there(locatie1, numef) == 0)
        return -2;
    //este deja un fisier acolo cu acel nume(nume indisponibil)
    if(is_directory(locatie2, numef) == 1)
        return -3;
    if(f_there(locatie2, numef) == 1)
        return -3;
    int pid = fork();
    if(pid == 0)
    {
        FILE *f1, *f2;
        char cale[1000];
        cale[0] = 0;
        strcat(locatie1, "/");
        strcat(locatie1, numef);
        strcpy(cale, locatie1);
        strcat(locatie2, "/");
        strcat(locatie2, numef);
        f1 = fopen(cale, "r");
        f2 = fopen(locatie2, "w");

        unsigned char scop[1];
        scop[0] = 0;
        int lu = 0;
        while(1)
        {
            lu = fread(scop, 1, 1, f1);
            if(lu > 0)
                fwrite(scop, 1, lu, f2);
            if(lu == 0)
            {
                if(feof(f1))
                {
                    fclose(f1);
                    fclose(f2);
                    unlink(cale);
                    break;
                }

                if(ferror(f1))
                {
                    fclose(f1);
                    fclose(f2);
                    break;
                }
            }
        }
        exit(1);
    }
    return 1;
}

int make_file(char locatie[], char denumire[])
{
    char cale[1000];
    strcpy(cale, locatie);
    strcat(cale, denumire);
    if(is_directory(locatie, denumire))
        return 0;
    if(f_there(locatie, denumire))
        return 0;
    FILE *f = fopen(cale, "w");
    return 1;
}

int menu(char locatie[], int clientsocket)
{
    DIR *d = opendir(locatie);
    char cale[1000];
    struct dirent *direc;
    struct stat fstat;
    int tot = 1, size;

    if(d != NULL)
    {
        write(clientsocket, &tot, sizeof(int));

        while(direc = readdir(d))
        {
            if(strcmp(direc->d_name, ".") != 0 && strcmp(direc->d_name, "..") != 0)
            {

                tot = 1;
                cale[0] = 0;

                strcpy(cale, locatie);
                strcat(cale, direc->d_name);

                stat(cale, &fstat);
                if(S_ISDIR(fstat.st_mode) != 0)
                    tot = 2;
                if(S_ISREG(fstat.st_mode) != 0)
                    tot = 3;

                write(clientsocket, &tot, sizeof(int));
                size = strlen(direc->d_name) + 1;
                write(clientsocket, &size, sizeof(int));
                write(clientsocket, direc->d_name, size);
            }
            tot = 1;
        }
        tot = 0;
        write(clientsocket, &tot, sizeof(int));
        closedir(d);
        return 1;
    }
    return 0;
}

int main()
{
    int serversocket;
    struct sockaddr_in svaddress;
    struct sockaddr_in info;
    bzero(&svaddress, sizeof (svaddress));
    bzero(&info, sizeof (info));

    clientnr = 0;


    if((serversocket = socket (AF_INET, SOCK_STREAM, 0)) == -1)
    {
        perror("Eroare la functia connect() in server.\n");
        return 0;
    }

    //urmeaza sa umplem socket-ul serverului
    svaddress.sin_family = AF_INET;
    svaddress.sin_port = htons(2030);
    svaddress.sin_addr.s_addr = htonl(INADDR_ANY);

    //incercam sa reutilizam adresa
    int ok = 1;
    if(setsockopt(serversocket, SOL_SOCKET, SO_REUSEADDR, &ok, sizeof(int)) < 0)
    {
        perror("Eroare la incercarea reutilizarii adresei in server.\n");
        return 0;
    }

    //socketul se ataseaza
    if (bind (serversocket, (struct sockaddr *) &svaddress, sizeof (struct sockaddr)) == -1)
    {
      perror("Socket-ul nu a putut fi atasat in server.\n");
      return 0;
    }


    if(listen(serversocket, 5) == -1) //serverul asteapta
    {
        perror("Eroare la listen() in server.\n");
        return 0;
    }
    fflush(stdout);

    printf("%s\n", "Serverul asteapta clientii...");
    printf("%s", "\n");


    while(1)
    {
        int clientsocket;
        int nr = sizeof(info);

        clientsocket = accept(serversocket, (struct sockaddr*) &info, &nr);
        if(clientsocket < 0)
            printf("%s", "Socketul clientului nu a putut fi acceptat.\n");

        //facem fork ignorand parintele
        int prc;
        prc = fork();

        if(prc == -1)
        {
            printf("%s", "Eroare la fork");
            return 0;
        }

        clientnr ++;
        if(prc > 0)
        {
            ;
            //waitpid;
        }
        if(prc == 0) //copilul
        {
            close(serversocket);
            char nume[200],parola[200], mesaj[200], raspuns[200], cale[2000];
            int logat = 0, blacklist = 0, size;

            cale[0] = 0;
            strcpy(cale, "home/\0");

            printf("%s", "Clientul cu numarul ");
            printf("%d", clientnr);
            printf("%s", " s-a conectat la server!\n");

            while(1)
            {
                mesaj[0] = 0;
                if (read(clientsocket, &size, sizeof(int)) == -1)
                    printf("%s\n", "Eroare le citirea dimensiunii comenzii");


                if (read(clientsocket, mesaj, size) == -1)
                {    //deconectare fara exit a clientului
                     printf("%s.\n","Eroare la citirea comenzii date de client.\n");
                     close(clientsocket);
                     printf("%s", "A iesit clientul cu numarul: ");
                     printf("%d\n", clientnr);
                     exit(1);
                }

                mesaj[size] = 0;

                if(logat == 0 && strcmp(mesaj, "login") == 0)
                {
                    nume[0] = 0;
                    parola[0] = 0;
                    raspuns[0] = 0;
                    size = strlen("login");
                    strcpy(raspuns, "login");

                    write(clientsocket, &size, sizeof(int)); //trimitem la client faptul ca utilizatorul vrea sa se logheze pentru a-i cere datele
                    write(clientsocket, raspuns, size);
                    raspuns[0] = 0;
                    //incepem sa preluam datele(nume si parola)
                    read(clientsocket, &size, sizeof(int));
                    read(clientsocket, nume, size);
                    nume[size] = 0;
                    read(clientsocket, &size, sizeof(int));
                    read(clientsocket, parola, size);
                    parola[size] = 0;
                    if(login(nume, parola) == 1)//daca numele si parola au fost gasite in baza de date
                    {
                        logat = 1;
                        size = strlen("reusit");
                        strcpy(raspuns, "reusit");
                        write(clientsocket, &size, sizeof(int));
                        write(clientsocket, raspuns, size);
                        strcat(cale, nume);
                        strcat(cale, "/");
                        blacklist = verif_blacklist(nume);
                        int listaneagra = blacklist;
                        write(clientsocket, &listaneagra, sizeof(int));
                    }
                    else
                    {
                      size = strlen("esuat");
                      strcpy(raspuns, "esuat");
                      write(clientsocket, &size, sizeof(int));
                      write(clientsocket, raspuns, size);
                    }
                }

                if(strcmp(mesaj, "exit") == 0)
                {
                    size = strlen("exit");
                    raspuns[0] = 0;
                    strcpy(raspuns, "exit");
                    write(clientsocket, &size, sizeof(int));
                    write(clientsocket, raspuns, size);
                    close(clientsocket);
                    printf("%s", "S-a deconectat clientul cu numarul: ");
                    printf("%d\n", clientnr);
                    exit(1);
                }

                if(logat == 1 && strcmp(mesaj, "help") == 0)
                {
                    raspuns[0] = 0;
                    size = strlen("help");
                    strcpy(raspuns, "help");
                    write(clientsocket, &size, sizeof(int));
                    write(clientsocket, raspuns, size);
                }

                if(logat == 1 && strcmp(mesaj, "disconnect") == 0)
                {
                    raspuns[0] = 0;
                    strcpy(raspuns, "disconnect");
                    size = strlen("disconnect");
                    write(clientsocket, &size, sizeof(int));
                    write(clientsocket, raspuns, size);
                    logat = 0;
                    blacklist = 0;
                    cale[0] = 0;
                    strcpy(cale, "home/\0");
                    nume[0] = 0;
                    parola[0] = 0;
                }

                if(logat == 1 && strcmp(mesaj, "blacklist") == 0)
                {
                    char newname[200];
                    read(clientsocket, &size, sizeof(int));
                    read(clientsocket, newname, size);
                    put_in_blacklist(newname);
                    size = strlen("added");
                    raspuns[0] = 0;
                    strcpy(raspuns, "added");
                    write(clientsocket, &size, sizeof(int));
                    write(clientsocket, raspuns, size);
                }

                if(logat == 1 && strcmp(mesaj, "makefolder") == 0)
                {
                    int ok;
                    raspuns[0] = 0;
                    mesaj[0] = 0;
                    size = strlen("makefolder");
                    strcpy(raspuns, "makefolder");
                    write(clientsocket, &size, sizeof(int));
                    write(clientsocket, raspuns, size);
                    read(clientsocket, &size, sizeof(int));
                    read(clientsocket, mesaj, size);
                    mesaj[size] = 0;
                    ok = make_folder(cale, mesaj);
                    write(clientsocket, &ok, sizeof(int));
                }

                if(logat == 1 && strcmp(mesaj, "makefile") == 0)
                {
                    int ok;
                    raspuns[0] = 0;
                    mesaj[0] = 0;
                    size = strlen("makefile");
                    strcpy(raspuns, "makefile");
                    write(clientsocket, &size, sizeof(int));
                    write(clientsocket, raspuns, size);
                    read(clientsocket, &size, sizeof(int));
                    read(clientsocket, mesaj, size);
                    mesaj[size] = 0;
                    ok = make_file(cale, mesaj);
                    write(clientsocket, &ok, sizeof(int));
                }

                if(logat == 1 && strcmp(mesaj, "deletefile") == 0)
                {
                    int ok;
                    raspuns[0] = 0;
                    mesaj[0] = 0;
                    size = strlen("deletefile");
                    strcpy(raspuns, "deletefile");
                    write(clientsocket, &size, sizeof(int));
                    write(clientsocket, raspuns, size);
                    read(clientsocket, &size, sizeof(int));
                    read(clientsocket, mesaj, size);
                    mesaj[size] = 0;
                    ok = del_file(cale, mesaj);
                    write(clientsocket, &ok, sizeof(int));
                }

                if(logat == 1 && strcmp(mesaj, "newfname") == 0)
                {
                    int ok;
                    char mesaj2[200];
                    raspuns[0] = 0;
                    mesaj[0] = 0;
                    mesaj2[0] = 0;
                    size = strlen("newfname");
                    strcpy(raspuns, "newfname");
                    write(clientsocket, &size, sizeof(int));
                    write(clientsocket, raspuns, size);
                    read(clientsocket, &size, sizeof(int));
                    read(clientsocket, mesaj, size);
                    mesaj[size] = 0;
                    read(clientsocket, &size, sizeof(int));
                    read(clientsocket, mesaj2, size);
                    mesaj2[size] = 0;
                    ok = new_fname(cale, mesaj, mesaj2);
                    printf("%d\n", ok);
                    write(clientsocket, &ok, sizeof(int));
                }

                if(logat == 1 && strcmp(mesaj,"getfile") == 0)
                {
                    raspuns[0] = 0;
                    size = strlen("getfile");
                    strcpy(raspuns, "getfile");
                    write(clientsocket, &size, sizeof(int));
                    write(clientsocket, raspuns, size);
                }

                if(logat == 1 && strcmp(mesaj, "enter") == 0)
                {
                    int ok;
                    raspuns[0] = 0;
                    size = strlen("enter");
                    strcpy(raspuns, "enter");
                    write(clientsocket, &size, sizeof(int));
                    write(clientsocket, raspuns, size);
                    read(clientsocket, &size, sizeof(int));
                    read(clientsocket, mesaj, size);
                    mesaj[size] = 0;

                    if(is_directory(cale, mesaj) == 1)
                    {
                        strcat(cale, "/");
                        strcat(cale, mesaj);
                        ok = 1;
                        write(clientsocket, &ok, sizeof(int));
                    }
                    else
                    {
                        ok = 0;
                        write(clientsocket, &ok, sizeof(int));
                    }
                }

                if(logat == 1 && strcmp(mesaj, "leave") == 0)
                {
                    int ok, poz = 0;
                    size = strlen("leave");
                    raspuns[0] = 0;
                    strcpy(raspuns, "leave");
                    write(clientsocket, &size, sizeof(int));
                    write(clientsocket, raspuns, size);
                    int counter = 0;
                    for(int i = 0; i < strlen(cale); i++)
                        if(cale[i] == '/')
                        {
                            counter ++;
                            poz = i;
                        }
                    if(counter >= 2)
                        ok = 1;
                    else
                        ok = 0;
                    if(ok)
                        cale[poz] = 0;
                    write(clientsocket, &ok, sizeof(int));
                }

                if(logat == 1 && strcmp(mesaj, "show") == 0)
                 {
                    raspuns[0] = 0;
                    strcpy(raspuns, "show");
                    size = strlen("show");
                    write(clientsocket, &size, sizeof(int));
                    write(clientsocket, raspuns, size);
                    int status = menu(cale, clientsocket);
                    if(status == 0)
                    {
                        write(clientsocket, &status, sizeof(int));
                        raspuns[0] = 0;
                        strcpy(raspuns, "Nu s-a putut lista directorul actual.");
                        size = strlen(raspuns);
                        write(clientsocket, &size, sizeof(int));
                        write(clientsocket, raspuns, size);
                    }
                 }

                if(logat == 1 && strcmp(mesaj, "filetransfer") == 0)
                {
                    int ok;
                    char locinit[200], locfin[200], numef[200], numeut[200];
                    raspuns[0] = 0;
                    locinit[0] = 0;
                    locfin[0] = 0;
                    numeut[0] = 0;
                    numef[0] = 0;
                    size = strlen("transff");
                    strcpy(raspuns, "transff");
                    write(clientsocket, &size, sizeof(int));
                    write(clientsocket, raspuns, size);
                    read(clientsocket, &size, sizeof(int));
                    read(clientsocket, locinit, size);
                    locinit[size] = 0;
                    read(clientsocket, &size, sizeof(int));
                    read(clientsocket, numef, size);
                    numef[size] = 0;
                    read(clientsocket, &size, sizeof(int));
                    read(clientsocket, numeut, size);
                    numeut[size] = 0;
                    read(clientsocket, &size, sizeof(int));
                    read(clientsocket, locfin, size);
                    locfin[size] = 0;
                    ok = transfer_f(locinit, numeut, numef, locfin);
                    printf("%d\n", ok);
                    write(clientsocket, &ok, sizeof(int));
                }
             }
        }

    }
}





