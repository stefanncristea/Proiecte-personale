import java.lang.*;
import java.io.*;
import java.net.*;
import java.sql.SQLException;
import java.util.*;
import java.util.concurrent.CountDownLatch;

public class ClientThread extends Thread{
    private Socket socket = null;
    ServerController svc = new ServerController();
    public ClientThread (Socket socket) {
        this.socket = socket ;
    }
    String name = "";
    public void run(){
        try {
            System.out.println("Un client s-a conectat!");
            String name = "";
            int logat = 0;
            while(true) {
                int gasit = 0;
                BufferedReader in = new BufferedReader(new InputStreamReader(socket.getInputStream()));
                String request = in.readLine();
                PrintWriter out = new PrintWriter(socket.getOutputStream());
                String raspuns = "";
                if(request.equals("login")) {
                    if(logat == 1){
                        out.println("logat");
                        out.flush();
                    }
                    else {
                        raspuns = "login";
                        out.println(raspuns);
                        out.flush();
                        String nume = in.readLine();
                        String pass = in.readLine();
                        int ok = svc.login(nume, pass);
                        if (ok == 1) {
                            logat = 1;
                            name = nume;
                            out.println("reusit");
                            out.flush();
                        } else {
                            out.println("esuat");
                            out.flush();
                        }
                    }
                    gasit = 1;
                }

                if(request.equals("register")){
                    out.println("register");
                    out.flush();
                    String nume = in.readLine();
                    String pass = in.readLine();
                    int ok = svc.register(nume,pass);
                    if(ok == 1) {
                        out.println("reusit");
                        out.flush();
                    }
                    else {
                        out.println("esuat");
                        out.flush();
                    }
                    gasit = 1;
                }

                if(request.equals("makefolder")){
                    if(logat == 0){
                        out.println("nelogat");
                        out.flush();
                    }
                    else {
                        out.println("makefolder");
                        out.flush();
                        String path = in.readLine();
                        String nume = in.readLine();
                        int ok = svc.make_folder(name, nume, path);
                        if (ok == 1) {
                            out.println("reusit");
                            out.flush();
                        } else {
                            out.println("esuat");
                            out.flush();
                        }
                    }
                    gasit = 1;
                }

                if(request.equals("makefile")){
                    if(logat == 0){
                        out.println("nelogat");
                        out.flush();
                    }
                    else{
                        out.println("makefile");
                        out.flush();
                        String path = in.readLine();
                        String nume = in.readLine();
                        int ok = svc.make_file(name,path,nume);
                        if(ok == 1){
                            out.println("reusit");
                            out.flush();
                        }
                        else{
                            out.println("esuat");
                            out.flush();
                        }
                    }
                    gasit = 1;
                }

                if(request.equals("deletefile")){
                    if(logat == 0){
                        out.println("nelogat");
                        out.flush();
                    }
                    else {
                        out.println("deletefile");
                        out.flush();
                        String path = in.readLine();
                        String nume = in.readLine();
                        int ok = svc.delete_file(name, path, nume);
                        if (ok == 1) {
                            out.println("reusit");
                            out.flush();
                        } else {
                            out.println("esuat");
                            out.flush();
                        }
                    }
                    gasit = 1;
                }

                if(request.equals("transferfile")){
                    if(logat == 0){
                        out.println("nelogat");
                        out.flush();
                    }
                    else {
                        out.println("transferfile");
                        out.flush();
                        String path1 = in.readLine();
                        String path2 = in.readLine();
                        String nume = in.readLine();
                        int ok = svc.transferfile(name, path1, path2, nume);
                        if (ok == 1) {
                            out.println("reusit");
                            out.flush();
                        } else {
                            out.println("esuat");
                            out.flush();
                        }
                    }
                    gasit = 1;
                }

                if(request.equals("disconnect")){
                    if(logat == 0){
                        out.println("nelogat");
                        out.flush();
                    }
                    else{
                        out.println("disconnect");
                        out.flush();
                        logat = 0;
                    }
                    gasit = 1;
                }

                if(request.equals("list")){
                    if(logat == 0){
                        out.println("nelogat");
                        out.flush();
                    }
                    else{
                        out.println("list");
                        out.flush();
                        String path = in.readLine();
                        svc.list(name, path, socket);
                    }
                    gasit = 1;
                }

                if(request.equals("exit")){
                    out.println("exit");
                    out.flush();
                }

                if(gasit == 0){
                    out.println("negasit");
                    out.flush();
                }
            }

        } catch (IOException | SQLException e) {
            System.err.println("Communication error... " + e);
        } finally {
            try {
                socket.close(); // or use try-with-resources
            } catch (IOException e) {
                System.err.println(e);
            }
        }
    }
}
