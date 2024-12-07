import java.io.*;
import javax.servlet.*;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.*;

@WebServlet("/trackVisits")
public class trackVisits extends HttpServlet {

    @Override
    public void init() throws ServletException {
        ServletContext context = getServletContext();
        if (context.getAttribute("hitCount") == null) {
            context.setAttribute("hitCount", 0);
        }
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        response.setContentType("text/html");

        ServletContext context = getServletContext();
        synchronized (context) {
            int hitCount = (int) context.getAttribute("hitCount");
            hitCount++;
            context.setAttribute("hitCount", hitCount);
        }

        int currentHitCount = (int) context.getAttribute("hitCount");

        PrintWriter out = response.getWriter();
        out.println("<html>");
        out.println("<head>");
        out.println("<style>");
        out.println("body { font-family: Georgia, serif; background-color: #2c2c2c; color: #f1f1f1; text-align: center; padding: 50px; }");
        out.println(".hitcount-box { background-color: #3b3b3b; padding: 30px; border-radius: 10px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.6); width: 50%; margin: 0 auto; }");
        out.println(".hitcount-box h2 { font-size: 2.5rem; color: #d4af37; }");
        out.println(".hitcount-box p { font-size: 1.5rem; }");
        out.println(".hitcount-box .count { font-size: 2.5rem; font-weight: bold; color: #d4af37; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); }");
        out.println("</style>");
        out.println("</head>");
        out.println("<body>");
        out.println("<div class='hitcount-box'>");
        out.println("<h2>Time Travel Visit Count</h2>");
        out.println("<p>You've ventured through time <span class='count'>" + currentHitCount + "</span> times!</p>");
        out.println("</div>");
        out.println("<br><a href='index.html' style='text-decoration: none; color: #d4af37;'>Back to History</a>");
        out.println("</body>");
        out.println("</html>");
    }
}
