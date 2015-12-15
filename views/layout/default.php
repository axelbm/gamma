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

			<?php if(empty($this->user))
				include 'parts/connection_model.php'; ?>

			<div class="row">
				<div class="col-sm-8">
					<?php echo $content_for_layout; ?>
				</div>
				<div class="col-sm-4">
					<div class="panel panel-default">
						<div class="panel-body">
							<button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#debug-value-container">Debug</button>
							<div id="debug-value-container" class="collapse panel panel-default">
								<div class="panel-body" style="overflow-y: auto;">
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
				</div>
			</div>
		</div>
	</body>

	<script src="<?php echo (WEBROOT.'views/layout/js/default.js'); ?>"></script>
</html>



