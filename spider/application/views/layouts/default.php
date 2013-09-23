<!DOCTYPE html>
<html>
  	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<link href="<?php echo base_url('public/bootstrap/css/bootstrap.css');?>" rel="stylesheet" media="screen" />

		<title><?php echo $template['title']; ?></title>
		<?php echo $template['metadata']; ?>
	</head>

	<body style="margin-top:30px;margin-bottom:30px;">

		<div class="container">
			<div class="alert alert-info">Spider</div>
			<?php echo $template['body'];?>
		</div>
		
	</body>
</html>