<?php $view->extend('::TeamRace.html.php'); ?>

<?php $view['slots']->start('navigation'); ?>

<a id="navigationHome" href="<?php echo $view['router']->generate('TeamRaceExternalIndex', array(), true); ?>">teamRace</a><span class="navigationSpacer"></span>
<a class="navigationItem" href="<?php echo $view['router']->generate('TeamRaceExternalAbout', array(), true); ?>">about</a><span class="navigationSpacer"></span>
<a class="navigationItem" href="<?php echo $view['router']->generate('TeamRaceExternalLogin', array(), true); ?>">login</a><span class="navigationSpacer"></span>
<a class="navigationItem" href="<?php echo $view['router']->generate('TeamRaceExternalRegister', array(), true); ?>">register</a><span class="navigationSpacer"></span>

<?php $view['slots']->stop(); ?>
