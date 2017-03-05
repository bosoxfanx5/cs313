/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package edu.byui.cs313.teamactivity;

import java.io.BufferedWriter;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Timestamp;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 *
 * @author brooksrobison
 */
@WebServlet(name = "SubmitPost", urlPatterns = {"/SubmitPost"})
public class SubmitPost extends HttpServlet {

    /**
     * Handles the HTTP <code>GET</code> method.
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
    }

    /**
     * Handles the HTTP <code>POST</code> method.
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        String content = request.getParameter("content");
        String username = (String) request.getSession().getAttribute("username");
        
        Date date = new Date();
        long time = date.getTime();
        Timestamp ts = new Timestamp(time);
        
        SimpleDateFormat sdf = new SimpleDateFormat("dd-MM-yyyy HH:mm");
        String timestamp = sdf.format(new Date());
        

        File file = new File(getServletContext().getRealPath("/") + "content.txt");

        if (!file.exists()) {
            file.createNewFile();
        }

        BufferedWriter out = new BufferedWriter(new FileWriter(file, true));

        out.write(content + ", " + username + ", " + timestamp + "\n");
        out.close();
        response.sendRedirect("ReadPost");
    }
}
