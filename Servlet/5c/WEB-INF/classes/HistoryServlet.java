import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import java.net.*;

public class HistoryServlet extends HttpServlet {

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        String continent = request.getParameter("continent");

        // If continent is not passed, use session or cookie value, or show error
        if (continent == null || continent.isEmpty()) {
            HttpSession session = request.getSession(false);
            if (session != null) {
                continent = (String) session.getAttribute("selectedContinent");
            }
            if (continent == null) {
                response.sendError(HttpServletResponse.SC_BAD_REQUEST, "Continent parameter is missing");
                return;
            }
        }

        // Set session attribute to remember the continent selection
        HttpSession session = request.getSession(true);  // Create or retrieve session
        session.setAttribute("selectedContinent", continent);

        // Encode continent for use in cookies (to avoid special character issues)
        String encodedContinent = URLEncoder.encode(continent, "UTF-8");

        // Add continent cookie if not already set
        Cookie[] cookies = request.getCookies();
        boolean continentCookieFound = false;
        for (Cookie cookie : cookies) {
            if ("continent".equals(cookie.getName())) {
                continentCookieFound = true;
                break;
            }
        }
        
        if (!continentCookieFound) {
            Cookie continentCookie = new Cookie("continent", encodedContinent);
            continentCookie.setMaxAge(60 * 60);  // 1 hour expiry
            response.addCookie(continentCookie);  // Add cookie to response
        }

        // Proceed to render the history page
        response.setContentType("text/html");
        PrintWriter out = response.getWriter();
        out.println("<html>");
        out.println("<head><title>History of " + continent + "</title>");
        out.println("<style>");
        out.println("body { font-family: 'Georgia', serif; background-color: #f9f6f1; color: #4e4e4e; padding: 20px; }");
        out.println("h1 { color: #3b3b3b; }");
        out.println("p { font-size: 20px; }");
        out.println("</style></head>");
        out.println("<body>");
        out.println("<h1>History of " + continent + "</h1>");

        // Display some historical information based on the continent
        if (continent.equalsIgnoreCase("Asia")) {
            out.println("<p>Asia is the largest continent, home to the Great Wall of China, Taj Mahal, and Mount Everest.</p>");
        } else if (continent.equalsIgnoreCase("Africa")) {
            out.println("<p>Africa is known for the pyramids of Egypt, the Sahara Desert, and its rich cultural diversity.</p>");
        } else if (continent.equalsIgnoreCase("North America")) {
            out.println("<p>North America is home to diverse cultures, the Grand Canyon, and major cities like New York and Toronto.</p>");
        } else if (continent.equalsIgnoreCase("South America")) {
            out.println("<p>South America has beautiful landscapes like the Amazon rainforest, the Andes mountains, and historical sites like Machu Picchu.</p>");
        } else {
            out.println("<p>Information on " + continent + " will be updated soon!</p>");
        }

        // Hidden form field
        out.println("<form action='HistoryServlet' method='POST'>");
        out.println("<input type='hidden' name='continent' value='" + continent + "'>");
        out.println("<input type='submit' value='Explore More!'>");
        out.println("</form>");

        out.println("<footer>&copy; 2024 Vintage History</footer>");
        out.println("</body></html>");
    }

    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        // Handle POST requests
        String continent = request.getParameter("continent");

        if (continent == null || continent.isEmpty()) {
            response.sendError(HttpServletResponse.SC_BAD_REQUEST, "Continent parameter is missing");
            return;
        }

        // Output additional details on the continent
        response.setContentType("text/html");
        PrintWriter out = response.getWriter();
        out.println("<html>");
        out.println("<head><title>Explore More on " + continent + "</title></head>");
        out.println("<body>");
        out.println("<h1>Additional Information on " + continent + "</h1>");
        out.println("<p>More detailed information can be found about " + continent + " here.</p>");
        out.println("</body></html>");
    }
}
