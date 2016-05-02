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
			<hr>
		</div>
		<?php foreach ($jsfiles as $key => $jsfile): ?>
			<script src="<?=$jsfile?>"></script>
		<?php endforeach; ?>
	</body>
</html>



