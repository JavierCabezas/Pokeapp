<?php
	$this->pageTitle=Yii::app()->name . ' - Modificación de perfil';
	$this->breadcrumbs=array(
		'Jugadores', 'Formulario de modificación de perfil',
	);
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'player-form', 'action' => 'update', 'method' => 'GET',
	'enableAjaxValidation'=>false,
)); ?>


<h1 class="modpj">Modificar perfil</h1>

<div class="infosec">
	<p>Para modificar tu perfil primero debes llenar este formulario con tu correo electrónico y tu código. El código fue enviado a tu dirección de correo electrónico cuando creaste tu perfil.
	En caso de que requieras uno nuevo puedes hacerlo en el <?php echo CHtml::link('siguiente link', array('jugadores/nuevoCodigo')) ?>.</p>
</div>

<label class="required" for="mail"> Correo electrónico <span class="required">*</span> </label>
<input id="mail" class="span5" type="text" name="mail" placeholder="Correo electrónico" maxlength="100">

<label class="required" for="code"> Código <span class="required">*</span> </label>
<input id="code" class="span5" type="text" name="code" placeholder="Tu código..." maxlength="32">

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'submit',
				'type'=>'primary',
				'label'=>'Ir a modificación de perfil',
			)); ?>
	</div>

<?php $this->endWidget(); ?>