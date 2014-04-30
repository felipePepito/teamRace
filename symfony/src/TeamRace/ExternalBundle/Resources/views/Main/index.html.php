<?php $view->extend('TeamRaceExternalBundle::layout.html.php'); ?>

<?php $view['slots']->start('content'); ?>
<p>This is teamRace.<br><br>

Some text describing the project and its purpose</p>

<p>Check out the 
<a href="<?php echo $view['router']->generate('TeamRaceExternalAbout', array(), true) ?>">about</a> page
</p>
<?php $view['slots']->stop(); ?>