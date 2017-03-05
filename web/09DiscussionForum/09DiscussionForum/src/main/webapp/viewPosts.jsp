<%-- 
    Document   : welcome
    Created on : Feb 28, 2017, 9:51:40 PM
    Author     : brobison
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Welcome</title>
        <script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="jumbotron vertical-center">
            <div class="container">
                <h1>Welcome ${sessionScope.username}</h1>
                <a href="Logout">Logout</a>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-2">
                    <h1>Posts</h1>
                    <div>
                        <c:forEach var="post" items="${posts}" >
                            <p><strong>Post: </strong>${post.content}</p>
                            <p><strong>Username: </strong>${post.username} 
                                <strong>Date Posted: </strong>${post.timestamp}</p>
                        </c:forEach>
                    </div>
                    <a href="newPost.jsp">Add new post</a>
                </div>
            </div>
        </div>
    </body>
</html>
