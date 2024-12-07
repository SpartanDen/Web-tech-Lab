import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;

public class HistoryServlet extends HttpServlet {
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        String continent = request.getParameter("continent");

        response.setContentType("text/html");
        PrintWriter out = response.getWriter();

        out.println("<html>");
        out.println("<head><title>History of " + continent + "</title>");
        out.println("<style>");
        out.println("body { font-family: 'Georgia', serif; background-color: #f9f6f1; color: #4e4e4e; padding: 20px; }");
        out.println("h1 { color: #3b3b3b; }");
        out.println("p { font-size: 20px; }");
        out.println("footer { margin-top: 40px; font-size: 14px; text-align: center; color: #777; }");
        out.println("</style></head>");
        out.println("<body>");
        
        out.println("<h1>History of " + continent + "</h1>");

        // Display some dummy historical facts
        if (continent.equalsIgnoreCase("Asia")) {
            out.println("<p>Asia is the largest continent, home to the Great Wall of China, Taj Mahal, and Mount Everest.</p>");
        } else if (continent.equalsIgnoreCase("Africa")) {
            out.println("<p>Africa is known for the pyramids of Egypt, the Sahara Desert, and its rich cultural diversity.</p>");
        } else {
            out.println("<p>Information on " + continent + " will be updated soon!</p>");
        }

        out.println("<footer>&copy; 2024 Vintage History</footer>");
        out.println("</body></html>");
    }
}
