<div>
	<h1><?php echo $book['title'] ?> <small> - <?php echo $page['title']?: 'Page '.$page['id']; ?></small></h1>
	<hr>
	<p><?php echo $page['content']; ?></p>
	<?php if(isset($answers) & !empty($answers)){ ?>
		<ul class="list-group">
			<?php foreach ($answers as $key => $answer): ?>
				<li class="list-group-item"><?php echo $answer['id'].': '.$answer['content']; ?></li>
			<?php endforeach ?>
		</ul>
	<?php } ?>
	<hr>
	<h2>Nouveau choix</h2>
	<?php $data = $this->formdata ?: array(); ?>
	<form id="add_page" class="form-horizontal" role="form"  method="post">
		<input name="formid" type="hidden" value="add_page">

		<div class="form-group">
			<label class="control-label col-lg-2" for="email">Contenue</label>
			<div class="col-lg-10">
				<input type="text" class="form-control" name="answer" placeholder="" value="<?php echo $data ? $data['answer']['value'] : '' ?>">

			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-2"><h4><b>Page</b></h4>
				<ul id='action_nav' class="nav nav-pills nav-stacked">
					<li><a id="nav_retake" data-toggle="pill" href="#retake">Reprendre</a></li>
					<li><a id="nav_new" data-toggle="pill" href="#new">Nouvelle</a></li>
				</ul>
			</label>
			<div class="col-lg-10">
				<div class="tab-content" style="margin:20px 15px 0;">
					<div id="retake" class="tab-pane fade in active">
						<div class="form-group" style="margin-bottom:0;">
							<div id="page_list" class="list-group">
								<?php foreach($pages as $key => $p): ?>
									<a id="page_<?php echo $p['id']; ?>" class="list-group-item">
										<h4 class="list-group-item-heading"><?php echo $p['title'] ?: 'Page '.$p['id']; ?></h4>
										
										<div class="collapse">
											<p class="list-group-item-text"><?php echo $p['content']; ?></p>
										</div>
									</a>
								<?php endforeach ?>
							</div>
						</div>
					</div>
					<div id="new" class="tab-pane fade">
						<div class="form-group">
							<label for="title">Titre</label>
							<input type="text" class="form-control" name="title" value="<?php echo $data ? $data['title']['value'] : '' ?>">
						</div>
						<div class="form-group">
							<label for="content">Contenue</label>
							<textarea class="form-control" name="content"><?php echo $data ? $data['content']['value'] : '' ?></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" name="book" value="<?php echo $book['id']; ?>">
		<input type="hidden" name="pageid" value="<?php echo $page['id']; ?>">
		<input id="action_input" type="hidden" name="action" value="">
		<input id="page_input" type="hidden" name="page" value="">
		<button type="submit" class="btn btn-success btn-block">Envoyer</button>
	</form>
</div>