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
	Para usar la aplicación puedes:
	<ul>
		<li> Creación de perfil: <?php echo CHtml::link('Crear nuevo', array('jugadores/create')) ?> </li>
		<li> Búsqueda de jugadores: en <?php echo CHtml::link('Buscar jugadores', array('jugadores/buscador')) ?> </li>
		<li> Obtención de código de modificación de perfil: <?php echo CHtml::link('Obtener nuevo código', array('jugadores/nuevoCodigo')) ?> </li> 
		<li> Modificar mi perfil: <?php echo CHtml::link('Modificar', array('jugadores/updateForm')) ?> </li>
	</ul>
</p>