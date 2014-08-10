<?php $this->setPageTitle('Pokéapp - Registro jugador para torneo'); ?>

<?php
$this->breadcrumbs=array(
	'Torneo'=>array('/torneo'),
	'Reseteo de contraseña',
);
?>

<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>

<h1> Cambio de contraseña </h1>

<p>
	Puedes usar el siguiente formulario en caso de que prefieras tener una contraseña creada por ti en vez de la generada automáticamente por el sistema.
</p>

<p>
	Te pedimos tu contraseña anterior para evitar que, en caso de que dejes tu sesión abierta en algún equipo, alguna persona te cambie la contraseña de forma malintencionada. Si no la recuerdas puedes resetearla en <?php echo CHtml::link('el siguiente link', array('/Usuarios/resetearCodigo')) ?>.
</p>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->passwordFieldRow($model,'oldpassword',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->passwordFieldRow($model,'password',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->passwordFieldRow($model,'repeatpassword',array('class'=>'span5','maxlength'=>100)); ?>
	
<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Resetear contraseña',
		)); ?>
</div>

<?php $this->endWidget(); ?>

