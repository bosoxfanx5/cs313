/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package edu.byui.cs313.teamactivity;

import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import edu.byui.cs313.teamactivity.model.Post;
import java.io.BufferedReader;
import java.io.File;
import java.io.FileReader;
import java.util.ArrayList;
import java.util.Collections;
import java.util.List;

/**
 *
 * @author brooksrobison
 */
@WebServlet(name = "ReadPost", urlPatterns = {"/ReadPost"})
public class ReadPost extends HttpServlet {
    /**
     * Handles the HTTP <code>GET</code> method.
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
      
       List<Post> posts = new ArrayList<Post>();
        
  
        File file = new File(getServletContext().getRealPath("/") + "content.txt");
        
       
        if(!file.exists()) {
            file.createNewFile();
        }
        

        BufferedReader reader = new BufferedReader(new FileReader(file));
        
        
        String line;
        while((line = reader.readLine()) != null) {
            String newString[] = line.split(",");
            Post post = new Post();
            post.setContent(newString[0]);
            post.setUsername(newString[1]);
            post.setTimestamp(newString[2]);
            posts.add(post);
        }
        Collections.reverse(posts);
        request.setAttribute("posts", posts);
        request.getRequestDispatcher("viewPosts.jsp").forward(request, response);
    }

    /**
     * Handles the HTTP <code>POST</code> method.
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
    }
    
}
