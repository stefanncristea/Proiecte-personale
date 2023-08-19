import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class Database {
    private static final String URL = "jdbc:oracle:thin:@localhost:1521:xe";
    private static final String USER = "PROGAVAN";
    private static final String PASSWORD = "PROGAVAN";
    private static Connection connection = null;


    public static void createConnection() {
        try {
            connection = DriverManager.getConnection(URL, USER, PASSWORD);
            System.out.println("Connected to the Oracle server successfully.");
            connection.setAutoCommit(false);
        } catch (SQLException e) {
            System.err.println(e);
        }
    }
    public static Connection getConnection() {
        return connection;
    }
    public static void closeConnection() throws SQLException {
        try {
            connection.close();
            System.out.println("Connection closed successfully.");
        } catch (SQLException e) {
            System.err.println(e);
        }
    }

    public static void rollback() throws SQLException {
        try {
            connection.rollback();
            System.out.println("Rolled back.");
        } catch (SQLException e) {
            System.err.println(e);
        }
    }
}

