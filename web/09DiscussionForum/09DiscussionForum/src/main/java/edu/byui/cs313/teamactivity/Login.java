package edu.byui.cs313.teamactivity;

import edu.byui.cs313.teamactivity.model.Post;
import java.io.BufferedReader;
import java.io.File;
import java.io.FileReader;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet(name = "Login", urlPatterns = {"/Login"})
public class Login extends HttpServlet {

    /**
     * Handles the HTTP <code>POST</code> method.
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        // Grab the incoming datas
        String username = request.getParameter("username");
        String password = request.getParameter("password");

        File file = new File(getServletContext().getRealPath("/") + "users.txt");

        if (!file.exists()) {
            file.createNewFile();
        }

        BufferedReader reader = new BufferedReader(new FileReader(file));
// test test test
//        String line;
//        while ((line = reader.readLine()) != null) {
//            String newString[] = line.split(",");
//            String checkUser = newString[0];
//            String checkPass = newString[1];
//            
//            if (username.equals(checkUser)) {
//                if(password.equals(checkPass)) {
//                    response.sendRedirect("newPost.jsp");
//                }
//            } else {
//                // Something was incorrect
//                    request.setAttribute("error", "* Incorrect username/password.");
//                // Redirect back to login.jsp
//                    request.getRequestDispatcher("invalidLogin.jsp").forward(request, response);
//            }
//        } 
//    }
    
        if (username.equals("Lyon") && password.equals("cs313")) {
            request.getSession().setAttribute("username", username);
            response.sendRedirect("newPost.jsp");
        } else {
            // Something was incorrect
            request.setAttribute("error", "* Incorrect username/password.");
            // Redirect back to login.jsp
            request.getRequestDispatcher("invalidLogin.jsp").forward(request, response);
        }
    }

}
