<?php $this->setPageTitle('Pokéapp - Autorizar jugador'); ?>

<?php
$this->breadcrumbs=array(
	'Torneo'=>array('/torneo'),
	'Menú administradores' => array('/torneo/adminMenu'),
	'Autorizar jugadores' => array('/torneo/vistaAutorizar'),
	'Autorizando a '.$player->nombre
);
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

	<?php echo $form->textFieldRow($model,'folio',array('class'=>'span5','maxlength'=>100)); ?>

	<label class="required" for="folio"> Foto de tu entrada (con folio visible) <span class="required">*</span> </label>
	<?php echo $form->fileField($model,'folio'); ?>
	<?php echo $form->error($model,'folio'); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear usuario' : 'Guardar',
		)); ?>
</div>

<?php $this->endWidget(); ?>
