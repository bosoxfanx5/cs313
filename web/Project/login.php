<!--
Host: ec2-54-163-246-165.compute-1.amazonaws.com
Database: de0qfpfe2sp27l
User: kjufgxkwzbdxoe
Port: 5432
Password: 7df3e724097d356a12363ec6ff37de41a1dce21c3c4767b88d5d7de61086d5df
URI: postgres://kjufgxkwzbdxoe:7df3e724097d356a12363ec6ff37de41a1dce21c3c4767b88d5d7de61086d5df@ec2-54-163-246-165.compute-1.amazonaws.com:5432/de0qfpfe2sp27l
Heroku CLI: heroku pg:psql postgresql-cubic-94519 --app rocky-everglades-86262
-->

<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$url = parse_url("postgres://kjufgxkwzbdxoe:7df3e724097d356a12363ec6ff37de41a1dce21c3c4767b88d5d7de61086d5df@ec2-54-163-246-165.compute-1.amazonaws.com:5432/de0qfpfe2sp27l");
	$dbopts = $url;
	$database = new PDO("pgsql:host=" . $dbopts['host'] . "; dbname=" . str_replace('/', '', $dbopts['path']),  $dbopts['user'], $dbopts['pass']);
	$db = $database;
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,TRUE);

	// $fname = $_POST['fname'];
	// $lname = $_POST['lname'];
	// $gender = $_POST['gender'];
	$email = $_POST['email'];
	$password = $_POST['password'];


	$personID = $_SESSION["id"];

	if (isset($_SESSION["id"])) {
		$sql0 = $db->prepare("SELECT email, psswd FROM s_person WHERE id='$personID'");
		$sql0->execute();
		$result = $sql0->fetch();

		if ($result['email'] == $email && $result['password'] == $password) {
			$userFound = true;
			$forgot = true;
			echo "User Found";

		} else {
			$userFound = false;
			$creation = true;
			$forgot = false;
			echo "User not found";
		}
	}









}



// $welcome = true;
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
// $isContent = false;
// if ($_SERVER['REQUEST_METHOD'] == 'GET') {
// 	$url = parse_url("postgres://kjufgxkwzbdxoe:7df3e724097d356a12363ec6ff37de41a1dce21c3c4767b88d5d7de61086d5df@ec2-54-163-246-165.compute-1.amazonaws.com:5432/de0qfpfe2sp27l");
// 	$dbopts = $url;
// 	$database = new PDO("pgsql:host=" . $dbopts['host'] . "; dbname=" . str_replace('/', '', $dbopts['path']),  $dbopts['user'], $dbopts['pass']);
// 	$db = $database;
// 	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,TRUE);
//
// 	$sql0 = $db->prepare("SELECT id, title FROM s_saleable_item");
// 	$sql0->execute();
// 	$result0 = $sql0->fetchAll(PDO::FETCH_ASSOC);
//
// 	if (!empty($_GET['id'])) {
// 		$isContent = true;
// 		$welcome = false;
// 		$sql = $db->prepare("SELECT * FROM s_saleable_item
// 			WHERE id = :id");
// 			$sql->execute(array(":id" => $_GET['id']));
// 			$result = $sql->fetch(PDO::FETCH_ASSOC);
// 	}
// }
//
//
//
// //check session for visitor id
//
//
// if (empty($_SESSION["id"])) {
// 	$sql1 = $db->prepare("INSERT INTO s_person (id) VALUES (uuid_generate_v4())");
// 	$sql1->execute();
//
// 	// 	//retrieve new person id
// 	$personID = $db->lastInsertId();
//
// 	$sql1 = $db->prepare("SELECT id FROM s_person WHERE autoinc='$personID'");
// 	$sql1->execute();
// 	$result1 = $sql1->fetch();
// 	$_SESSION["id"] = $result1["id"];
//
// }
//
//
// //retrieve item id
// if (!empty($_GET['id'])) {
// 	$isContent = true;
// 	$sql = $db->prepare("SELECT * FROM s_saleable_item
// 		WHERE id = :id");
// 		$sql->execute(array(":id" => $_GET['id']));
// 		$result2 = $sql->fetch(PDO::FETCH_ASSOC);
// 		$itemID = $result2["id"];
//
// 		$personID = $_SESSION["id"];
// 		$sql1 = $db->prepare("INSERT INTO s_visited_items (visitor_id, item_id) VALUES ('$personID', '$itemID')");
// 		$sql1->execute();
// }
$database = null;
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="Front-end UI">
	<meta name="author" content="Brooks Robison">
	<link rel="icon" href="/favicon.ico">

	<title>Front-end UI</title>

	<!-- Custom styles for this template -->
	<link href="sticky-footer-navbar.css" rel="stylesheet">
	<link rel="stylesheet" href="mobile.css">
	<link rel="stylesheet" href="login.css">
