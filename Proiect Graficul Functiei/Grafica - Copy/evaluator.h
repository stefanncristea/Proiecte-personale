#ifndef EVALUATOR_H_INCLUDED
#define EVALUATOR_H_INCLUDED
#define infinit 500000

using namespace std;

void ValoriNegative(char sir[],bool neg[])
{
    //determinam valorile negative si marcam numarul de ordine cu 1 daca acestea sunt negative si cu 0 in caz contrar
    int nr=0,i;
    char cp[200];
    for(i=1; i<100; i++)
        neg[i]=0;
    if(sir[0]=='-')
    {
        neg[1]=1;//primul numar
        strcpy(cp,sir+1);
        strcpy(sir,cp);
    }
    for(i=0; i<strlen(sir); i++)
    {
        if(sir[i]=='x')
            nr++;
        else if(isdigit(sir[i]))
        {
            nr++;
            while(i<strlen(sir) && (isdigit(sir[i]) || sir[i]=='.'))
                i++;
        }
        if(strchr("*/^",sir[i]) && sir[i+1]=='-')
        {
            neg[nr+1]=1;
            strcpy(cp,sir+i+2);
            strcpy(sir+i+1,cp);
        }
    }
}
bool inf(long double nr)
{
    //verificam daca numarul tinde spre infinit
    if(fabs(nr)>infinit)
        return 1;
    else
        return 0;
}
void convertch(long double nr,char sir[])
{
    //facem conversia numarului din double in sir, pentru a-i da replace in sirul initial
    strcpy(sir,"");
    char tmp[201];
    bool negativ=0,zeci=0;
    int k=0,cp,k1=0,cp2,cp3;
    long long int numar;
    if(nr<0)
        negativ=1,nr=-nr;
    if(nr<1)
        zeci=1;
    cp=nr;
    while(cp)
        k++,cp/=10;
    cp2=nr;
    numar=nr*100000000000;
    cp=numar;
    while(cp)
        k1++,cp/=10;
    cp3=numar;
    for(int i=k+10; i>=0; i--,numar/=10)
        sir[i]=char(numar%10+48);//construim sirul pornind de la dreapta spre stanga
    sir[k1]=0;
    if(cp3!=cp2)
    {
        strcpy(tmp,sir+k);
        sir[k]='.';
        sir[k+1]=0;
        strcat(sir,tmp);

    }
    if(zeci)
    {
        strcpy(tmp,sir);
        sir[0]='0';
        strcpy(sir+1,tmp);
    }
    if(negativ)//daca numarul este mai mic decat 0
    {
        strcpy(tmp,sir);
        sir[0]='-';
        strcpy(sir+1,tmp);
    }
}

