<?php $this->setPageTitle('Pokéapp - Inscripción de pokémon para torneos'); ?>

<h1 class="torneos"> Inscripción de equipos </h1>

<div class="infosec">
	<p> 
		En esta sección puedes inscribir tus equipos para los distintos torneos que serán organizados por la comunidad PokéDaisuki. 
	</p>

	<div class="tournament_menu">
		<?php echo CHtml::link("<img src='".imageDir()."/torneos_info/torneo_001.png' />", array('/torneo/registro')) ?>
		<div class="info">
			<?php echo CHtml::link('<h4>Inscríbete</h4>', array('/torneo/registro'))?>
			<p>Haz tu cuenta en PokéApp.</p>
		</div>
	</div>

	<div class="tournament_menu">
		<?php echo CHtml::link("<img src='".imageDir()."/torneos_info/torneo_002.png' />", array('/torneo/miEquipo')) ?>
		<div class="info">
			<?php echo CHtml::link('<h4>Registra tu equipo</h4>', array('/torneo/miEquipo'))?>
			<p>Inscribe y organiza a tu equipo Pokémon.</p>
		</div>
	</div>

	<div class="tournament_menu">
		<?php echo CHtml::link("<img src='".imageDir()."/torneos_info/torneo_003.png' />", array('/torneo/registro')) ?>
		<div class="info">
			<?php echo CHtml::link('<h4>Recupera tu código</h4>', array('/torneo/registro'))?>
			<p>Reinicia tu código personal en caso de pérdida.</p>
		</div>
	</div>

	<!--<p>
		<ul>
			<li> Si tienes una cuenta puedes organizar tu equipo <?php echo CHtml::link('en el siguiente link', array('/torneo/miEquipo')) ?>. </li>
			<li> Si es que no estás registrado puedes hacerlo <?php echo CHtml::link('en la sección de registro', array('/torneo/registro')) ?>. </li>
			<li> Si es que tienes una cuenta pero no recuerdas tu código (contraseña) puedes resetearlo <?php echo CHtml::link('en el siguiente link', array('/torneo/registro')) ?>. </li>
		</ul>
	</p>-->
</div>