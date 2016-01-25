<?php
$tab = array('Aventure', 'Action', 'Horeure', 'Sci-Fi');
?>

<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>                        
			</button>
			<a class="navbar-brand" href="<?php echo WEBROOT ?>"><span class="glyphicon glyphicon-home"></span> Accueil</a>
		</div>

		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="<?php echo WEBROOT ?>">Nouveauté</a></li>
				<li><a href="<?php echo WEBROOT ?>">Populaire</a></li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo WEBROOT ?>">Catégories<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo WEBROOT.'book/category/all/'; ?>">Tous</a></li>
						<li><a href="<?php echo WEBROOT.'book/category/'; ?>">Catégories</a></li>
						<li class="divider"></li>
						<?php foreach ($tab as $key => $value): ?>
							<li><a href="<?php echo WEBROOT.'book/category/'.$value; ?>"><?php echo $value; ?></a></li>
						<?php endforeach; ?>
					</ul>
				</li>
			</ul>

			<form class="navbar-form navbar-left">
				<div class="form-group input-group">
					<input type="text" placeholder="Recherche" class="form-control">
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit">
							<span class="glyphicon glyphicon-search"></span>
						</button>
					</span>
				</div>
			</form>
		
			<?php if($can_minimize){ ?>
				<a class="btn btn-primary navbar-btn" role="button" href="<?php echo $_SERVER['REDIRECT_URL'].'?m=true'; ?>">Minimiser</a>
			<?php } ?>

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