void elimsin(char s[])
{
    //inlocuim valoarea lui sin din functie
    char *p,aux[201],t[201];
    int poz,i;
    bool gasit,neg;
    p=strstr(s,"sin");
    while(p)
    {
        gasit=0;
        poz=p-s;
        if(s[poz+3]!='(')
        {
            neg=0;
            gasit=1;
            i=poz+3;
            int n=0;
            if(s[i]=='-')
                neg=1,i++;
            while(isdigit(s[i]) || s[i]=='.')
                aux[n++]=s[i++];
            aux[n]=0;
            long double val=atof(aux);
            if(neg)
                val=-val;
            val=sin(val);
            strcpy(t,s+i);
            convertch(val,aux);
            s[poz]=0;
            strcat(s,aux);
            strcat(s,t);
        }
        if(gasit)
            p=strstr(s,"sin");
        else
            p=strstr(p+1,"sin");
    }
}
void elimcos(char s[])
{
    //inlocuim valorea lui cos din functie
    char *p,aux[201],t[201];
    int poz,i;
    bool gasit;
    p=strstr(s,"cos");
    while(p)
    {
        gasit=0;
        poz=p-s;
        if(s[poz+3]!='(')
        {
            bool neg=0;
            gasit=1;
            i=poz+3;
            int n=0;
            if(s[i]=='-')
                neg=1,i++;
            while(isdigit(s[i]) || s[i]=='.')
                aux[n++]=s[i++];
            aux[n]=0;
            long double val=atof(aux);
            if(neg)
                val=-val;
            val=cos(val);
            strcpy(t,s+i);
            convertch(val,aux);
            s[poz]=0;
            strcat(s,aux);
            strcat(s,t);
        }
        if(gasit)
            p=strstr(s,"cos");
        else
            p=strstr(p+1,"cos");
    }
}
void elimlog(char s[],int &errorx)
{
    //inlocuim valoarea lui ln din functie
    char *p,aux[201],t[201];
    int poz,i;
    bool gasit;
    p=strstr(s,"ln");
    while(p)
    {
        gasit=0;
        poz=p-s;
        if(s[poz+2]!='(')
        {
            bool neg=0;
            gasit=1;
            i=poz+2;
            int n=0;
            if(s[i]=='-')
                neg=1,i++;
            while(isdigit(s[i]) || s[i]=='.')
                aux[n++]=s[i++];
            aux[n]=0;
            long double val=atof(aux);
            if(neg)
                val=-val;
            if(inf(val))
                val=infinit;
            else
            {
                if(val<=0)
                    val=-infinit,errorx=2;
                else
                    val=log(val);
            }
            strcpy(t,s+i);
            convertch(val,aux);
            s[poz]=0;
            strcat(s,aux);
            strcat(s,t);
        }
        if(gasit)
            p=strstr(s,"ln");
        else
            p=strstr(p+1,"ln");
    }
}
void elimrad(char s[], int &errorx)
{
    //inlocuim valorea radicalului din functie
    char *p,aux[201],t[201];
    int poz,i;
    bool gasit;
    p=strstr(s,"rad");
    while(p)
    {
        gasit=0;
        poz=p-s;
        if(s[poz+3]!='(')
        {
            bool neg=0;
            gasit=1;
            i=poz+3;
            int n=0;
            if(s[i]=='-')
                neg=1,i++;
            while(isdigit(s[i]) || s[i]=='.')
                aux[n++]=s[i++];
            aux[n]=0;
            long double val=atof(aux);
            if(neg)
                val=-val;
            if(val<0)
                errorx=2;
            else
                val=sqrt(val);
            strcpy(t,s+i);
            convertch(val,aux);
            s[poz]=0;
            strcat(s,aux);
            strcat(s,t);
        }
        if(gasit)
            p=strstr(s,"rad");
        else
            p=strstr(p+1,"rad");
    }
}

void elimabs(char s[])
{
    //inlocuim valorea modulului din functie
    char *p,aux[201],t[201];
    int poz,i;
    bool gasit;
    p=strstr(s,"abs");
    while(p)
    {
        gasit=0;
        poz=p-s;
        if(s[poz+3]!='(')
        {
            gasit=1;
            i=poz+3;
            int n=0;
            if(s[i]=='-')
                i++;
            while(isdigit(s[i]) || s[i]=='.')
                aux[n++]=s[i++];
            aux[n]=0;
            long double val=fabs(atof(aux));
            strcpy(t,s+i);
            convertch(val,aux);
            s[poz]=0;
            strcat(s,aux);
            strcat(s,t);
        }
        if(gasit)
            p=strstr(s,"abs");
        else
            p=strstr(p+1,"abs");
    }
}

