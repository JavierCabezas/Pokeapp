<h2> Módulo de búsqueda de jugadores </h2>

<p> 
	En este módulo de la pokéapp pueden buscar a otros jugadores del juego con intereses similares, buscar algún jugador con un pokémon en específico del
	Friend Safari (Safari amigo) o simplemente conocer gente nueva. 
</p>

<p> 
	Los parámetros actuales que se están guardando en el módulo hasta la fecha son: 
	<ul>
		<li> Pokémons del safari.</li>
		<li> TSV. </li>
		<li> Interés en duelos (separados por tipo de duelo y tier). </li>
	</ul>
</p>

<p>
	Para usar la aplicación pueden:
	<ul>
		<li> Crear su perfil en <?php echo CHtml::link('la sección de creación de perfil', array('jugadores/create')) ?> </li>
		<li> Buscar a otros jugadores en <?php echo CHtml::link('la sección de búsqueda', array('jugadores/buscador')) ?> </li>
	</ul>
</p>