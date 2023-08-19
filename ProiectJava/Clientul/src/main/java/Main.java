import java.net.*;
import java.lang.*;
import java.io.*;
import java.util.*;


public class Main {
    public static void main (String[] args) throws IOException {
        String serverAddress = "127.0.0.1"; // The server's IP address
        int PORT = 8888; // The server's port
        try (Socket socket = new Socket(serverAddress, PORT);
                PrintWriter out = new PrintWriter(socket.getOutputStream(), true);
                BufferedReader in = new BufferedReader(new InputStreamReader(socket.getInputStream())) ) {

            System.out.println("Tocmai v-ati conectat la server! Comenzile disponibile sunt: register, login, exit, list, deletefile, makefile, makefolder, transferfile.");
            Scanner keyboard = new Scanner(System.in);
            String comanda = "";

            String response = "";

            Animations anim = new Animations();

            while(true){
                comanda = keyboard.nextLine();
                out.println(comanda);
                out.flush();
                response = in.readLine();
                if(response.equals("nelogat")) {
                    System.out.println("Nu sunteti logat! Logati-va sau creati un cont nou pentru a putea utiliza comenzi!");
                }
                if(response.equals("login")){
                    System.out.println("Introduceti numele de utilizator: ");
                    String nume = keyboard.nextLine();
                    System.out.println("Introduceti parola: ");
                    String pass = keyboard.nextLine();
                    out.println(nume);
                    out.println(pass);
                    out.flush();
                    response = in.readLine();
                    if(response.equals("reusit")) {
                        System.out.println("V-ati conectat la contul " + nume + " cu succes!");
                    }
                    else {
                        System.out.println("Nu exista niciun user cu acest nume de utilizator! Incercati altul!");
                    }
                }
                if(response.equals("register")){
                    System.out.println("Introduceti numele de utilizator pe care doriti sa-l creati: ");
                    String nume = keyboard.nextLine();
                    System.out.println("Introduceti parola: ");
                    String pass = keyboard.nextLine();
                    out.println(nume);
                    out.flush();
                    out.println(pass);
                    out.flush();
                    response = in.readLine();
                    if(response.equals("reusit")){
                        System.out.println("Ati creat cu succes contul cu numele " + nume + "!");
                        System.out.println("Odata cu contul a fost creat si un folder cu numele dumneavoastra de utilizator care va apartine!");
                    }
                    else {
                        System.out.println("Exista deja un user cu acest nume! Incercati alt username!");
                    }
                }

                if(response.equals("makefile")){
                    System.out.println("");
                    System.out.println("Atentie! Calea catre fisier trebuie sa inceapa cu numele de utilizator!");
                    System.out.println("");
                    System.out.println("Introduceti locul(path-ul) unde doriti sa creati fisierul");
                    String path = keyboard.nextLine();
                    System.out.println("Introduceti numele fisierului pe care doriti sa-l creati: ");
                    String nume = keyboard.nextLine();
                    out.println(path);
                    out.flush();
                    out.println(nume);
                    out.flush();
                    response = in.readLine();
                    if(response.equals("reusit")){
                        System.out.println("Ati reusit sa creati cu succes fisierul!");
                    }
                    else{
                        System.out.println("Nu s-a putut crea fisierul!");
                    }
                }

                if(response.equals("transferfile")){
                    System.out.println("");
                    System.out.println("Atentie! Caile catre fisier trebuie sa inceapa numele de utilizator!");
                    System.out.println("");
                    System.out.println("Introduceti locul(path-ul) de unde doriti sa mutati fisierul");
                    String path1 = keyboard.nextLine();
                    System.out.println("Introduceti destinatia finala a fisierului");
                    String path2 = keyboard.nextLine();
                    System.out.println("Introduceti numele fisierului pe care doriti sa-l mutati: ");
                    String nume = keyboard.nextLine();
                    out.println(path1);
                    out.flush();
                    out.println(path2);
                    out.flush();
                    out.println(nume);
                    out.flush();
                    response = in.readLine();
                    if(response.equals("reusit")){
                        //anim.MovingGif();
                        System.out.println("Ati reusit sa mutati cu succes fisierul!");
                    }
                    else{
                        System.out.println("Nu s-a putut muta fisierul!");
                    }
                }

                if(response.equals("makefolder")){
                    System.out.println("");
                    System.out.println("Atentie! Calea catre fisier trebuie sa inceapa cu numele de utilizator!");
                    System.out.println("");
                    System.out.println("Introduceti locul(path-ul) unde doriti sa creati folderul");
                    String path = keyboard.nextLine();
                    System.out.println("Introduceti numele folder-ului pe care doriti sa-l creati: ");
                    String nume = keyboard.nextLine();
                    out.println(path);
                    out.flush();
                    out.println(nume);
                    out.flush();
                    response = in.readLine();
                    if(response.equals("reusit")){
                        System.out.println("Ati reusit sa creati cu succes fisierul!");
                    }
                    else{
                        System.out.println("Nu s-a putut crea folder-ul!");
                    }

                }

                if(response.equals("deletefile")){
                    System.out.println("Introduceti locul(path-ul) fisierului pe care doriti sa-l stergeti: ");
                    String path = keyboard.nextLine();
                    System.out.println("Introduceti numele fisierului de care doriti sa scapati: ");
                    String nume = keyboard.nextLine();
                    out.println(path);
                    out.println(nume);
                    out.flush();
                    response = in.readLine();
                    if(response.equals("reusit")){
                        System.out.println("Succes! Fisierul a fost sters.");
                    }
                    else{
                        System.out.println("Din pacate fisierul nu a putut fi sters...");
                    }
                }

                if(response.equals("list")){
                    System.out.println("Introduceti calea folderului pe care doriti sa-l listati: ");
                    String cale = keyboard.nextLine();out.println(cale);
                    out.flush();
                    String lung = in.readLine();
                    int lungime = Integer.valueOf(lung);
                    if(lungime == 0){
                        System.out.println("Folderul pe care doriti sa-l listati este gol sau nu exista. Incercati iar!");
                    }
                    for(int i = 1; i <= lungime; i++){
                        String specif = in.readLine();
                        System.out.println(specif);
                        specif = in.readLine();
                        System.out.println(specif);
                        specif = in.readLine();
                        System.out.println(specif);
                        specif = in.readLine();
                        System.out.println(specif);
                        System.out.println(" ");
                    }
                }

                if(response.equals("disconnect")){
                    System.out.println("Ati fost deconectat cu succes!");
                }

                if(response.equals("stop")){
                    System.out.println("Serverul nu va mai rula dupa ce toti clientii deja conectati vor iesi.");
                }
                if(response.equals("negasit")){
                    System.out.println("Comanda introdusa de dumneavoastra nu exista!");
                }

                if(response.equals("exit")) {
                    socket.close();
                    System.out.println("Ai fost deconectat cu succes!");
                    System.exit(69);
                }

                if(response.equals("logat")){
                    System.out.println("Sunteti deja logat!");
                }

            }
        }
        catch (UnknownHostException e) {
            System.err.println("No server listening... " + e);
        }
    }
}
