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
error_reporting(E_ALL);
ini_set("display_errors", 1);
$isContent = false;
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$url = parse_url("postgres://kjufgxkwzbdxoe:7df3e724097d356a12363ec6ff37de41a1dce21c3c4767b88d5d7de61086d5df@ec2-54-163-246-165.compute-1.amazonaws.com:5432/de0qfpfe2sp27l");
	$dbopts = $url;
	$database = new PDO("pgsql:host=" . $dbopts['host'] . "; dbname=" . str_replace('/', '', $dbopts['path']),  $dbopts['user'], $dbopts['pass']);
	$db = $database;
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql0 = $db->prepare("SELECT id, title FROM s_item");
	$sql0->execute();
	$result0 = $sql0->fetchAll(PDO::FETCH_ASSOC);

	if (!empty($_GET['id'])) {
		$isContent = true;
		$sql = $db->prepare("SELECT * FROM s_item
			WHERE id = :id");
			$sql->execute(array(":id" => $_GET['id']));
			$result = $sql->fetch(PDO::FETCH_ASSOC);
		}
	}

	//check session for visitor id
	//if empty
		//insert new visitor id into people table
		//insert into visited item table the visitor id and item id
	//else retrieve visitor id
		//insert into visited item table the visitor id and item id






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
	</head>

	<body>
		<!--
		_/    _/  _/_/_/_/    _/_/    _/_/_/    _/_/_/_/  _/_/_/
		_/    _/  _/        _/    _/  _/    _/  _/        _/    _/
		_/_/_/_/  _/_/_/    _/_/_/_/  _/    _/  _/_/_/    _/_/_/
		_/    _/  _/        _/    _/  _/    _/  _/        _/    _/
		_/    _/  _/_/_/_/  _/    _/  _/_/_/    _/_/_/_/  _/    _/
	-->


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
					<li><a href="#">Product View</a></li>
				</ul>
			</div>
		</div>

		<!-- Center -->
		<div class="navbar-center navbar-brand" href="#"><a class="navbar-brand"></a></div>
		<!-- Collect the nav links, forms, and other content for toggling -->

		<!-- Right Side -->
		<div class="collapse navbar-collapse" id="navbar-collapse-1">
			<form class="navbar-form navbar-left" role="search">
				<div class="form-group">
				</div>
			</form>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Select Item<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<!-- <li><a href="#">Item #1</a></li>
						<li><a href="#">Item #2</a></li>
						<li><a href="#">Item #3</a></li>
						<li><a href="#">Item #4</a></li> -->
						<?php
							if (!empty($result0)) {
							foreach($result0 as $row) {
								echo '<li><a href="mobile.php?id='
								. $row["id"]          . '">'
								. $row["title"]       .
								'</a></li>';
							}
						}
						?>
					</ul>
				</li>
			</ul>
		</div>
	</nav>

	<!--
	_/_/_/      _/_/    _/_/_/    _/      _/
	_/    _/  _/    _/  _/    _/    _/  _/
	_/_/_/    _/    _/  _/    _/      _/
	_/    _/  _/    _/  _/    _/      _/
	_/_/_/      _/_/    _/_/_/        _/
-->
<!-- Begin page content -->
<div class="container">
	<div class="page-header">
		<h1>Welcome!</h1>
		<p>Start by selecting an item from the dropdown menu.</p>
		<p>For this project and the sake of making it easy for you to navigate, instead of requiring
			a product key, we supplied you a dropdown menu to choose a product. This will return the data
			associated with that product and update information in the database about you, the user.</p>
	</div>
	<p></p>
	<?php
      if (!$isContent) {
          if (!empty($result)) {
            foreach($result as $row) {
              print_r('<strong><a href="mobile.php?id='
                        . $row["id"]          . '">'
                        . $row["title"]       . " "
                        . $row["description"] . ":"
                        . $row["title"]       .
                      '</a></strong><br><br>');
					echo "This section is active";
            }
          }
        } else {
          print_r('<strong>' . $result["title"]       . " "
                             . $result["description"] . ":"
                             . $result["title"]       . "</strong> - "
                             . $result['title']);
        }
      ?>
</div>

<!--
_/_/_/_/    _/_/      _/_/    _/_/_/_/_/  _/_/_/_/  _/_/_/
_/        _/    _/  _/    _/      _/      _/        _/    _/
_/_/_/    _/    _/  _/    _/      _/      _/_/_/    _/_/_/
_/        _/    _/  _/    _/      _/      _/        _/    _/
_/          _/_/      _/_/        _/      _/_/_/_/  _/    _/
-->

<!-- Begin footer content -->
<footer class="footer">
	<nav class="navbar navbar-default">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			&nbsp;
			<!-- Left Side -->
			<div class="btn-group">
				<ul class="nav navbar-nav navbar-left">
					<li><a href="#">Copyright 2017 Brooks Robison and Dan McDaniel, All Rights Reserved</a></li>
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
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
</body>
</html>
