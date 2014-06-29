<?php
$this->pageTitle=Yii::app()->name;
?>

<div style="height:220px;width:auto"></div>

<?php if($is_admin): ?>

	<h2> Menú de admin </h2>

	<?php echo CHtml::link('Autorizar jugadores', array('jugadores/authorize')) ?>

<?php else: ?>
	
	<?php echo CHtml::link('Entrar sección admin', array('/login')) ?>

<?php endif; ?>