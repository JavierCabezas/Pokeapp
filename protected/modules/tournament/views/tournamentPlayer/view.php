<?php $this->setPageTitle('Pokéapp - Registro jugador para torneo'); ?>

<?php
$this->breadcrumbs=array(
	'Torneo'=>array('/torneo'),
	'Confirmación de creación de perfil',
);
?>

<h1> Se agregó correctamente tu información  </h1>

<p> Se te envió un correo a la casilla que registraste (<?php echo $mail?>) con la información para continuar tu registro y con tu contraseña. 
	Si es que no te llega el correo por favor revisa bien tu carpeta de spam. Si aún así tienes problemas con el contáctanos a <?php echo Yii::app()->params['adminEmail'] ?> para 
	ver la situación.
</p>