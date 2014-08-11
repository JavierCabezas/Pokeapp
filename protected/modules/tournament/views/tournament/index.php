<?php $this->setPageTitle('Pokéapp - Inscripción de Pokémon para torneos'); ?>

<h1 class="torneos"> Inscripción de equipos </h1>

<div class="infosec">
	<p> 
		En esta sección puedes inscribir tus equipos para los distintos torneos que serán organizados por la comunidad PokéDaisuki. 
	</p>

	<div class="tournament_menu">
		<?php echo CHtml::link("<img src='".imageDir()."/torneos_info/torneo_001.png' />", array('/torneo/registro')) ?>
		<div class="info">
			<?php echo CHtml::link('<h4>Inscríbete</h4>', array('/torneo/registro'))?>
			<p> Crea tu cuenta en la pokéapp. </p>
		</div>
	</div>

	<div class="tournament_menu">
		<?php echo CHtml::link("<img src='".imageDir()."/torneos_info/torneo_002.png' />", array('/torneo/menuUsuario'	)) ?>
		<div class="info">
			<?php echo CHtml::link('<h4>Ingresa a tu cuenta</h4>', array('/torneo/menuUsuario'))?>
			<p>Si ya estás inscrito puedes ingresar a tu perfil de usuario en este link.</p>
		</div>
	</div>


	<div class="tournament_menu">
		<?php echo CHtml::link("<img src='".imageDir()."/torneos_info/torneo_003.png' />", array('/torneo/resetearClave')) ?>
		<div class="info">
			<?php echo CHtml::link('<h4>Reinicia tu contraseña</h4>', array('/torneo/resetearClave'))?>
			<p>Reinicia tu contraseña personal en caso de pérdida.</p>
		</div>
	</div>
</div>