#include <stdio.h>
#include <sys/socket.h>
#include <netinet/ip.h>
#include <arpa/inet.h>
#include <unistd.h>
#include <string.h>
#include <dirent.h>
#include <stdlib.h>
#include <sys/stat.h>
#include <pwd.h>
#include <grp.h>
#include <time.h>
#include <stdlib.h>
#include <wait.h>
#include <signal.h>
#include <openssl/aes.h>


int comanda_valida(char v[][50], int n, char comanda[])
{
    int i;
    for(i = 1; i <= n; i++)
        if(strcmp(v[i],comanda) == 0)
            return 1;
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

void get_f(char locatie1[], char numef[], char locatie2[])
{
    //nu este fisier
    if(is_directory(locatie1, numef) == 1)
    {
        printf("%s\n", "Fisierul selectat este de fapt un director!");
        return;
    }
    //fisierul ce se vrea a fi transferat nu exista in locatia data
    if(f_there(locatie1, numef) == 0)
    {
        printf("%s\n", "Nu exista fisierul selectat in locatia selectata!");
        return;
    }
    //este deja un fisier acolo cu acel nume(nume indisponibil)
    if(is_directory(locatie2, numef) == 1)
    {
        printf("%s\n", "Exista deja un director cu acel nume in locatia finala!");
        return;
    }
    if(f_there(locatie2, numef) == 1)
    {
        printf("%s\n", "Exista deja un fisier cu acel nume in locatia finala!");
        return;
    }
    int pid = fork();
    if(pid < 0)
    {
        return;
    }
    if(pid == 0)
    {
        FILE *f1, *f2;
        char caleinit[1000], calefin[1000];
        caleinit[0] = 0;
        calefin[0] = 0;
        strcpy(caleinit, locatie1);
        strcat(caleinit, "/");
        strcat(caleinit, numef);
        strcpy(calefin, locatie2);
        strcat(calefin, "/");
        strcat(calefin, numef);
        f1 = fopen(caleinit, "r");
        f2 = fopen(calefin, "w");

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
                    unlink(caleinit);
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
    return;
}

int main()
{
    struct sockaddr_in myaddress;
    int clientsocket;
    char nume[200], parola[200], comanda[200], svrasp[200], mesaj[200], path[1000];
    int status, logat = 0, blacklist = 0, size, nrcomenzi, attempt = 0;
    char v[50][50];

    clientsocket = socket (AF_INET, SOCK_STREAM, 0); //creare socket

    if(clientsocket == -1)
    {
        perror("Eroare la functia socket().\n");
        return 0;
    }
    //urmeaza sa umplem socket-ul
    
    myaddress.sin_family = AF_INET;
    myaddress.sin_port = htons(2030);                   
    myaddress.sin_addr.s_addr = inet_addr("127.0.0.1");

    
    if(connect(clientsocket, (struct sockaddr *) &myaddress, sizeof (struct sockaddr)) == -1)
    {
        perror("Eroare la functia connect() in client.\n");
        return 0;
    }

    strcpy(v[1], "login\0");
    strcpy(v[2], "disconnect\0");
    strcpy(v[3], "exit\0");
    strcpy(v[4], "help\0");
    strcpy(v[5], "filetransfer\0");
    strcpy(v[6], "show\0");
    strcpy(v[7], "makefolder\0");
    strcpy(v[8], "deletefile\0");
    strcpy(v[9], "newfname\0");
    strcpy(v[10], "enter\0");
    strcpy(v[11], "leave\0");
    strcpy(v[12], "getfile\0");
    strcpy(v[13], "makefile");
    nrcomenzi = 13;

    while(1)
    {
        comanda[0] = 0;
        printf("%s", "Introduceti comanda dorita: ");
        scanf("%s", comanda);
        size = strlen(comanda);
        
        svrasp[0] = 0;
        
        //nu este logat
        if(strcmp(comanda, "filetransfer") == 0 && logat == 0)
            printf("%s\n", "Trebuie sa fiti logat pentru a folosi aceasta comanda!");
        if(strcmp(comanda, "newfname") == 0 && logat == 0)
            printf("%s\n", "Trebuie sa fiti logat pentru a folosi aceasta comanda!");
        if(strcmp(comanda, "show") == 0 && logat == 0)
            printf("%s\n", "Trebuie sa fiti logat pentru a folosi aceasta comanda!");
        if(strcmp(comanda, "deletefile") == 0 && logat == 0)
            printf("%s\n", "Trebuie sa fiti logat pentru a folosi aceasta comanda!");
        if(strcmp(comanda, "enter") == 0 && logat == 0)
            printf("%s\n", "Trebuie sa fiti logat pentru a folosi aceasta comanda!");
        if(strcmp(comanda, "leave") == 0 && logat == 0)
            printf("%s\n", "Trebuie sa fiti logat pentru a folosi aceasta comanda!");
        if(strcmp(comanda, "makefolder") == 0 && logat == 0)
            printf("%s\n", "Trebuie sa fiti logat pentru a folosi aceasta comanda!");
        if(strcmp(comanda, "makefile") == 0 && logat == 0)
            printf("%s\n", "Trebuie sa fiti logat pentru a folosi aceasta comanda!");
        if(strcmp(comanda, "disconnect") == 0 && logat == 0)
            printf("%s\n", "Trebuie sa fiti logat pentru a folosi aceasta comanda!");
        if(strcmp(comanda, "getfile") == 0 && logat == 0)
            printf("%s\n", "Trebuie sa fiti logat pentru a folosi aceasta comanda!");

        //deja logat
        if(strcmp(comanda, "login") == 0 && logat == 1)
            printf("%s\n", "Sunteti deja logat!");

        //este pe blacklist
        if(strcmp(comanda, "filetransfer") == 0 && logat == 1 && blacklist == 1)
            printf("%s\n", "Aceasta comanda nu este disponibila pentru dumneavoastra!");
        if(strcmp(comanda, "leave") == 0 && logat == 1 && blacklist == 1)
            printf("%s\n", "Aceasta comanda nu este disponibila pentru dumneavoastra!");
        if(strcmp(comanda, "enter") == 0 && logat == 1 && blacklist == 1)
            printf("%s\n", "Aceasta comanda nu este disponibila pentru dumneavoastra!");
        if(strcmp(comanda, "newfname") == 0 && logat == 1 && blacklist == 1)
            printf("%s\n", "Aceasta comanda nu este disponibila pentru dumneavoastra!");
        if(strcmp(comanda, "deletefile") == 0 && logat == 1 && blacklist == 1)
            printf("%s\n", "Aceasta comanda nu este disponibila pentru dumneavoastra!");
        if(strcmp(comanda, "makefolder") == 0 && logat == 1 && blacklist == 1)
            printf("%s\n", "Aceasta comanda nu este disponibila pentru dumneavoastra!");
        if(strcmp(comanda, "makefile") == 0 && logat == 1 && blacklist == 1)
            printf("%s\n", "Aceasta comanda nu este disponibila pentru dumneavoastra!");
        if(strcmp(comanda, "getfile") == 0 && logat == 1 && blacklist == 1)
            printf("%s\n", "Aceasta comanda nu este disponibila pentru dumneavoastra!");

        if(!comanda_valida(v, nrcomenzi, comanda))
        {
            printf("Comanda introdusa nu exista.\n");
            attempt++;
        }
        else if(comanda_valida(v, nrcomenzi, comanda) && ((logat == 0 && strcmp(comanda, "login") == 0) || (logat == 1 && strcmp(comanda, "login") !=0) || (logat == 1 && blacklist == 1)))
        {
            attempt = 0;
            if (write(clientsocket, &size ,sizeof(int)) <= 0)
             {
               perror ("Eroare la scrierea mesajului spre server.\n");
               return 0;
            }

            if(write(clientsocket, comanda, size) <= 0)
            {
                printf(" %s","Eroare la expedierea comenzii spre server.\n");
                return 0;
            }   

        
            if(read(clientsocket, &size, sizeof(int)) <= 0)
                printf("%s", "Eroare la citirea lungimii raspunsului dat de server.\n");

            if(read(clientsocket, svrasp, size) <= 0)
                printf("%s", "Eroare la citirea raspunsului dat de server.\n");
            svrasp[size] = 0;
        }
        if(attempt >= 3 && logat == 1 && blacklist == 0)
        {
            size = strlen("blacklist");
            strcpy(comanda, "blacklist");
            write(clientsocket, &size ,sizeof(int));
            write(clientsocket, comanda, size);
            size = strlen(nume);
            write(clientsocket, &size, sizeof(int));
            write(clientsocket, nume, size);
            svrasp[0] = 0;
            read(clientsocket, &size, sizeof(int));
            read(clientsocket, svrasp, size);
            svrasp[size] = 0;
        }

        //comenzile pentru server
        if(strcmp(svrasp, "added") == 0)
        {
            blacklist = 1;
            printf("%s\n", "Ati fost adaugat pe lista neagra! Unele comenzi sunt acum indisponibile pentru dumneavoastra.");
            printf("%s\n", "Comenzi disponibile: disconnect, help, exit");
        }

        if(strcmp(svrasp, "exit") == 0)
        {
            close(clientsocket);
            return 0;
        }

        if(logat == 1 && strcmp(svrasp, "getfile") == 0)
        {
            char locatia1[1000], locatia2[1000], numele[1000];
            printf("%s", "Introduceti locatia initiala: ");
            scanf("%s", locatia1);
            printf("%s", "Introduceti numele fisierului ce urmeaza a fi transferat: ");
            scanf("%s", numele);
            printf("%s", "Introduceti locatia finala: ");
            scanf("%s", locatia2);
            get_f(locatia1, numele, locatia2);
        }

        if(logat == 1 && strcmp(svrasp, "help") == 0)
        {
            printf("%s\n", "***********************************************************");
            printf("%s\n", "show -> listeaza folderul curent");
            printf("%s\n", "enter -> acceseaza directorul ales");
            printf("%s\n", "leave -> paraseste directorul curent");
            printf("%s\n", "deletefile -> sterge un fisier ales din directorul curent");
            printf("%s\n", "newfname -> schimba numele un fisier ales");
            printf("%s\n", "makefolder -> creeaza un folder");
            printf("%s\n", "makefile -> face un fisier");
            printf("%s\n", "filetransfer -> transfera un fisier");
            printf("%s\n", "getfile -> ia un fisier din server");
            printf("%s\n", "***********************************************************");
        }

        if(logat == 1 && strcmp(svrasp, "disconnect") == 0)
        {
            logat = 0;
            blacklist = 0;
            printf("%s\n", "V-ati deconectat cu succes!");
        }

        if(logat == 0 && strcmp(svrasp, "login") == 0)
        {
            printf("%s", "Introduceti numele de utilizator: ");
            scanf("%s", nume);
            printf("%s", "Introduceti parola: ");
            scanf("%s", parola);
            size = strlen(nume) + 1;
            write(clientsocket, &size, sizeof(int));
            write(clientsocket, nume, size);
            size = strlen(parola)+1;
            write(clientsocket, &size, sizeof(int));
            write(clientsocket, parola, size);
            svrasp[0] = 0;
            read(clientsocket, &size, sizeof(int));
            read(clientsocket, svrasp, size);
            svrasp[size] = 0;
            if(strcmp(svrasp,"esuat") == 0)
                printf("%s", "Datele de conectare introduse sunt incorecte.\n");
            if(strcmp(svrasp,"logat") == 0)
                printf("%s", "Sunteti deja logat cu aceste date de intrare.\n");
            if(strcmp(svrasp, "reusit") == 0)
            {
                logat = 1;
                printf("%s\n", "V-ati logat cu succes!");
                read(clientsocket, &blacklist, sizeof(int));
                if(blacklist == 1)
                {
                    printf("%s\n", "Sunteti pe lista neagra!");
                    printf("%s\n", "Comenzi disponibile: disconnect, help, exit .");
                }
                else
                {
                    printf("%s", "Comenzile care va stau la dispozitie sunt:");
                    for(int i = 1; i < nrcomenzi; i++)
                    {
                        printf("%s%s"," ", v[i]);
                    }
                    printf("%s", "\n");
                }
            }
        }

        if(logat == 1 && strcmp(svrasp, "makefolder") == 0)
         {
             mesaj[0] = 0;
             int succes;
             printf("%s", "Introduceti numele folderului pe care doriti sa il creati: ");
             scanf("%s", mesaj);
             size = strlen(mesaj) + 1;
             write(clientsocket, &size, sizeof(int));
             write(clientsocket, mesaj, size);
             read(clientsocket, &succes, sizeof(int));
                
            if(succes == 1)
                printf("%s\n", "Succes! Folderul a fost creat.");
            else
                printf("%s\n", "Eroare! Folderul nu a putut fi creat.");
          }

        if(logat == 1 && strcmp(svrasp, "deletefile") == 0)
         {
             mesaj[0] = 0;
             int succes;
             printf("%s", "Introduceti numele fisierului pe care doriti sa il stergeti: ");
             scanf("%s", mesaj);
             size = strlen(mesaj) + 1;
             write(clientsocket, &size, sizeof(int));
             write(clientsocket, mesaj, size);
             read(clientsocket, &succes, sizeof(int));
                
             if(succes == 1)
                  printf("%s\n", "Succes! Fisierul a fost sters.");
             else
                  printf("%s\n", "Eroare! Fisierul nu a putut fi sters.");
          }

        if(logat == 1 && strcmp(svrasp, "newfname") == 0)
         {
             char numenou[200];
             numenou[0] = 0;
             mesaj[0] = 0;
             int succes;
             printf("%s", "Introduceti numele fisierului caruia doriti sa-i schimbati numele: ");
             scanf("%s", mesaj);
             printf("%s", "Introduceti noul nume al fisierului: ");
             scanf("%s", numenou);
             size = strlen(mesaj) + 1;
             int size2 = strlen(numenou);
             write(clientsocket, &size, sizeof(int));
             write(clientsocket, mesaj, size);
             write(clientsocket, &size2, sizeof(int));
             write(clientsocket, numenou, size2);
             
             read(clientsocket, &succes, sizeof(int));
                
             if(succes == 1)
                  printf("%s\n", "Succes! Numele a fost schimbat.");
             else
                  printf("%s\n", "Eroare! Numele nu a putut fi schimbat.");
          }

        if(logat == 1 && strcmp(svrasp, "transff") == 0)
        {
             char fnume[200], locact[200], locult[200], utnume[200];
             fnume[0] = 0;
             utnume[0] = 0;
             locact[0] = 0;
             locult[0] = 0;
             int succes, luact, luult, luf, luut;
             printf("%s", "Introduceti locatia actuala a fisierului: ");
             scanf("%s", locact);
             printf("%s", "Introduceti numele fisierului pe care doriti sa il transferati: ");
             scanf("%s", fnume);
             printf("%s", "Introduceti numele destinatarului: ");
             scanf("%s", utnume);
             printf("%s", "Introduceti locatia finala a fisierului: ");
             scanf("%s", locult);
             luact = strlen(locact);
             luf = strlen(fnume);
             luult = strlen(locult);
             luut = strlen(utnume);
             write(clientsocket, &luact, sizeof(int));
             write(clientsocket, locact, luact);
             write(clientsocket, &luf, sizeof(int));
             write(clientsocket, fnume, luf);
             write(clientsocket, &luut, sizeof(int));
             write(clientsocket, utnume, luut);
             write(clientsocket, &luult, sizeof(int));
             write(clientsocket, locult, luult);
             
             read(clientsocket, &succes, sizeof(int));
                
             if(succes == 1)
                printf("%s\n", "Succes! Locatia a fost schimbata.");
             if(succes == 0)
                printf("%s\n", "Eroare! Numele introdus nu apartine unui fisier.");
             if(succes == -1)
                printf("%s\n", "Eroare! Locatia unde doriti sa transferati nu exista.");
             if(succes == -2)
                printf("%s\n", "Eroare! Fisierul pe care doriti sa il transferati nu exista.");
             if(succes == -3)
                printf("%s\n", "Eroare! Exista deja acolo un fisier cu acel nume / Nume indisponibil.");     
        }
        
        if(logat == 1 && strcmp(svrasp, "enter") == 0)
        {
            int succes;
            printf("%s", "Scrieti numele folderului in care doriti sa intrati: ");
            scanf("%s", mesaj);
            size = strlen(mesaj);
            write(clientsocket, &size, sizeof(int));
            write(clientsocket, mesaj, size);
            read(clientsocket, &succes, sizeof(int));
            if(succes == 0)
                printf("%s\n", "Nu exista un folder cu acel nume sau numele nu apartine unui folder!");
        }

        if(logat == 1 && strcmp(svrasp, "leave") == 0)
        {
            int succes;
            read(clientsocket, &succes, sizeof(int));
            if(succes == 0)
                printf("%s\n", "Nu s-a putut efectua iesirea.");
        }

        if(logat == 1 && strcmp(svrasp, "show") == 0)      
        {
            int succes;
            read(clientsocket, &succes, sizeof(int));
            if(succes == 0)
            {
                svrasp[0]= 0;
                read(clientsocket, &size, sizeof(int));
                read(clientsocket, svrasp, size);
                printf("%s\n", svrasp);
            }
            while(1)
            {
                read(clientsocket, &succes, sizeof(int));
                if(succes == 0)
                    break;
                if(succes != 1)
                {
                    read(clientsocket, &size, sizeof(int));
                    read(clientsocket, svrasp, size);
                    if(succes == 2)
                        printf("%s%s%s", "\x1b[32m", svrasp, "\x1b[0m");
                    else
                        printf("%s%s%s", "\x1b[37m", svrasp, "\x1b[0m");
                    printf("%s", " ");
                }
            }
            printf("%s", "\n");
        }

        if(logat == 1 && strcmp(svrasp, "makefile") == 0)
         {
             mesaj[0] = 0;
             int succes;
             printf("%s", "Introduceti numele fisierului pe care doriti sa il creati: ");
             scanf("%s", mesaj);
             size = strlen(mesaj) + 1;
             write(clientsocket, &size, sizeof(int));
             write(clientsocket, mesaj, size);
             svrasp[0] = 0;
             read(clientsocket, &succes, sizeof(int));
                
                if(succes == 1)
                    printf("%s\n", "Succes! Fisierul a fost creat");
                else
                    printf("%s\n", "Eroare! Fisierul nu a putut fi creat");
          } 
    }
}
