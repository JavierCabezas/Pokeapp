<div class='clear'> </div>

<div class='types'>
	<?php foreach($types as $type_id => $type_quantity): ?>
		<div class="pkmn_type">
			<p> Usado <b><?php echo $type_quantity ?></b> veces. (<?php echo $types_per[$type_id]?>%) </p>
			<div class='type_pic'>
				<?php echo Types::model()->findByPk($type_id)->image() ?> 
			</div>
		</div>
	<?php endforeach ?>
</div>

<div class='clear'> </div>