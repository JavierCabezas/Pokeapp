<?php $this->setPageTitle('Pokéapp - Autorizar jugador'); ?>

<?php
$this->breadcrumbs=array(
	'Torneo'=>array('/torneo'),
	'Menú administradores' => array('/torneo/adminMenu'),
	'Autorizar jugadores' => array('/torneo/vistaAutorizar'),
	'Autorizando a '.$player->nombre
);
?>

<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>

<h1> Autorizando a <?php echo $player->nombre ?> </h1>

<p> Foto subida por el usuario: </p>
<?php echo CHtml::image(imageDir().'/foto_folio/'.$picture) ?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'tournament-player-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Campos con <span class="required">*</span> son obligatorios.</p>

<?php echo $form->errorSummary($model); ?>

	<input type="hidden" name="player" value="<?php echo $player->id?>">
	<input type="hidden" name="tournament" value="<?php echo $tournament->id ?>">

	<label class="required" for="folio"> Folio del jugador <span class="required">*</span> </label>
	<?php echo CHtml::dropDownList('folio',$model, $array_folio) ?>
	
	<label class="required" for="next_page"> Después de autorizar/banear al jugador ir a...</label>
	<?php echo CHtml::dropDownList('next_page', '', array('adminMenu' => 'Menú de administradores', 'authorize' => 'Autorizar a otro jugador')) ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear usuario' : 'Guardar',
		)); ?>
</div>

<?php $this->endWidget(); ?>
