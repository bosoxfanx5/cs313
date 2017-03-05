/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package edu.byui.cs313.teamactivity.model;

import java.sql.Timestamp;
import java.text.SimpleDateFormat;
import java.util.Date;
/**
 *
 * @author brooksrobison
 */

public class Post {
    private String content;
    private String username;
    private String timestamp;

    public Post() {
        
    }
    
    public String getContent() {
        return content;
    }

    public void setContent(String content) {
        this.content = content;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getTimestamp() {
        return timestamp;
    }
    
    public String toFileString() {
        return content + "," + username + "," + timestamp;
    }
    
    public void setTimestamp(String timeSt) {
        this.timestamp = timeSt;
    
    }
}
