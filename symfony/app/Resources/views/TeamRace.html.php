<!DOCTYPE html>
<html>
	<head>
    
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php $view['slots']->output('title', 'teamRace') ?></title>
		
        <?php $view['slots']->output('stylesheets') ?>
        
        <link href="<?php echo $view['assets']->getUrl('assets/css/mainLayout.css') ?>" rel="stylesheet" type="text/css" />
        
		
	</head>

	<body>

		<div id="navigation">
		<?php $view['slots']->output('navigation'); ?>
		</div>
		<div id="content">
		<?php $view['slots']->output('content'); ?>
		</div>
		
		<?php $view['slots']->output('javascripts') ?>
		

	</body>
</html>