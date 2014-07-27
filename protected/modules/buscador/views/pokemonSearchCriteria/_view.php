<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pokemon')); ?>:</b>
	<?php echo CHtml::encode($data->id_pokemon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('haircut')); ?>:</b>
	<?php echo CHtml::encode($data->haircut); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('clothes')); ?>:</b>
	<?php echo CHtml::encode($data->clothes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('weird_sex')); ?>:</b>
	<?php echo CHtml::encode($data->weird_sex); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('object')); ?>:</b>
	<?php echo CHtml::encode($data->object); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cute')); ?>:</b>
	<?php echo CHtml::encode($data->cute); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('animal')); ?>:</b>
	<?php echo CHtml::encode($data->animal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('myth')); ?>:</b>
	<?php echo CHtml::encode($data->myth); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('moustache')); ?>:</b>
	<?php echo CHtml::encode($data->moustache); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hurr')); ?>:</b>
	<?php echo CHtml::encode($data->hurr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rough')); ?>:</b>
	<?php echo CHtml::encode($data->rough); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fluffy')); ?>:</b>
	<?php echo CHtml::encode($data->fluffy); ?>
	<br />

	*/ ?>

</div>