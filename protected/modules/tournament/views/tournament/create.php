<?php $this->setPageTitle('Pokéapp - Registro jugador para torneo'); ?>

<?php
$this->breadcrumbs=array(
	'Torneo'=>array('/torneo'),
	'Creación de nuevo jugador',
);
?>

<h1 class="registro"> Registro de nuevo jugador </h1>

<div class="infosec">

    <p>Para registrarte de manera online para ingresar tu team en el ORAS Open Tournament tienes que ingresar tu dirección de correo electrónico y,
        con el fin de comprobar que tienes tu entrada del <?php echo $next_event ?>, subir una foto de la misma.
        En el caso de ser una entrada comprada en Santiago debe de verse claramente el folio. En el caso de ser un eTicket, subir el archivo del documento contenedor de tu QR específico.
    </p>

    <p>
        Si ya participaste en algún evento anterior <b>no debes de inscribirte nuevamente</b>. Puedes ingresar a tu perfil desde <?php echo CHtml::link('la sección de login', array('/login')) ?>. Si estás registrado pero olvidaste tu contraseña puedes resetearla desde el <?php echo CHtml::link('siguiente link', array('/torneo/resetearClave')) ?>.
    </p>

    <p>
        Puedes revisar el set oficial de reglas para el ORAS Open Tournament 2015 haciendo click <?php echo CHtml::link('aquí', 'http://pokemonday.cl/wp/reglamento-oficial-del-oras-open-tournament-2015-2/') ?>.
    </p>

	<div class='clear'> </div>

	<h3 style="text-align:center"> Formulario de registro </h3>

	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>

