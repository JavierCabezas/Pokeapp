<?php $this->setPageTitle('Pokéapp - Subir foto de folio'); ?>

<?php
$this->breadcrumbs=array(
	'Torneo'=>array('/torneo'),
	'Subiendo foto de folio'
);
?>

<div class='well'>
	<h1> Foto de entrada </h1>

	<p> 
		Al igual que en eventos anteriores, con el fin de poder comprobar que tienes la entrada del evento, necesitamos que subas una foto
		que compruebe la compra de tu entrada para el <?php echo Tournament::model()->getNextTournament()->name ?>. En caso de que se trate 
		de una foto de Santiago esta tiene que tener su <b> número de folio visible</b>.
	</p>

	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'tournament-player-form', 
		'htmlOptions' => array('enctype' => 'multipart/form-data'),
		'enableAjaxValidation'=>false,
	)); ?>

	<p class="help-block">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

		<label class="required" for="photo_folio_upload"> Foto de tu entrada (con folio visible) <span class="required">*</span> </label>
		<?php echo $form->fileField($model,'photo_folio_upload'); ?>
		<?php echo $form->error($model,'photo_folio_upload'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'submit',
				'type'=>'primary',
				'label'=> 'Subir foto',
			)); ?>
	</div>

	<?php $this->endWidget(); ?>
</div>