<div class="main">
	<div id="maincontent2">
		<?php
		/* @var $this SiteController */
		/* @var $model LoginForm */
		/* @var $form CActiveForm  */
		?>

		<?php
		    foreach(Yii::app()->user->getFlashes() as $key => $message) {
		        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
		    }
		?>

		<h1 class="login">Iniciar sesión</h1>

		<div class="infosec">
			<p> En caso de que hayas olvidado tu código (contraseña) de login puedes pedir otro <?php echo CHtml::link('en el siguiente link', array('/usuario/resetearCodigo')) ?>
			<div class="login-form">
				<div class="form">
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'login-form',
					'enableClientValidation'=>true,
					'clientOptions'=>array(
						'validateOnSubmit'=>true,
					),
				)); ?>

					<p class="note">Campos con <span class="required">*</span> son requeridos.</p>
					<div class="row">
						<?php echo $form->labelEx($model,'username'); ?>
						<?php echo $form->textField($model,'username'); ?>
						<?php echo $form->error($model,'username'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'password'); ?>
						<?php echo $form->passwordField($model,'password'); ?>
						<?php echo $form->error($model,'password'); ?>
					</div>
					<div class="row rememberMe">
						<?php echo $form->checkBox($model,'rememberMe'); ?>
						<?php echo $form->label($model,'rememberMe'); ?>
						<?php echo $form->error($model,'rememberMe'); ?>
					</div>
					<div class="row buttons">
						<?php echo CHtml::submitButton('Login'); ?>
					</div>

					<?php $this->endWidget(); ?>
				</div><!-- form -->
			</div>
		</div>
	</div>
</div>