<%-- 
    Document   : invalidLogin
    Created on : Mar 4, 2017, 2:50:59 PM
    Author     : brooksrobison
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <c:if test="${not empty error}">
            <p>${error}</p>
        </c:if>
        <a href="login.jsp">Back to login page</a>
    </body>
</html>
