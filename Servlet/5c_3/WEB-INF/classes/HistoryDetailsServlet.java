import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;

public class HistoryDetailsServlet extends HttpServlet {
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
       
        String eventName = request.getParameter("eventName");

        response.setContentType("text/html");
        PrintWriter out = response.getWriter();

        out.println("<html><head><title>Details of " + eventName + "</title></head>");
        out.println("<body style='font-family: Georgia, serif; background-color: #f8f4e3; color: #4e342e; text-align: center;'>");
        out.println("<h1>Details of " + eventName + "</h1>");

       
        if ("French Revolution".equalsIgnoreCase(eventName)) {
            out.println("<p>The French Revolution (1789–1799) was a period of radical political and societal change in France.</p>");
        } else if ("World War II".equalsIgnoreCase(eventName)) {
            out.println("<p>World War II (1939–1945) was a global conflict involving most of the world's nations, including the Allies and Axis powers.</p>");
        } else if ("Industrial Revolution".equalsIgnoreCase(eventName)) {
            out.println("<p>The Industrial Revolution (18th–19th century) marked the transition to new manufacturing processes in Europe and the United States.</p>");
        } else {
            out.println("<p>Details about the selected event are not available.</p>");
        }

        out.println("<p><a href='index.html' style='color: #8d6e63; text-decoration: none;'>Back to Home</a></p>");
        out.println("</body></html>");
    }
}
