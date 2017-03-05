<%-- 
    Document   : login
    Created on : Feb 28, 2017, 9:42:20 PM
    Author     : brobison
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Brooks Robison | Post Forum</title>
        <script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="jumbotron vertical-center">
            <div class="container">
                <h1 style="text-align: center">Discussion Forum Posts Login</h1>
            </div>
        </div>
        <div class="container">
            <form action="Login" method="POST">
                Username: <input type="text" name="username"><br>
                Password: <input type="password" name="password"><br>
                <br>
                <input type="submit" value="Submit">
            </form>
        </div>
</body>
</html>
