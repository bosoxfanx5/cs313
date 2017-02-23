<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
if (isset($_POST["submit"])) {
  $error = false;
  $errorName = "";
  $errorEmail = "";
  $errorMessage = "";
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<div class ="containter">
  <form id="form-horizontal" method="post" action="">
    <div class="form-group">
      <label class="col-sm-2 control-label" for="name">Name</label>
      <div class="col-sm-10">
        <input class="form-control" type="text" name="name" placeholder="Name">
        <?php echo "<p class='text-danger'>$errorName</p>" ?>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label" for="email">Email</label>
      <div class="col-sm-10">
        <input class="form-control" type="text" name="email" placeholder="Email">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label" for="message">Message</label>
      <div class="col-sm-10">
        <textarea class="form-control" rows="4" type="text" name="message" placeholder="Message"></textarea>
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
</body>
</html>
