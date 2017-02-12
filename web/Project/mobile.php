<!--
Host: ec2-54-163-246-165.compute-1.amazonaws.com
Database: de0qfpfe2sp27l
User: kjufgxkwzbdxoe
Port: 5432
Password: 7df3e724097d356a12363ec6ff37de41a1dce21c3c4767b88d5d7de61086d5df
URI: postgres://kjufgxkwzbdxoe:7df3e724097d356a12363ec6ff37de41a1dce21c3c4767b88d5d7de61086d5df@ec2-54-163-246-165.compute-1.amazonaws.com:5432/de0qfpfe2sp27l
Heroku CLI: heroku pg:psql postgresql-cubic-94519 --app rocky-everglades-86262-->

<?php
session_start();
$welcome = true;
error_reporting(E_ALL);
ini_set("display_errors", 1);
$isContent = false;
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$url = parse_url("postgres://kjufgxkwzbdxoe:7df3e724097d356a12363ec6ff37de41a1dce21c3c4767b88d5d7de61086d5df@ec2-54-163-246-165.compute-1.amazonaws.com:5432/de0qfpfe2sp27l");
	$dbopts = $url;
	$database = new PDO("pgsql:host=" . $dbopts['host'] . "; dbname=" . str_replace('/', '', $dbopts['path']),  $dbopts['user'], $dbopts['pass']);
	$db = $database;
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,TRUE);

	$sql0 = $db->prepare("SELECT id, title FROM s_saleable_item");
	$sql0->execute();
	$result0 = $sql0->fetchAll(PDO::FETCH_ASSOC);

	if (!empty($_GET['id'])) {
		$isContent = true;
		$welcome = false;
		$sql = $db->prepare("SELECT * FROM s_saleable_item
			WHERE id = :id");
			$sql->execute(array(":id" => $_GET['id']));
			$result = $sql->fetch(PDO::FETCH_ASSOC);
	}
}
//check session for visitor id


if (empty($_SESSION["id"])) {
	$sql1 = $db->prepare("INSERT INTO s_person (id) VALUES (uuid_generate_v4())");
	$sql1->execute();

	// 	//retrieve new person id
	$personID = $db->lastInsertId();

	$sql1 = $db->prepare("SELECT id FROM s_person WHERE autoinc='$personID'");
	$sql1->execute();
	$result1 = $sql1->fetch();
	$_SESSION["id"] = $result1["id"];

}


//retrieve item id
if (!empty($_GET['id'])) {
	$isContent = true;
	$sql = $db->prepare("SELECT * FROM s_saleable_item
		WHERE id = :id");
		$sql->execute(array(":id" => $_GET['id']));
		$result2 = $sql->fetch(PDO::FETCH_ASSOC);
		$itemID = $result2["id"];

		$personID = $_SESSION["id"];
		$sql1 = $db->prepare("INSERT INTO s_visited_items (visitor_id, item_id) VALUES ('$personID', '$itemID')");
		$sql1->execute();
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

	<!-- Custom styles for this template -->
	<link href="sticky-footer-navbar.css" rel="stylesheet">
	<link rel="stylesheet" href="mobile.css">
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
				<li><a href="mobile.php">Product View</a></li>
			</ul>
		</div>
	</div>

	<!-- Center -->
	<div class="navbar-center navbar-brand" href="#"><a class="navbar-brand"></a></div>
	<!-- Collect the nav links, forms, and other content for toggling -->

	<!-- Right Side -->
	<div class="collapse navbar-collapse" id="navbar-collapse-1">
		<ul class="nav navbar-nav navbar-right">
			<?php if (isset($_POST["email"])) : ?>
				<li><?php echo $_POST["email"]; ?>
			<?php endif ?>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Select Item<b class="caret"></b></a>
				<ul class="dropdown-menu">
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
			<li><a href="login.php">Login</a></li>
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
<?php if ($welcome) : ?>
	<div class="container">
		<div class="page-header">
			<h1>Welcome!</h1>
			<p>Start by selecting an item from the dropdown menu.</p>
			<p>For this project and the sake of making it easy for you to navigate, instead of requiring
				a product key, we supplied you a dropdown menu to choose a product. This will return the data
				associated with that product and update information in the database about you, the user.</p>
			</div>
		<?php else : ?>
			<?php if(!$isContent) : ?>
				<?php if (!empty($result)) : ?>
					<?php foreach($result as $row) : ?>
						<?php print_r('<strong><a href="mobile.php?id='
						. $row["id"]          . '">'
						. $row["title"]       . " "
						. $row["description"] . ":"
						. $row["title"]       .
						'</a></strong><br><br>'); ?>
					<?php endforeach ?>
				<?php endif ?>
			<?php else : ?>
				<div>
					<h1><?php echo $result["title"] ?></h1>
					<p>UPC: <?php echo $result["upc"] ?></p>
					<br><br>
				</div>
				<div class="container">
					<h1>Description</h1>
					<p><?php echo $result["description"] ?></p>
				</div>
			</div>
			<div class="container">
				<div class="row push-to-bottom">
					<div class="column">
						<h2>Price: $<?php echo $result["price"] ?> per lb.</h2>
					</div>
				</div>
			</div>
		<?php endif ?>
	<?php endif ?>
	<!--
	_/_/_/_/    _/_/      _/_/    _/_/_/_/_/  _/_/_/_/  _/_/_/
	_/        _/    _/  _/    _/      _/      _/        _/    _/
	_/_/_/    _/    _/  _/    _/      _/      _/_/_/    _/_/_/
	_/        _/    _/  _/    _/      _/      _/        _/    _/
	_/          _/_/      _/_/        _/      _/_/_/_/  _/    _/
-->
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
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
</body>
</html>
