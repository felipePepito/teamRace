<?php $view->extend('::TeamRace.html.php'); ?>

<?php $view['slots']->start('navigation'); ?>

<a id="navigationHome" href="<?php echo $view['router']->generate('TeamRaceExternalIndex', array(), true); ?>">teamRace</a><span id="navigationSpacer"></span>
<a id="navigationItem" href="<?php echo $view['router']->generate('TeamRaceExternalAbout', array(), true); ?>">about</a><span id="navigationSpacer"></span>
<a id="navigationItem" href="<?php echo $view['router']->generate('TeamRaceExternalLogin', array(), true); ?>">login</a><span id="navigationSpacer"></span>
<a id="navigationItem" href="<?php echo $view['router']->generate('TeamRaceExternalRegister', array(), true); ?>">register</a><span id="navigationSpacer"></span>

<?php $view['slots']->stop(); ?>
