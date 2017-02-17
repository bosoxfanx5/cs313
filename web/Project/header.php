<html>
<!--
_/    _/  _/_/_/_/    _/_/    _/_/_/    _/_/_/_/  _/_/_/
_/    _/  _/        _/    _/  _/    _/  _/        _/    _/
_/_/_/_/  _/_/_/    _/_/_/_/  _/    _/  _/_/_/    _/_/_/
_/    _/  _/        _/    _/  _/    _/  _/        _/    _/
_/    _/  _/_/_/_/  _/    _/  _/_/_/    _/_/_/_/  _/    _/
-->
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
</html>
