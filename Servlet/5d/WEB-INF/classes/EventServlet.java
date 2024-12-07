import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import java.sql.*;

public class EventServlet extends HttpServlet {

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
       
        response.setContentType("text/html");
        PrintWriter out = response.getWriter();
        out.println("<html><body>");
        out.println("<h2>Error: This action requires a POST request.</h2>");
        out.println("<a href='index.html'>Go to Quiz</a>");
        out.println("</body></html>");
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        response.setContentType("text/html");
        PrintWriter out = response.getWriter();

        String[] answers = new String[20];
        for (int i = 0; i < 20; i++) {
            answers[i] = request.getParameter("answer" + (i + 1)); // Fetch answer1, answer2, ..., answer20
        }

    
        Connection conn = null;
        PreparedStatement stmt = null, insertStmt = null;
        ResultSet rs = null;
        try {
           
            Class.forName("com.mysql.cj.jdbc.Driver");
            conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/quiz_db", "root", "");

          
            String sql = "SELECT * FROM events LIMIT 20";
            stmt = conn.prepareStatement(sql);
            rs = stmt.executeQuery();

         
            out.println("<html><body>");
            out.println("<h2>Quiz Results:</h2>");

            int questionIndex = 0;
            while (rs.next() && questionIndex < 20) {
                int questionId = rs.getInt("id");
                String eventName = rs.getString("event_name");
                String correctAnswer = rs.getString("event_description");
                String userAnswer = answers[questionIndex];

                
                boolean isCorrect = userAnswer != null && userAnswer.equalsIgnoreCase(correctAnswer);

               
                insertStmt = conn.prepareStatement("INSERT INTO user_answers (user_id, question_id, user_answer, is_correct) VALUES (?, ?, ?, ?)");
                insertStmt.setInt(1, 1); // Assuming user_id = 1 (can be updated based on session/user authentication)
                insertStmt.setInt(2, questionId);
                insertStmt.setString(3, userAnswer);
                insertStmt.setBoolean(4, isCorrect);
                insertStmt.executeUpdate();

               
                out.println("<p><strong>Question:</strong> " + eventName + "<br>");
                out.println("<strong>Your Answer:</strong> " + (userAnswer != null ? userAnswer : "No answer provided") + "<br>");
                if (isCorrect) {
                    out.println("<strong>Result:</strong> Correct!<br>");
                } else {
                    out.println("<strong>Result:</strong> Incorrect. The correct answer is: " + correctAnswer + "<br>");
                }
                out.println("</p>");

                questionIndex++;
            }

            out.println("</body></html>");
        } catch (Exception e) {
            e.printStackTrace();
            out.println("Error: " + e.getMessage());
        } finally {
            try {
                if (rs != null) rs.close();
                if (stmt != null) stmt.close();
                if (insertStmt != null) insertStmt.close();
                if (conn != null) conn.close();
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
    }
}
