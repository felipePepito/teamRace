<!DOCTYPE html>
<html>
	<head>
    
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php $view['slots']->output('title', 'teamRace') ?></title>
		
        <?php $view['slots']->output('stylesheets') ?>
		
		<link rel="shortcut icon" href="<?php echo $view['assets']->getUrl('favicon.ico') ?>" />
    
	</head>

	<body>

		<?php $view['slots']->output('navigation'); ?>
		
		<?php $view['slots']->output('content'); ?>
		
		<?php $view['slots']->output('javascripts') ?>

	</body>
</html>