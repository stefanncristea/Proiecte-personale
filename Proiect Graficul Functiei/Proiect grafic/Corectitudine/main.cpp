#include <iostream>
#include <fstream>
#include <cstring>
#include <stack>
using namespace std;
ifstream f("corecta.in");

char s[205];
bool error=0;
void citirecorecta()
{
    cin.get(s,205);
    if(strlen(s)>100)
    {
        error=1;
        cout<<"NUMAR DE CARACTERE POSIBILE DEPASIT!";
    }
}

void altevariabile()
{
    for(int i=0;i<strlen(s) && !error;i++)
        if(isalpha(s[i]))
        {
            char aux[105];
            int n=0;
            bool gasit=0;
            while(i<strlen(s) && isalpha(s[i]))
                aux[n++]=s[i++];
            aux[n]=0;
            if(strcmp(aux,"sin")==0)
                gasit=1;
            if(strcmp(aux,"cos")==0)
                gasit=1;
            if(strcmp(aux,"ln")==0)
                gasit=1;
            if(strcmp(aux,"rad")==0)
                gasit=1;
            if(strcmp(aux,"abs")==0)
                gasit=1;
            if(strcmp(aux,"x")==0)
                gasit=1;
            if(!gasit)
            {
                cout<<"FOLOSITI DOAR VARIABILA X!";
                error=1;
            }
        }
}

void parantezare()
{
    char v[10][10];
    int i;
    strcpy(v[0],"sin");
    strcpy(v[1],"cos");
    strcpy(v[2],"ln");
    strcpy(v[3],"rad");
    strcpy(v[4],"abs");
    for(i=0;i<5 && !error;i++)
    {
        char *p;
        p=strstr(s,v[i]);
        while(p)
        {
            int poz=p-s;
            if(s[poz+strlen(v[i])]!='(')
            {
                error=1;
                cout<<"PARANTEZE PUSE INCORECT!";
            }
            p=strstr(p+1,v[i]);
        }
    }
    stack<int> stiva;
    for(i=0;i<strlen(s) && !error;i++)
    {
        if(s[i]=='(')
            stiva.push(0);
        else if(s[i]==')')
        {
            if(stiva.empty()==false)
                stiva.pop();
            else
            {
                error=1;
                cout<<"PARANTEZE INCHISE INCORECT!";
            }
        }
    }
    if(stiva.empty()==false)
    {
        error=1;
        cout<<"PARANTEZE INCHISE INCORECT!";
    }
}

void scrierecorecta()
{
    for(int i=0;i<strlen(s) && !error;i++)
    {
        if(!strchr("+-*/^()",s[i]) && !isdigit(s[i]) && !isalpha(s[i]))
        {
            error=1;
            cout<<"CARACTERE NEPERMISE!";
        }
        if(s[i]=='x' && ((i>0 && !strchr("+-/*^(",s[i-1])) || !strchr("+-/*)",s[i+1])))
        {
            error=1;
            cout<<"FUNCTIA ESTE SCRISA GRESIT!";
        }
        if(strchr("*/^",s[i]) && (i==0 || (s[i-1]!='x' && !isdigit(s[i-1]) && s[i-1]!=')')) && (!isdigit(s[i+1] && s[i+1]!='(' && s[i+1]!='x')))
        {
            error=1;
            cout<<"FUNCTIA ESTE SCRISA GRESIT!";
        }
        if(s[i]=='(' && s[i+1]==')')
        {
            error=1;
            cout<<"FUNCTIA ESTE SCRISA GRESIT!";
        }
    }
}

int main()
{
    citirecorecta();
    altevariabile();
    parantezare();
    scrierecorecta();
}
