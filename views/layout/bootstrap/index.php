<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo (isset($title)) ? $title : Site_Name ; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		
		<script type="text/javascript">
			var phpvar = <?php echo $jsvars; ?>;
		</script>

		<style type="text/css">
		body {
			padding-top: 50px;
			padding-bottom: 20px;
		}
		</style>
	</head>
	<body>
		<?php include 'parts/nav.php'; ?>
		<?php include 'parts/header.php'; ?>
		<div class="container">

			<?php if(empty($this->user))
				include 'parts/connection_modal.php'; ?>

			<?php echo $content_for_layout; ?>
			<!--
			<div>
				<h2 style="margin:5px;">Nouveautés</h2>
				<hr>

				<div style="padding:0 20px;">
					<h4>Lorem ipsum</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
					<hr>

					<h4>Lorem ipsum</h4>
					<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
					<hr>
					
					<h4>Lorem ipsum</h4>
					<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
					<hr>
					
					<h4>Lorem ipsum</h4>
					<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</div>
			</div>
			-->
			<hr>
			<div>
				<button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#debug-value-container">Debug</button>
				<div id="debug-value-container" class="collapse">
					<div class="well" style="overflow-y: auto;">
						<ul style="list-style:none; padding-left: 0px;">
							<li><?php echo Util::SublimTab($this, 'Controller'); ?></li>
							<li><?php echo Util::SublimTab($_COOKIE, 'Cookie'); ?></li>
							<li><?php echo Util::SublimTab($_GET, 'Get'); ?></li>
							<li><?php echo Util::SublimTab($_POST, 'Post'); ?></li>
							<li><?php echo Util::SublimTab($_SERVER, 'Server'); ?></li>
							<li><?php echo Util::SublimTab($_SESSION, 'Session'); ?></li>
							<li><?php echo Util::SublimTab($this->user, 'User'); ?></li>
						</ul>
					</div>
				</div>
			</div> 
		</div>
		<?php foreach ($jsfiles as $key => $jsfile): ?>
			<script src="<?php echo ($jsfile); ?>"></script>
		<?php endforeach; ?>
	</body>
</html>



