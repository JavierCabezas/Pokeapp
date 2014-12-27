<?php $this->setPageTitle('Pokéapp - Ver equipo del jugador'); ?>

<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>

<?php
$this->breadcrumbs=array(
	'Torneo'=>array('/torneo'),
	'Menú administradores'=>array('/torneo/adminMenu'),
	'Ver equipo de jugador',
);
?>

<h1> Ver equipo de jugador </h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'tournament-player-pokemon-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="form-group">
		<label class="required" for="id_folio"> Número de folio del jugador a revisar </label>
		<?php

		  $this->widget(
	                    'bootstrap.widgets.TbSelect2',
	                    array(
	                        'name' => 'id_folio',
	                        'data' => TournamentPlayerFolio::model()->getAllFolio($id_tournament),
	                        'htmlOptions' => array(
	                            'placeholder' => 'Selecciona un jugador',
	                            'id'          => 'id_folio',
	                            'class'       => 'span5 form-control'
	                        ),
	                    )
	                );

		?>
	</div>

	<?php //echo CHtml::dropDownList('id_folio', '' , TournamentPlayerFolio::model()->getAllFolio($id_tournament), array('class' => 'span5')); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=> 'Ver equipo del jugador',
		)); ?>
</div>

<?php $this->endWidget(); ?>


<?php if(!is_null($team)): // Displays the team in case it isn't null ?>
	<h1> Equipo de <?php echo $player->name ?>  </h1> (<?php echo $player->mail ?>)
	<?php foreach($team as $poke): ?>
		<?php 
			$this->renderPartial('_viewDetail', array(
				'model' => $poke->idTournamentPokemon
			));
		?>
	<?php endforeach; ?>
<?php endif; ?>