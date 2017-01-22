<?php
session_start();

// Config PHP To Display Errors
error_reporting(E_ALL);
ini_set("display_errors", 0);


$results = array();
$results = read();
$showForm = true;

// radio button question : gender array
$genders = array(
	"M" => "Male",
	"F" => "Female"
);

//radio button quesiton : console types array
$consoles = array(
	"XB1" => "Xbox One",
	"PS4" => "PlayStation 4",
	"PC" => "PC"
);


// radio button question : hours play per week array
$hours = array(
	"1" => "One",
	"2" => "Two",
	"3" => "Three",
	"4" => "Four",
	"5" => "Five",
	"6+" => "Six+"
);

//radio button question : mode type array
$modes = array(
	"OM" => "Online Multiplayer",
	"OS" => "Offline Solo"
);

function write($array) {
	$file = fopen("results.txt", "w") or die("Unable to open file");
	fwrite($file, json_encode($array));
	fclose($file);
}

function read() {
	$file = fopen("results.txt", "r") or die("Unable to open file");
	$contents = fread($file, filesize("results.txt"));
	fclose($file);
	return json_decode($contents);
}

// https://xkcd.com/327/
function sanitize($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if($_SESSION["visited"] == true) {
	$showForm = false;
} else {
	$showForm = true;
}


// If the form was posted with a Name variable...
// another option... if ($_SERVER["REQUEST_METHOD"] == "POST")
// then, sanitize and validate using emtpty()

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if(isset($_POST["results"])) {
		$showForm = false;
	} else {

		$_SESSION["visited"] = true;
		$name = ($_POST["Name"]);
		$hour = ($_POST["Hour"]);
		$gender = ($_POST["Gender"]);
		$console = ($_POST["Console"]);
		$mode = ($_POST["Mode"]);

		$results[] = $gender;
		$results[] = $hour;
		$results[] = $console;
		$results[] = $mode;
		write($results);
		$showForm = false;
	}

}


$count = array_count_values($results);
$total = $count["M"];
$total += $count["F"];


?>

<!DOCTYPE html>
<html lang="en-us">
<head>
	<title>Brooks Robison | Survey</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="survey.css"/>
	<script type="text/javascript" src="survey.js"></script>

</head>
<body>
	<div class="mycontain">
		<div>
			<?php // DISPLAYING FORM ?>
			<?php if ($showForm): ?>
				<div class="row">
					<div class="col-md-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-5 col-lg-offset-0">
						<div class="panel panel-danger">
							<div class="panel-heading">
								<h3 class="panel-title">
									Video Game Survey
								</h3>
							</div>
							<div class="panel-body">
								<div class="col-md-10">
									<form action="" method="POST">
										<?php // use isset() here to populate the fields with previous values ?>
										<div class="form-group">
											<label class="control-label" for="Name">Name *</label>
											<input class="form-control"
											type="text"
											name="Name"
											id="Name"
											placeholder="Name">
											<!-- <span class="error"><?php echo $nameErr; ?></span> -->
										</div>

										<label class="control-label" for="Gender">Male or Female?</label>
										<br>
										<?php // Build list of majors - radios ?>
										<?php foreach ($genders as $code => $long): ?>
											<div class="radio">
												<input  type="radio"
												name="Gender"
												id="<?php echo $code; ?>"
												value="<?php echo $code; ?>"
												<?php if(isset($gender) && $code == $gender) { echo ' checked'; } ?>>
												<label class="control-label" for="<?php echo $code; ?>"><?php echo $long ?></label>
											</div>
										<?php endforeach ?>
										<br>

										<label class="control-label" for="Hour">How many hours on average do you play video games per week?</label>
										<br>
										<?php // Build list of majors - radios ?>
										<?php foreach ($hours as $code => $time): ?>
											<div class="radio">
												<input  type="radio"
												name="Hour"
												id="<?php echo $code; ?>"
												value="<?php echo $code; ?>"
												<?php if(isset($hour) && $code == $hour) { echo ' checked'; } ?>>
												<label class="control-label" for="<?php echo $code; ?>"><?php echo $time ?></label>
											</div>
										<?php endforeach ?>
										<br>

										<label class="control-label" for="Console">What console do you play on the most?</label>
										<br>
										<?php // Build list of majors - radios ?>
										<?php foreach ($consoles as $code => $machine): ?>
											<div class="radio">
												<input  type="radio"
												name="Console"
												id="<?php echo $code; ?>"
												value="<?php echo $code; ?>"
												<?php if(isset($console) && $code == $console) { echo ' checked'; } ?>>
												<label class="control-label" for="<?php echo $code; ?>"><?php echo $machine ?></label>
											</div>
										<?php endforeach ?>
										<br>

										<label class="control-label" for="Mode">What mode do you play games in the most?</label>
										<br>
										<?php // Build list of majors - radios ?>
										<?php foreach ($modes as $code => $style): ?>
											<div class="radio">
												<input  type="radio"
												name="Mode"
												id="<?php echo $code; ?>"
												value="<?php echo $code; ?>"
												<?php if(isset($mode) && $code == $mode) { echo ' checked'; } ?>>
												<label class="control-label" for="<?php echo $code; ?>"><?php echo $style ?></label>
											</div>
										<?php endforeach ?>
										<br>

										<input class="btn btn-primary" type="submit" name="Submit" value="Submit">

									</div>
								</div>
								<div class="panel-footer">
									<div style="font-size: smaller;">
										&nbsp;
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<form action="" method="POST">
					<input type="hidden" name="results" value="View Results">
					<input type="submit" id="results" value="View Results">
				</form>
				<?php // DISPLAYING RESULTS ?>
			<?php else: ?>
				<div class="row">
					<div class="col-md-7 col-xs-offset-0 col-sm-offset-0 col-md-offset-6 col-lg-offset-0">
						<div class="panel panel-danger" style="border-width: 2px;">
							<div class="panel-heading">
								<h3 class="panel-title" style="font-weight: bolder;">
									Results
								</h3>
							</div>
							<div class="panel-body">
								<div class="col-md-7 result">
									<p>Genders:</p>
									<?php foreach($genders as $code => $long): echo $long?>:
										<?php if($count[$code] != null):?>
											<?php echo round(($count[$code] / $total), 2) * 100;?>%<br>
										<?php else: echo "0" ?>
										<?php endif?>
									<?php endforeach?>
								</div>
							</div>
							<div class="panel-body">
								<div class="col-md-7 result">
									<p>Hours:</p>
									<?php foreach($hours as $code => $time): echo $time?>:
										<?php if($count[$code] != null):?>
											<?php echo round(($count[$code] / $total), 2) * 100;?>%<br>
										<?php else: echo "0" ?>
										<?php endif?>
									<?php endforeach?>
								</div>
							</div>
							<div class="panel-body">
								<div class="col-md-7 result">
									<p>Consoles:</p>
									<?php foreach($consoles as $code => $machine): echo $machine?>:
										<?php if($count[$code] != null):?>
											<?php echo round(($count[$code] / $total), 2) * 100;?>%<br>
										<?php else: echo "0" ?>
										<?php endif?>
									<?php endforeach?>
								</div>
							</div>
							<div class="panel-body">
								<div class="col-md-7 result">
									<p>Modes:</p>
									<?php foreach($modes as $code => $style): echo $style?>:
										<?php if($count[$code] != null):?>
											<?php echo round(($count[$code] / $total), 2) * 100;?>%<br>
										<?php else: echo "0";?>
										<?php endif?>
									<?php endforeach?>
								</div>
							</div>
						</div>
						<div>
							<div>
								&nbsp;
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
</div>
</body>
</html>
