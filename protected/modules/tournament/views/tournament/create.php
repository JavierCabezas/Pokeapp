<?php $this->setPageTitle('Pokéapp - Registro jugador para torneo'); ?>

<?php
$this->breadcrumbs=array(
	'Torneo'=>array('/torneo'),
	'Creación de nuevo jugador',
);
?>

<h1 class="registro"> Registro de nuevo jugador </h1>

<div class="infosec">
	<p>Para registrarte tienes que ingresar tu dirección de correo electrónico y, con el fin de comprobar que tienes tu entrada del <?php echo $next_event ?>, 
	subir una foto de la misma en donde <b>se vea claramente el folio. </b> </p>

	<p>	Una vez que alguno de nuestros administradores autorize la creación de tu perfil (es decir, comprobar la foto con el la entrada y su folio) se te enviará
	a tu correo tanto la contraseña para el poder ingresar al sitio y las instrucciones para continuar con el proceso de inscripción.</p>

	<p> Si ya hiciste este trámite y se te olvidó tu contraseña puedes hacer eso en el <?php echo CHtml::link('siguiente link', array('/torneo/resetearClave')) ?>.</p>

	<div class='clear'> </div>

	<h3 style="text-align:center"> Formulario de registro </h3>

	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>

