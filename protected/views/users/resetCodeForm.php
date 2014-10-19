<?php $this->setPageTitle('Pokéapp - Reseteo de contraseña'); ?>

<?php
$this->breadcrumbs=array(
	$module => $url,
	'Reseteo de contraseña',
);
?>

<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>
<div class='well'>
	<h1> Reseteo de contraseña </h1>

	<p>
		Para poder recibir una nueva contraseña ingresa tu correo electrónico en el formulario de  más abajo y, en caso de que esté registrado en
		nuestra base de datos, se te enviará un correo con las instrucciones para realizar el proceso.
	</p>


	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'user-form',
		'enableAjaxValidation'=>false,
	)); ?>

		<?php echo $form->textFieldRow($model,'mail',array('class'=>'span5','maxlength'=>100)); ?>
		
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'submit',
				'type'=>'primary',
				'label'=>'Enviar correo',
			)); ?>
	</div>

	<?php $this->endWidget(); ?>
</div>