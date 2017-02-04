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
error_reporting(E_ALL);
ini_set("display_errors", 1);
$scripture = "";
$isContent = false;
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$url = parse_url("postgres://kjufgxkwzbdxoe:7df3e724097d356a12363ec6ff37de41a1dce21c3c4767b88d5d7de61086d5df@ec2-54-163-246-165.compute-1.amazonaws.com:5432/de0qfpfe2sp27l");
	$dbopts = $url;
	$database = new PDO("pgsql:host=" . $dbopts['host'] . "; dbname=" . str_replace('/', '', $dbopts['path']),  $dbopts['user'], $dbopts['pass']);
	$db = $database;
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if (!empty($_GET['id'])) {
		$isContent = true;
		$sql = $db->prepare("SELECT * FROM items
			WHERE id = :id");
			$sql->execute(array(":id" => $_GET['id']));
			$result = $sql->fetch(PDO::FETCH_ASSOC);
		} else if (!empty($_GET['query'])) {
			$sql = $db->prepare("SELECT * FROM items
				WHERE LOWER(name) LIKE '%" . strtolower($_GET['query']) . "%' OR "
				." LOWER(description) LIKE '%" . strtolower($_GET['query']) . "%'"
			);
			$sql->execute();

			$result = $sql->fetchAll();
		} else {
			$scripture = "Search for stuff!";
		}
	}
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

		<!-- Bootstrap core CSS -->
		<link href="/bs/css/bootstrap.min.css" rel="stylesheet">

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
					<!--input type="text" class="form-control" placeholder="Search"-->
				</div>
				<!--button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button-->
			</form>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#">Collection</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#">Action</a></li>
						<li><a href="#">Another action</a></li>
						<li><a href="#">Something else here</a></li>
						<li class="divider"></li>
						<li><a href="#">Separated link</a></li>
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
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
		<h1>Item Name</h1>
		<p>SKU: 123456789</p>
	</div>
	<p class="lead">Item description.</p>
	<p>Item details.</p>
	<p></p>
	<?php
	if (!$isContent) {
		if (!empty($result)) {
			foreach($result as $row) {
				echo '<strong>
				<a href="teamAssignment.php?id='.$row["id"].'">'
				. $row["name"] . " " . $row["description"] . ":" . $row["name"] . "
				</a>
				</strong><br><br>";
			}
		} else {
			echo 'Search for things!';
		}
	} else {
		echo '<strong>' . $result["name"] . " " . $result["description"] . ":" . $result["name"] . "</strong> - " . $result['name'];
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
	<nav class="navbar navbar-default" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
</body>
</html>
