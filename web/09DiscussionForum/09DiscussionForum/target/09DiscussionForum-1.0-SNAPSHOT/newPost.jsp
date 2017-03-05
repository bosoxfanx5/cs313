<%-- 
    Document   : newPost
    Created on : Mar 4, 2017, 12:44:02 PM
    Author     : brooksrobison
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
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

        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-2">
                    
                    <form action="SubmitPost" method="POST">
                        <div class="form-group">
                            <label class="form-control-label" for="content">Enter Content:</label>
                            <textarea class="form-control" name="content"></textarea>
                        </div>
                        <input class="btn btn-primary btn-sm" type="submit" value="Submit"/>
                    </form>
                    <br>
                    <a href="ReadPost">View Posts</a>
                </div>
            </div>
        </div>
    </body>
</html>
