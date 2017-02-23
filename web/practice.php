<?php 
error_reporting(E_ALL);
ini_set("display_errors", 0);
if (isset($_POST["submit"])) {
  $error = false;
  $name = $_POST["name"];
  $to = $_POST["email"];
  $message = $_POST["message"];
  
  if (!$_POST["name"]) {
    $errorName = "Please provide your name";
    $error = true;
  }
  
  if (!$_POST["email"] || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $errorEmail = "Please provide your email address";
    $error = true;
  }
  
  if (!$_POST["message"]) {
    $errorMessage = "Please include a message";
    $error = true;
  }
  
  $from = "Ballotpedia";
  $subject = "Contact Form Email";
  
  if (!$error) {
    if (email($to, $subject, $message, $from)) {
      $result = "<div class='alert alert-success'>Thank you! We'll be in contact shortly!</div>";
    } else {
      $result = "<div class='alert alert-danger'>We're sorry, but your email was unable to be sent.</div>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
</head>
<body>
<div class ="container">
  <div class="row">
  	<div class="col-md-6 col-md-offset-3">
      <form id="form-horizontal" method="post" action="" role="form">
    
    <div class="form-group">
      <label class="col-sm-2 control-label" for="name">Name</label>
      <div class="col-sm-10">
        <input class="form-control" type="text" name="name" placeholder="Name">
        <?php echo "<p class='text-danger'>$errorName</p>"; ?>
      </div>
    </div>
    
    <div class="form-group">
      <label class="col-sm-2 control-label" for="email">Email</label>
      <div class="col-sm-10">
        <input class="form-control" type="text" name="email" placeholder="Email">
        <?php echo "<p class='text-danger'>$errorEmail</p>"; ?>
      </div>
    </div>
    
    <div class="form-group">
      <label class="col-sm-2 control-label" for="message">Message</label>
      <div class="col-sm-10">
        <textarea class="form-control" rows="4" type="text" name="message" placeholder="Message"></textarea>
        <?php echo "<p class='text-danger'>$errorMessage</p>"; ?>
      </div>
    </div>
    
    <div class="form-group">
      <div class="col-sm-10 col-sm-offset-2">
        <input type="submit" class="btn btn-primary" name="submt" value="Submit">
      </div>
    </div>
   
    <div class="form-group">
      <div class="col-sm-10 col-sm-offset-2">
        <?php echo $result ?>
      </div>
    </div>
 
    </form>
</div>
</div>
</div>
</body>
</html>
