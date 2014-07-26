<?php $this->setPageTitle('Pokéapp - Inscripción de pokémon para torneos'); ?>

<h1> Inscripción de equipos </h1>

<p> 
	En esta sección puedes inscribir tus equipos para los distintos torneos que organizados por la comunidad. 
</p>

<p>
	<ul>
		<li> Si tienes una cuenta puedes organizar tu equipo <?php echo CHtml::link('en el siguiente link', array('/torneo/miEquipo')) ?>. </li>
		<li> Si es que no estás registrado puedes hacerlo <?php echo CHtml::link('en la sección de registro', array('todo')) ?>. </li>
		<li> Si es que tienes una cuenta pero no recuerdas tu código (contraseña) puedes resetearlo <?php echo CHtml::link('en el siguiente link', array('todo')) ?>. </li>
	</ul>
</p>