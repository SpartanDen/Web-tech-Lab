import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;

public class HistoryServlet extends HttpServlet {

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        String period = request.getParameter("period");
        
        if (period == null || period.isEmpty()) {
            response.sendError(HttpServletResponse.SC_BAD_REQUEST, "Period parameter is missing.");
            return;
        }

        response.setContentType("text/html");
        PrintWriter out = response.getWriter();
        out.println("<html><head><title>History of " + period + "</title></head>");
        out.println("<body style='font-family: Georgia, serif; background-color: #f5f5dc; color: #4e342e;'>");
        out.println("<h1>History of the " + period + " Period</h1>");

        switch (period.toLowerCase()) {
            case "ancient":
                out.println("<p>The Ancient period is marked by the emergence of early civilizations, such as Mesopotamia, Egypt, and the Indus Valley.</p>");
                break;
            case "medieval":
                out.println("<p>The Medieval period was dominated by kingdoms, feudalism, and significant cultural and technological advances in Europe and Asia.</p>");
                break;
            case "modern":
                out.println("<p>The Modern period witnessed industrialization, globalization, and world wars shaping contemporary societies.</p>");
                break;
            default:
                out.println("<p>Details about the " + period + " period are not available yet. Stay tuned!</p>");
        }

        out.println("<p><a href='index.html' style='color: #8d6e63;'>Go Back</a></p>");
        out.println("</body></html>");
    }
}
