import java.util.*;
import java.sql.*;
import java.io.*;
import java.net.*;

public class ServerController {
    public Integer exista(String name) throws SQLException {
        Connection con = Database.getConnection();
        try {
            Statement stmt = con.createStatement();
            ResultSet rs = stmt.executeQuery("select id from utilizatori where name='" + name + "'");
            if(rs.next())
                return 1;
            else
                return 0;
        } catch (SQLException e) {
            System.err.println(e);
            return -1;
        }
    }

    public int login(String name, String pass) throws SQLException{
        Connection con = Database.getConnection();
        try{
            Statement stmt = con.createStatement();
            ResultSet rs = stmt.executeQuery("select id from utilizatori where name='" + name + "' AND password='" + pass + "'");
            if(rs.next())
                return 1;
            else
                return 0;
        }
        catch (SQLException e) {
            System.err.println(e);
            return -1;
        }
    }

    public int register(String name, String password) throws SQLException{
        Connection con = Database.getConnection();
        int ok = exista(name);
        if(ok == 0){
            PreparedStatement pstmt = con.prepareStatement("INSERT INTO utilizatori (name, password) values ('" + name + "','" + password + "')");
            pstmt.executeUpdate();
            File dir = new File("resources/" + name);
            dir.mkdir();
            Database.getConnection().commit();
            return 1;
        }
        else if(ok == 1)
            return 0;
        else
            return -1;
    }

    public int make_folder(String name, String dirname, String path){
        if(!path.contains(name))
            return 0;
        String pathfinal = "resources/" + path + "/" + dirname;
        File dir = new File(pathfinal);
        boolean okish = dir.mkdir();
        int ok = 0;
        if(okish)
            ok = 1;
        return ok;
    }

    public int delete_file(String name, String path, String fname) {
        if(!path.contains(name))
            return 0;
        String pathfinal = "resources/" + path + "/" + fname;
        File file = new File(pathfinal);
        boolean okish = file.delete();
        int ok = 0;
        if(okish)
            ok = 1;
        return ok;
    }

    public int make_file(String name, String path, String fname) throws IOException{
        if(!path.contains(name))
            return 0;
        String pathfinal = "resources/" + path + "/" + fname;
        File file = new File(pathfinal);
        boolean okish = file.createNewFile();
        int ok = 0;
        File file2 = new File(pathfinal);
        if(file2.exists())
            ok = 1;
        return ok;
    }

    public int list(String name, String path, Socket socket) throws IOException{
        PrintWriter out = new PrintWriter(socket.getOutputStream());
        if(!path.contains(name)) {
            out.println(0);
            out.flush();
            return 0;
        }
        String pathfinal = "resources/" + path;
        File file = new File(pathfinal);
        //List of all files and directories
        File filesList[] = file.listFiles();
        out.println(filesList.length);
        for(File files : filesList) {
            out.println("File name: "+files.getName());
            out.flush();
            out.println("File path: "+files.getAbsolutePath());
            out.flush();
            out.println("Size :"+files.getTotalSpace());
            out.flush();
            if(files.isDirectory()){
                out.println("File type: directory");
                out.flush();
            }
            else{
                out.println("File type: file");
                out.flush();
            }
        }
        return 1;
    }

    public int transferfile(String name, String locatie1, String locatie2, String fname) throws IOException{
        FileInputStream fis = null;
        FileOutputStream fos = null;
        if(!locatie1.contains(name))
            return 0;
        if(!locatie2.contains(name))
            return 0;
        String path1 = "resources/" + locatie1 + "/" + fname;
        String path2 = "resources/" + locatie2 + "/" + fname;
        File file = new File(path2);
        File exista = new File(path1);
        if(!exista.exists())
            return 0;
        boolean okish = file.createNewFile();
        int ok = 0;
        if(okish)
            ok = 1;
        if(ok == 0)
            return 0;

        try {
            fis = new FileInputStream(path1);
            fos = new FileOutputStream(path2);
            int c;

            while ((c = fis.read()) != -1) {

                fos.write(c);
            }

        }
        finally {
            if (fis != null) {
                fis.close();
            }
            if (fos != null) {
                fos.close();
            }
            boolean oki = exista.delete();
        }
        return 1;
    }
}