long double calcul(int a,int b,long double x,char s[],int &errorx)
{
    //calculam valorea dintr-o paranteza
    bool neg[100];
    char aux[201],*p,cop[201],t[201][201],semn[201];
    int j=-1,i,n=0,m=0,k=0;
    long double v[201];
    for(i=a+1; i<b; i++)
        aux[++j]=s[i];
    aux[++j]=0;
    for(i=0; i<strlen(aux); i++)
        if(aux[i]=='+' && aux[i+1]=='-')
        {
            strcpy(cop,aux+i+1);
            strcpy(aux+i,cop);
        }
        else if(aux[i]=='-' && aux[i+1]=='-')
        {
            strcpy(cop,aux+i+1);
            strcpy(aux+i,cop);
            aux[i]='+';
        }
    for(i=0; i<strlen(aux); i++)
        if((aux[i]=='^' || aux[i]=='*' || aux[i]=='+' || aux[i]=='/' || aux[i]=='-') && (isdigit(aux[i-1]) || aux[i-1]=='x'))
            semn[++n]=aux[i];//punem in vectorul de semne operatorul
    ValoriNegative(aux,neg);
    if(n==0)
        if(aux[0]=='x')
        {
            if(neg[1])
                return -x;
            else
                return x;
        }
        else
        {
            if(neg[1])
                return -atof(aux);
            else
                return atof(aux);
        }
    p=strtok(aux,"+-*/^");//spargem sirul pentru a obtine numerele
    while(p)
    {
        strcpy(t[++m],p);
        p=strtok(NULL,"+-*/^");
    }
    for(i=1; i<=m; i++)
        if(strcmp(t[i],"x")==0)
            v[i]=x;//elementul va primi valorea lui x
        else
            v[i]=atof(t[i]);//elementul va primi valorea numarului convertit la tipul de date float
    for(i=1; i<=100; i++)
        if(neg[i])
            v[i]=-v[i];
    for(i=1; i<=n; i++)
        if(semn[i]=='^')
        {
            //if(v[i]<0.5 && v[i+1]<0.5)
                //errorx =1;

            if(pow(v[i],v[i+1])>infinit)
                v[i]=infinit;
            else
            {
                if(pow(v[i],v[i+1])<-infinit)
                    v[i]=-infinit;
                else
                {
                    if(v[i+1]<0)
                    {
                        v[i+1]=-v[i+1];
                        v[i]=pow(v[i],v[i+1]);
                        v[i]=1/v[i];
                    }
                    else
                    v[i]=pow(v[i],v[i+1]);
                }
            }
            if(isnan(v[i]))
                errorx=2;
            for(j=i; j<n; j++)
                semn[j]=semn[j+1];
            n--;
            for(j=i+1; j<m; j++)
                v[j]=v[j+1];
            m--;
            i--;
        }
    for(i=1; i<=n; i++)
        if(semn[i]=='*' || semn[i]=='/')
        {
            if(semn[i]=='*')
            {
                if(v[i]*v[i+1]>infinit)
                    v[i]=infinit;
                else
                    v[i]*=v[i+1];
            }
            else
            {
                if(v[i+1]>-0.01 && v[i+1]<0.01)
                    errorx=1;
                else
                    v[i]/=v[i+1];
            }
            for(j=i; j<n; j++)
                semn[j]=semn[j+1];
            n--;
            for(j=i+1; j<m; j++)
                v[j]=v[j+1];
            m--;
            i--;
        }
    for(i=1; i<=n; i++)
        if(semn[i]=='+' || semn[i]=='-')
        {
            if(semn[i]=='+')
            {
                if(v[i]+v[i+1]>infinit)
                    v[i]=infinit;
                else
                    v[i]+=v[i+1];
            }
            else
            {
                if(v[i]-v[i+1]<-infinit)
                    v[i]=-infinit;
                else
                    v[i]-=v[i+1];
            }
            for(j=i; j<n; j++)
                semn[j]=semn[j+1];
            n--;
            for(j=i+1; j<m; j++)
                v[j]=v[j+1];
            m--;
            i--;
        }
    return v[1];
}

long double solve(long double x,char s[],int &errorx)
{
    int poz,i;
    char aux[201],t[201];
    bool gasit=1;
    long double nr;
    while(gasit && !errorx)
    {
        gasit=0;
        elimsin(s);
        elimcos(s);
        elimlog(s,errorx);
        elimrad(s,errorx);
        elimabs(s);
        for(i=0; i<strlen(s) && !errorx; i++)
            if(s[i]=='(')
                poz=i,gasit=1;//am gasit o paranteza ce trebuie calculata deci continuam cautarea
            else if(s[i]==')')
            {
                nr=calcul(poz,i,x,s,errorx);//obtinem valorea din paranteza determinata
                strcpy(aux,s+i+1);
                s[poz]=0;
                convertch(nr,t);//facem conversia numarului in sir de caractere pentru a-i da replace
                strcat(s,t);
                strcat(s,aux);//reconstruit sirul
                i=200; //reincepem cautarea de la pozitia 0
            }
    }
    if(!errorx)
        return calcul(-1,strlen(s),x,s,errorx);
    else
        return 0;
}


#endif // EVALUATOR_H_INCLUDED