</head>

<body>
	<?php echo $_SESSION["id"]; ?>
	<!-- Fixed navbar -->
	<nav class="navbar navbar-default" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			&nbsp;
			<!-- Left Side -->
			<div class="btn-group">
				<ul class="nav navbar-nav navbar-left">
					<li><a href="mobile.php">Login</a></li>
				</ul>
			</div>
		</div>

		<!-- Center -->
		<div class="navbar-center navbar-brand" href="#"><a class="navbar-brand"></a></div>
		<!-- Collect the nav links, forms, and other content for toggling -->

		<!-- Right Side -->
		<div class="collapse navbar-collapse" id="navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="mobile.php">Product View</a></li>
				<li><a href="login.php">Login</a></li>
			</ul>
		</div>
	</nav>

	<!-- Begin page content -->

	<div id="setPass" class="overlay">
		<a href="javascript:void(0)" id="closeSet" class="closebtn">&times;</a>
		<div class="overlay-content">
			<div class="wrapper">
				<form class="form-signin" method="POST">
					<h2>Forgot your password? No biggie.</h2>
					<input type="text" class="form-control" name="newEmail" placeholder="Email Address"/>
					<br>
					<input type="password" class="form-control" name="newPassword" placeholder="New Password"/>
					<button id="save" class="btn btn-success" type="submit">Save</button>
				</form>
			</div>
		</div>
	</div>

	<div id="creation" class="overlay">
		<a href="javascript:void(0)" id="closeCreate" class="closebtn">&times;</a>
		<div class="overlay-content">
			<div class="wrapper">
				<div class="form-group">
				<form class="form-signin" method="POST">
					<h2>You want to join? Sweet!</h2>
					<p>Fill out the form and click submit.</p>
					<input type="text" class="form-control" name="fname" placeholder="First Name" required>
					<br>
					<input type="text" class="form-control" name="lname" placeholder="Last Name" required>
					<br>
					<div class="radio">
						<input type="radio" name="gender" value="Male">
						<label class="control-label" for="Male">Male</label>
						<br>
						<input type="radio" name="gender" value="Female">
						<label class="control-label" for="Female">Female</label>
						<br>
					</div>
					<input type="text" class="form-control" name="createEmail" placeholder="Email Address" required>
					<br>
					<input type="password" class="form-control" name="createPassword" placeholder="Password" required>
					<button id="submitCreate" class="btn btn-success" type="submit">Submit</button>
				</div>
				</form>
			</div>
		</div>
	</div>

	<div class="wrapper">
		<form class="form-signin" method="POST" action=<?php if($userFound == true){echo "mobile.php";} else {echo "";} ?>>
			<h2 class="form-signin-heading">Please login</h2>
			<input type="text" class="form-control" name="email" placeholder="Email Address" required>
			<br>
			<input type="password" class="form-control" name="password" placeholder="Password" required>
			<br>
			<button class="btn btn-success" type="submit">Login</button>
			<a href="#" id="forgot">Forgot Password</a> or <a href="#" id="createNew">Create New Login</a>
		</form>
	</div>



	<!-- Begin footer content -->

	<footer class="footer">
		<nav class="navbar navbar-default">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<!-- Left Side -->
				<div class="btn-group">
					<ul class="nav navbar-nav navbar-left">
						&nbsp;
						<li><a href="#">Copyright 2017 Brooks Robison, All Rights Reserved</a></li>
					</ul>
				</div>
			</div>
			<!-- Center -->
			<div class="navbar-center navbar-brand" href="#"><a class="navbar-brand"></a></div>
			<!-- Collect the nav links, forms, and other content for toggling -->

		</nav>
	</footer>


	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="login.js"></script>
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
</body>
</html>
