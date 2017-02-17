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
include 'head.php';
include 'header.php';
include 'footer.php';
error_reporting(E_ALL);
ini_set("display_errors", 1);



$welcome = true;
$isContent = false;
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	include 'dbconnect.php';

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

<!--
_/    _/  _/_/_/_/    _/_/    _/_/_/    _/_/_/_/  _/_/_/
_/    _/  _/        _/    _/  _/    _/  _/        _/    _/
_/_/_/_/  _/_/_/    _/_/_/_/  _/    _/  _/_/_/    _/_/_/
_/    _/  _/        _/    _/  _/    _/  _/        _/    _/
_/    _/  _/_/_/_/  _/    _/  _/_/_/    _/_/_/_/  _/    _/
-->


	<!-- Right Side -->
	<div class="collapse navbar-collapse" id="navbar-collapse-1">
		<ul class="nav navbar-nav navbar-right">
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
			<?php if (isset($_SESSION["email"])) : ?>
				<li><a href="#"><?php echo $_SESSION["email"]; ?></a></li>
			<?php else : ?>
				<li><a href="login.php">Login</a></li>
			<?php endif?>
		</ul>
	</div>
</nav>

<body>
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
</body>
</html>
