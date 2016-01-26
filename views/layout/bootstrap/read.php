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
			font-size: 16px;
		}
		@media (min-width: 768px) {
			.container {
				max-width: 1000px;
			}
		}
		</style>
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>                        
					</button>
					<a class="navbar-brand" href="<?php echo WEBROOT ?>"><span class="glyphicon glyphicon-home"></span> <?php echo Site_Name; ?></a>
				</div>


				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<?php if(empty($user)){ ?>
							<li><a href="<?php echo WEBROOT.'user/signup/' ?>"><span class="glyphicon glyphicon-user"></span> Inscription</a></li>
							<li><a href="" data-toggle="modal" data-target="#connection_modal"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>
						<?php 
						}else{  ?>
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo WEBROOT ?>">
									<b><?php echo $user->GetUsername() ?></b> 
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo WEBROOT.'user/profil/'; ?>">Profil</a></li>
									<li><a href="<?php echo WEBROOT.'user/edit/'; ?>">Edit</a></li>
									<li class="divider"></li>
									<li><a href="<?php echo WEBROOT.'user/logout/'; ?>">Logout</a></li>
								</ul>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">
		</div>

		<?php if(empty($this->user))
			include 'parts/connection_modal.php'; ?>

		<div class="container">
			<?php echo $content_for_layout; ?>
		</div>
	</body>
</html>