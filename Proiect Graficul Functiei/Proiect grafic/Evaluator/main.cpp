#include <iostream>
#include <cstring>
#include <cmath>
#include <cstdlib>
#include <climits>
using namespace std;
#define infinit 500000
#define q 3.14159

char s[201];
int nr[201];
bool error=0;

bool inf(long double nr)
{
    if(fabs(nr)>infinit)
        return 1;
    else
        return 0;
}
void convertch(long double nr,char sir[])
{
    strcpy(sir,"");
    char tmp[201];
    bool negativ=0,zeci=0;
    int k=0,cp,k1=0,cp2,cp3;
    long numar;
    if(nr<0)
        negativ=1,nr=-nr;
    if(nr<1)
        zeci=1;
    cp=nr;
    while(cp)
        k++,cp/=10;
    cp2=nr;
    numar=nr*1000;
    cp=numar;
    while(cp)
        k1++,cp/=10;
    cp3=numar;
    for(int i=k+2; i>=0; i--,numar/=10)
        sir[i]=char(numar%10+48);
    sir[k1]=0;
    if(cp3!=cp2)
    {
        strcpy(tmp,sir+k);
        sir[k]='.';
        sir[k+1]=0;
        strcat(sir,tmp);
        for(int i=k+1; i<strlen(sir); i++)
            if(sir[i]=='0')
            {
                if(i==k+1)
                    sir[k]=0;
                else
                    sir[i]=0;
                i=200;
            }
    }
    if(zeci)
    {
        strcpy(tmp,sir);
        sir[0]='0';
        strcpy(sir+1,tmp);
    }
    if(negativ)
    {
        strcpy(tmp,sir);
        sir[0]='-';
        strcpy(sir+1,tmp);
    }
}

void elimsin()
{
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
            if(val<0)
            {
                error=1;
                system("cls");
                cout<<"EROARE CAT TINE DE MARE NENE";
            }
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
void elimcos()
{
    char *p,aux[201],t[201];
    int poz,i;
    bool gasit;
    bool neg;
    p=strstr(s,"cos");
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
            if(val<0)
            {
                error=1;
                system("cls");
                cout<<"EROARE CAT TINE DE MARE NENE";
            }
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
void elimlog()
{
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
                if(val>0.0001)
                    val=log(val);
                else
                {
                    if(val<0)
                    {
                        error=1;
                        system("cls");
                        cout<<"EROARE CAT TINE DE MARE NENE";
                    }
                    else
                        val=-infinit;
                }
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
void elimrad()
{
    char *p,aux[201],t[201];
    int poz,i;
    bool gasit,neg;
    p=strstr(s,"rad");
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
            if(s[poz]=='-')
                neg=1,i++;
            while(isdigit(s[i]) || s[i]=='.')
                aux[n++]=s[i++];
            aux[n]=0;
            long double val=atof(aux);
            if(neg)
                val=-val;
            if(val<0)
            {
                error=1;
                system("cls");
                cout<<"EROARE CAT TINE DE MARE NENE";
            }
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

void elimabs()
{
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

long double calcul(int a,int b,long double x)
{
    bool neg=0;
    char aux[201],*p,cop[201],t[201][201],semn[201];
    int j=-1,i,n=0,m=0,k=0;
    long double v[201];
    for(i=a+1; i<b; i++)
        aux[++j]=s[i];
    if(aux[0]=='-')
        neg=1;
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
            semn[++n]=aux[i];
    if(n==0)
    {
        if(aux[1]=='x' || aux[0]=='x')
        {
            if(neg)
                return -x;
            else
                return x;
        }
        else
            return atof(aux);
    }
    p=strtok(aux,"+-*/^");
    while(p)
    {
        strcpy(t[++m],p);
        p=strtok(NULL,"+-*/^");
    }
    for(i=1; i<=m; i++)
        if(strcmp(t[i],"x")==0)
            v[i]=x;
        else
            v[i]=atof(t[i]);
    if(neg)
        v[1]=-v[1];
    for(i=1; i<=n; i++)
        if(semn[i]=='^')
        {
            if(pow(v[i],v[i+1])>infinit)
                v[i]=infinit;
            else
                v[i]=pow(v[i],v[i+1]);
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
                v[i]/=v[i+1];
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

void solve(long double x)
{
    int poz,i;
    char aux[201],t[201];
    bool gasit=1;
    long double nr,cp;
    while(gasit)
    {
        gasit=0;
        elimsin();
        elimcos();
        elimlog();
        elimrad();
        elimabs();
        for(i=0; i<strlen(s); i++)
            if(s[i]=='(')
                poz=i,gasit=1;
            else if(s[i]==')')
            {
                calcul(poz,i,x);
                nr=calcul(poz,i,x);
                cp=nr;
                strcpy(aux,s+i+1);
                s[poz]=0;
                convertch(nr,t);
                strcat(s,t);
                strcat(s,aux);
                i=200;
            }
    }
    if(!error)
    cout<<calcul(-1,strlen(s),x);
}
int main()
{
    long double x;
    cout<<"Introduceti functia dorita: ";
    cin.get(s,201);
    cout<<"Introduceti valoarea lui x dorita: ";
    cin>>x;
    solve(x);
}
