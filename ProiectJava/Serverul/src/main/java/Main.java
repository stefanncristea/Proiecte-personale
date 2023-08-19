import java.lang.*;
import java.io.*;
import java.net.*;
import java.sql.SQLException;
import java.util.Scanner;
import java.sql.*;
import java.util.*;

public class Main {
    public static final int PORT = 8100;
    public Main() throws IOException,InterruptedException, SQLException {
        ServerSocket serverSocket = null;
        try {
            int ok = 1;
            serverSocket = new ServerSocket(PORT);
            while (ok <= 5) {
                ok++;
                System.out.println("Waiting for a client ...");
                Socket socket = serverSocket.accept();
                // Execute the client's request in a new thread
                ClientThread thread = new ClientThread(socket);
                thread.start();
            }
        } catch (IOException e) {
            System.err.println("Ooops... " + e);
        } finally {
            serverSocket.close();
        }
    }
    public static void main ( String[] args ) throws IOException,InterruptedException,SQLException {
        Database database = new Database();
        database.createConnection();

        Main server = new Main();
    }
}
