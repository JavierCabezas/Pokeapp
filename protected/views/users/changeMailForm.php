<?php $this->setPageTitle('Pokéapp - Cambio de dirección de correo'); ?>

<?php
$this->breadcrumbs=array(
	'Cambio de correo electrónico',
);
?>

<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>

<h1> Cambio de mi correo electrónico por defecto </h1>

<p> 
	Con el fin de asegurar de que el correo electrónico que ingreses es válido se te enviará un correo a la casilla que nos indiques.
	Este e correo contendrá un link para hacer efectivo el cambio. 
</p>


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->TextFieldRow($model,'mail_change',array('class'=>'span5','maxlength'=>100)); ?>
	
<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Cambiar correo',
		)); ?>
</div>

<?php $this->endWidget(); ?>


