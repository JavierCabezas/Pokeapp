<?php $this->setPageTitle('Pokéapp - Listado de mis pokémon'); ?>

<?php
$this->breadcrumbs=array(
	'Torneo'=>array('/torneo'),
	'Menú de usuario'=>array('/torneo/menuUsuario'),
	'Listado de mis pokémon',
);
?>
<h1 class="modpkmn">Modificar pokémon</h1>
<div class="infosec">
	<p>Para editar un pokémon en específico haz click sobre su nombre. La lista de pokémon disponibles para edición es la siguiente:</p>
</div>

<div id="poke-team">
	<?php $this->widget('bootstrap.widgets.TbListView',array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
	)); 
	?>
</div>

<p class="click"><?php echo CHtml::link('Volver al menú principal', array('/torneo/menuUsuario')) ?></p>