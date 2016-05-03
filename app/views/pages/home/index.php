<div class="row">
	<div class="col-sm-8">
		<?php foreach ($books as $key => $book): ?>
		<div class="thumbnail">
			<div class="caption">
				<div class="heading">
					<h2>
						<a href="<?php echo WEBROOT.'book/view/'.$book->ID(); ?>"><?php echo $book->Title(); ?></a>
					</h2>
					<p class="lead"><?=$h['by']?> <a href="<?php echo WEBROOT.'user/profil/'.$book->Creator(); ?>"><?php echo $usersname[$book->Creator()]; ?></a></p>
					<p><span class="glyphicon glyphicon-time"></span> <?=$h['posted']?> <?php echo $book->PublicationDate(); ?></p>
				</div>
				<hr>
				<div class="body">
					<p><?php echo $book->Description(); ?></p>
					<a class="btn btn-primary" href="<?php echo WEBROOT.'book/view/'.$book->ID(); ?>">
						<?=$h['see']?>
						<span class="glyphicon glyphicon-chevron-right"></span>
					</a>
				</div>
			</div>
		</div>
		<?php endforeach; ?>


		<ul class="pager">
		<?php if($previous >= 0){ ?>
			<li class="previous"><a href="?p=<?php echo $previous; ?>"><?=$h['previous']?></a></li>
		<?php } ?>
		<?php if($next >= 0){ ?>
			<li class="next"><a href="?p=<?php echo $next; ?>"><?=$h['next']?></a></li>
		<?php } ?>
		</ul>
	</div>

	<div class="col-sm-4">
		<form>
			<div class="form-group input-group">
				<input type="text" placeholder="<?=$h['search']?>" class="form-control">
				<span class="input-group-btn">
					<button class="btn btn-default" type="submit">
						<span class="glyphicon glyphicon-search"></span>
					</button>
				</span>
			</div>
		</form>
		<div class="list-group">
			<a href="<?php echo WEBROOT ?>" class="list-group-item"><?=$h['new']?></a>
			<a href="<?php echo WEBROOT ?>"class="list-group-item"><?=$h['popular']?></a>
			<div class="dropdown">
				<a class="dropdown-toggle list-group-item" data-toggle="dropdown" href="<?php echo WEBROOT ?>"><?=$h['categories']?><span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="<?php echo WEBROOT.'book/category/all/'; ?>"><?=$h['all']?></a></li>
					<li><a href="<?php echo WEBROOT.'book/category/'; ?>"><?=$h['categories']?></a></li>
					<li class="divider"></li>
					<?php foreach ($categories as $key => $value): ?>
						<li><a href="<?php echo WEBROOT.'book/category/'.$value; ?>"><?=$value?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>

		<a role="button" class="btn btn-success btn-block <?php echo empty($user)? 'disabled' : ''; ?>" href="<?php echo WEBROOT.'book/create/'; ?>">
			<span class="glyphicon glyphicon-plus-sign"></span> <?=$h['createbook']?></a>
	</div>
</div>
