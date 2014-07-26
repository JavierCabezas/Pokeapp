<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tournament_player')); ?>:</b>
	<?php echo CHtml::encode($data->id_tournament_player); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pokemon_species')); ?>:</b>
	<?php echo CHtml::encode($data->id_pokemon_species); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nickname')); ?>:</b>
	<?php echo CHtml::encode($data->nickname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_ability')); ?>:</b>
	<?php echo CHtml::encode($data->id_ability); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_nature')); ?>:</b>
	<?php echo CHtml::encode($data->id_nature); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_item')); ?>:</b>
	<?php echo CHtml::encode($data->id_item); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('id_move1')); ?>:</b>
	<?php echo CHtml::encode($data->id_move1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_move2')); ?>:</b>
	<?php echo CHtml::encode($data->id_move2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_move3')); ?>:</b>
	<?php echo CHtml::encode($data->id_move3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_move4')); ?>:</b>
	<?php echo CHtml::encode($data->id_move4); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('level')); ?>:</b>
	<?php echo CHtml::encode($data->level); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hp')); ?>:</b>
	<?php echo CHtml::encode($data->hp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('atk')); ?>:</b>
	<?php echo CHtml::encode($data->atk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('def')); ?>:</b>
	<?php echo CHtml::encode($data->def); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('spa')); ?>:</b>
	<?php echo CHtml::encode($data->spa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('spd')); ?>:</b>
	<?php echo CHtml::encode($data->spd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('spe')); ?>:</b>
	<?php echo CHtml::encode($data->spe); ?>
	<br />

	*/ ?>

</div>