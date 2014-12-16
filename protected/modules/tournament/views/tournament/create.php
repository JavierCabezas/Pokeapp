<?php $this->setPageTitle('Pokéapp - Registro jugador para torneo'); ?>

<?php
$this->breadcrumbs=array(
	'Torneo'=>array('/torneo'),
	'Creación de nuevo jugador',
);
?>

<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>


<h1 class="registro"> Registro de nuevo jugador </h1>

<div class="infosec">
	<p>Para registrarte tienes que ingresar tu dirección de correo electrónico y, con el fin de comprobar que tienes tu entrada del <?php echo $next_event ?>, 
	subir una foto de la misma. En el caso de ser una entrada comprada en Santiago debe de <b>verse claramente el folio. </b> </p>

	<p>
        Si ya participaste en algún evento anterior <b> no debes de inscribirte nuevamente.</b> Puedes ingresar a tu perfil desde <?php echo CHtml::link('la sección de login', array('/login')) ?>.
        Si estás registrado pero olvidaste tu contraseña puedes resetearla desde  el <?php echo CHtml::link('siguiente link', array('/torneo/resetearClave')) ?>.
    </p>

	<div class='clear'> </div>

	<h3 style="text-align:center"> Formulario de registro </h3>

	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>

