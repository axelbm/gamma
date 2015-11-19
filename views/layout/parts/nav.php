<?php
$tab = array('Aventure', 'Action', 'Horeure', 'Sci-Fi');
?>

<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="<?php echo WEBROOT ?>"><span class="glyphicon glyphicon-home"></span> Home</a>
		</div>
		<div>
			<ul class="nav navbar-nav">
				<li><a href="<?php echo WEBROOT ?>">Nouveauté</a></li>
				<li><a href="<?php echo WEBROOT ?>">Populaire</a></li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo WEBROOT ?>">Catégories<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo WEBROOT.'book/list/all/'; ?>">Tous</a></li>
						<li><a href="<?php echo WEBROOT.'book/category/'; ?>">Catégories</a></li>
						<li class="divider"></li>
						<?php foreach ($tab as $key => $value): ?>
							<li><a href="<?php echo WEBROOT.'book/list/category/'.$value; ?>"><?php echo $value; ?></a></li>
						<?php endforeach; ?>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="<?php echo WEBROOT.'user/signup/' ?>"><span class="glyphicon glyphicon-user"></span> Inscription</a></li>
				<li><a onclick="$('#connection_modal').modal()"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>
			</ul>
		</div>
	</div>
</nav>