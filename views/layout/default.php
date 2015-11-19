<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo (isset($title)) ? $title : Site_Name ; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<?php include 'parts/header.php'; ?>
			<?php include 'parts/nav.php'; ?>
			<?php include 'parts/connection_model.php'; ?>

			<div class="row">
				<div class="col-sm-9">
					<?php echo $content_for_layout; ?>
				</div>
				<div class="col-sm-3">
					<div class="panel panel-default">
						<div class="panel-body">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.  </p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>

	<script src="<?php echo (WEBROOT.'views/layout/js/default.js'); ?>"></script>
</html>



