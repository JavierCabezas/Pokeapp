<?php $this->setPageTitle('Pokéapp - Inicio'); ?>

<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>

<div style="height:220px;width:auto"></div>

<?php if($is_admin): ?>

	<h2> Menú de admin </h2>

	<?php echo CHtml::link('Autorizar jugadores', array('jugadores/authorize')) ?>

<?php endif; ?>