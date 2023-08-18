#ifndef CORECTITUDINE_H_INCLUDED
#define CORECTITUDINE_H_INCLUDED


/*
1 = NUMAR DE CARACTERE POSIBILE DEPASIT!
2 = FOLOSITI DOAR VARIABILA X!
3 = PARANTEZE PUSE INCORECT!
4 = CARACTERE NEPERMISE!
5 = FUNCTIA ESTE SCRISA GRESIT!
*/

void citirecorecta(char s[],bool &errorf, short &ErrorType)
{
    if(strlen(s)>100)
    {
        errorf=1;
            //cout<<"NUMAR DE CARACTERE POSIBILE DEPASIT!";
        ErrorType = 1;
    }
}

void altevariabile(char s[],bool &errorf, short &ErrorType)
{
    for(int i=0;i<strlen(s) && !errorf; i++)
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
                //cout<<"FOLOSITI DOAR VARIABILA X!";
                errorf=1;
                ErrorType = 2;
            }
        }
}

void parantezare(char s[],bool &errorf, short &ErrorType)
{
    char v[10][10];
    int i;
    strcpy(v[0],"sin");
    strcpy(v[1],"cos");
    strcpy(v[2],"ln");
    strcpy(v[3],"rad");
    strcpy(v[4],"abs");
    for(i=0;i<5 && !errorf;i++)
    {
        char *p;
        p=strstr(s,v[i]);
        while(p)
        {
            int poz=p-s;
            if(s[poz+strlen(v[i])]!='(')
            {
                errorf=1;
                    //cout<<"PARANTEZE PUSE INCORECT!";
                ErrorType = 3;
            }
            p=strstr(p+1,v[i]);
        }
    }
    stack<int> stiva;
    for(i=0;i<strlen(s) && !errorf;i++)
    {
        if(s[i]=='(')
            stiva.push(0);
        else if(s[i]==')')
        {
            if(stiva.empty()==false)
                stiva.pop();
            else
            {
                errorf=1;
                    //cout<<"PARANTEZE INCHISE INCORECT!";
                ErrorType = 3;
            }
        }
    }
    if(stiva.empty()==false)
    {
        errorf=1;
            //cout<<"PARANTEZE INCHISE INCORECT!";
        ErrorType = 3;
    }
}

short scrierecorecta(char s[],bool errorf, short &ErrorType)
{
    ErrorType=0;

    citirecorecta(s,errorf,ErrorType);
    parantezare(s,errorf,ErrorType);
    altevariabile(s,errorf,ErrorType);

    for(int i=0;i<strlen(s) && !errorf ;i++)
    {
        if( !strchr("+-*/^()",s[i]) && !isdigit(s[i]) && !isalpha(s[i]) )
        {
            errorf=1;
                //cout<<"CARACTERE NEPERMISE!";
            ErrorType = 4;
        }
        else if(s[i]=='x' && ((i>0 && !strchr("+-/*^(",s[i-1])) || !strchr("+-/*^)",s[i+1])))
        {
            errorf=1;
                //cout<<"FUNCTIA ESTE SCRISA GRESIT!";
            ErrorType = 5;
        }
        else if(strchr("*/^",s[i]) && (i==0 || (s[i-1]!='x' && !isdigit(s[i-1]) && s[i-1]!=')')) && (!isdigit(s[i+1] && s[i+1]!='(' && s[i+1]!='x')))
        {
            errorf=1;
                //cout<<"FUNCTIA ESTE SCRISA GRESIT!";
            ErrorType = 5;
        }
        else if(s[i]=='(' && s[i+1]==')')
        {
            errorf=1;
                //cout<<"FUNCTIA ESTE SCRISA GRESIT!";
            ErrorType = 5;
        }

        if(s[i]==13 || s[i]==27 || s[i]==10 || s[i]==0)
            ErrorType=6;
    }

    if(s[0]==13 || s[0]==27 || s[0]==10 || s[0]==0)
            ErrorType=6;

    return ErrorType;
}

#endif // CORECTITUDINE_H_INCLUDED
