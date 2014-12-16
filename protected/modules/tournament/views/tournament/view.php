<!-- Loads the view for a newly created player -->

<?php $this->setPageTitle('Pokéapp - Registro jugador para torneo'); ?>

<?php
$this->breadcrumbs=array(
	'Torneo'=>array('/torneo'),
	'Confirmación de creación de perfil',
);
?>

<div class="well">
    <h1> Se agregó correctamente tu información  </h1>

    <p>
        Se te envió un correo a la dirección de correo que registraste que registraste (<?php echo $mail?>) con instrucciones para continuar tu registro y con tu contraseña.
        Si es que no te llega el correo por favor revisa bien tu carpeta de spam. Si aún así tienes problemas con el contáctanos a <?php echo Yii::app()->params['adminEmail'] ?> para
        ver la situación.
    </p>

    <p>
        Una vez recibido el correo puedes logearte a tu cuenta ingresando <?php echo CHtml::link('en la sección de login', array('/login')) ?>.
    </p>
</div>