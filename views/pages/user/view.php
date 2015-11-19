

<div class="panel panel-default">
	<div class="panel-heading">
		<h2 style="margin: 2px;"><?php echo $user->GetName(); ?></h2>
	</div>
	<div class="panel-body">
		<p><?php echo str_replace('\n', '<br>', $user->GetDescription()) ; ?></p>
	</div>
</div>
