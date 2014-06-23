<?php
	$this->pageTitle=Yii::app()->name . ' - Obtención de nuevo código';
	$this->breadcrumbs=array(
		'Jugadores'=>array('jugadores/index'),
		'Obtención de nuevo código',
	);
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'player-form', 'action' => 'newCode',
	'enableAjaxValidation'=>false,
)); ?>

	<?php
	    foreach(Yii::app()->user->getFlashes() as $key => $message) {
	        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
	    }
	?>

	<h1 class="codmod">Código para modificar perfil</h1>

	<div class="infosec">
		<p>Si no tienes el código que te enviamos para modificar tu perfil puedes generar uno nuevo ingresando tu dirección de correo electrónico aquí.</p>
	</div>
	<label class="required" for="mail"> Correo electrónico <span class="required">*</span> </label>
	<input id="mail" class="span5" type="text" name="mail" placeholder="Ingresa tu correo electrónico..." maxlength="100">
	<div class="help-block error"> </div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'submit',
				'type'=>'primary',
				'label'=>'Enviar código al correo',
			)); ?>
	</div>

<?php $this->endWidget(); ?>

<script type = 'text/javascript'>
	/*$(document).ready(function () {	
		$.ajax({
		    'type': 'POST',
		    'url': "<?php echo Yii::app()->createUrl(' ') ?>",
		    'dataType': 'html',
		    'data:' {
		        mail: $('#Player_id_safari_type').val();
		    },
		    'success': function (data) {
		       $('#safari_1').html('<p> Pokémon del slot #1 </p>' + data);
		    }
		});	
	});*/
</script>