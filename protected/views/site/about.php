<h1 class="autor">Sobre el autor</h1>

<?php echo  $foto_yo ?>
<div id="autorinfo">
	<p>¡Hola! Mi nombre es Javier, desde Junio del 2013 estoy encargado de la sección <b>"Bajo el camión del S.S. Anne"</b> y soy el autor de la <b>PokéApp</b> acá en <a href="http://www.pokedaisuki.cl">PokéDaisuki</a>. 
	Si han asistido a un evento de la comunidad posiblemente me hayan visto con mi notebook en la sección del  <u class ="dotted"><span title="La aplicación antidopping fue la primera que hice para Pokédaisuki">antidopping</span></u> del torneo.
	Soy estudiante de sexto año de <u class ="dotted"><span title="Que es como una mezcla de informática con electrónica">Ingeniería Civil Telemática</span></u> en la <u class="dotted"> <span title="Universidad Técnica Federico Santa María">UTFSM</span></u> y tengo un gran interés en lo que es el área de computadores. A eso agreguémosle que me encanta en demasía Pokémon y estoy jugándolo desde la primera generación.
	Es por esto que me encanta entender a fondo, a nivel técnico, el funcionamiento de <u class="dotted"><span title="Lo cual digo para quedar bien en la comunidad no más, la verdad mi favorito es Tales of Phantasia <3. También disfruto MUCHO Batman Arkham City y toda la saga Ace Attorney.">mi videojuego favorito<span></u>.</p>
	<p>Si desean contactarme por cualquier motivo pueden escribirme un correo a <?php echo $foto_mail ?> o agregarme a Skype a mi cuenta <b>live:jcleyton</b>. Estoy súper dispuesto a recibir correcciones de cualquier tipo (ya sean de algún planteamiento matemático mal hecho, bugs, ortografía, etc.). ¡Mil gracias de antemano si me escriben por eso! Me puedo equivocar =P. Si tienen alguna consulta
	por alguno de mis artículos, tienen ganas de un duelo Pokémon o quieren decirme hola siéntase totalmente libres de escribirme.</p>
	<p>Aprovecho de dar las gracias a <a href="http://fermotousan.cl">Fernanda Kauak</a> por su ayuda con respecto a lo que es <u class="dotted"> <span title="Yo soy súper torpe en ese aspecto">diseño de la aplicación</span></u> y a los chicos de Daisuki por darme la oportunidad de hacer mis ñoñerías en la página de una comunidad tan bacán como esta. Por mucho que los tenga medios abandonados los adoro &lt; 3.  </p>
</div>

<div id="appinfo">
	<h1 class="pokeapp"> Acerca de la PokéApp </h1>
	<div class="bloq">
		<img src='<?php echo imageDir()?>/about/about_01.png' alt='PokeApp' />
		<p>Dado, que además de Pokémon, me gusta harto el asunto de programar decidí de usar mis conocimientos para hacer la cúspide de lo ñoño: Una aplicación de Pokémon. Es por esto que me propuse a hacer distintas calculadoras con el fin de facilitarles un poco la vida a los jugadores del 
		mismo. Las hice pensando en que me fuesen útiles a mí como jugador del juego así que espero que lo sean también para ustedes!</p>
	</div>
	<div class="bloq">
		<img src='<?php echo imageDir()?>/about/about_02.png' alt='GitHub' />
		<p>Para los que estén interesados en programación, decidí lanzar el código fuente de esta aplicación en un <?php echo CHtml::link('repositorio en GitHub', 'https://github.com/JavierCabezas/Pokeapp') ?> que está libre para cualquiera que lo quiera descargar, ver o editar.
		La aplicación está hecha con lenguaje de programación PHP, trabaja con una base de datos MySQL y usa el <u class ="dotted"><span title="Que es un framework MCV fabuloso, lo recomiendo totalmente.">Framework Yii</span></u>.
		También pueden ver las actualizaciones que se le vayan haciendo a la aplicación.</p>
	</div>
	<div class="bloq">
		<img src='<?php echo imageDir()?>/about/about_03.png' alt='Agradecimientos' />
		<p>Doy infinitas gracias a los chicos de <?php echo CHtml::link('veekun', 'http://www.veekun.com') ?> que, además de tener un pokédex completísimo, tienen la base de datos que yo usé para este proyecto.
		Ellos también usan un repositorio en GitHub que pueden ubicar <?php echo CHtml::link('el siguiente link', 'https://github.com/veekun/pokedex') ?>.</p>
	</div>
</div>


<div id="articulos">
	<h1 class="art_daisuki">Mis artículos en PokeDaisuki</h1>
	<div class="art">
		<img src='<?php echo imageDir()?>/articulos/001.png' />
		<div class="name">
			<a href="http://www.pokedaisuki.cl/bajo-el-camion-del-s-s-anne-n1-introduccion-a-hexadecimal-y-binario/">Introducción a hexadecimal y binario.</a>
		</div>
	</div>
	<div class="art">
		<img src='<?php echo imageDir()?>/articulos/002.png' />
		<div class="name">
			<a href="http://www.pokedaisuki.cl/bajo-el-camion-del-s-s-anne-n2-por-que-missingno-clona-el-sexto-item/">¿Por qué MissingNo clona el sexto ítem?</a>
		</div>
	</div>
	<div class="art">
		<img src='<?php echo imageDir()?>/articulos/003.png' />
		<div class="name">
			<a href="http://www.pokedaisuki.cl/bajo-el-camion-del-s-s-anne-n3-por-que-nos-encontramos-con-missingno/">¿Por qué nos encontramos con MissingNo?</a>
		</div>
	</div>
	<div class="art">
		<img src='<?php echo imageDir()?>/articulos/004.png' />		
		<div class="name">
			<a href="http://www.pokedaisuki.cl/bajo-el-camion-del-s-s-anne-n4-items-de-las-versiones-beta-de-pokemon/">Items de las versiones beta de pokémon RB.</a>
		</div>
	</div>
	<div class="art">
		<img src='<?php echo imageDir()?>/articulos/005.png' />
		<div class="name">
			<a href="http://www.pokedaisuki.cl/?p=1898"> Fórmulas de captura: Parte 1.</a>
		</div>
	</div>
	<div class="art">
		<img src='<?php echo imageDir()?>/articulos/005.png' />
		<div class="name">
			<a href="http://www.pokedaisuki.cl/bajo-el-camion-del-s-s-anne-n5-formulas-de-captura-parte-2/"> Fórmulas de captura: Parte 2. </a>
		</div>
	</div>
	<div class="art">
		<img src='<?php echo imageDir()?>/articulos/006.png' />
		<div class="name">
			<a href="http://www.pokedaisuki.cl/bajo-el-camion-del-s-s-anne-n6-intercambio-de-missingnos-a-segunda-generacion/">Intercambio de MissingNo a segunda generación.</a>
		</div>
	</div>
	<div class="art">
		<img src='<?php echo imageDir()?>/articulos/007.png' />
		<div class="name">
			<a href="http://www.pokedaisuki.cl/bajo-el-camion-del-s-s-anne-n7-curiosidades-varias/">Curiosidades varias</a>
		</div>
	</div>
	<div class="art">
		<img src='<?php echo imageDir()?>/articulos/008.png' />
		<div class="name">
			<a href="http://www.pokedaisuki.cl/bajo-el-camion-del-s-s-anne-n8-bugs-de-primera-generacion-parte-1/">Bugs de primera generación: Parte 1.</a>
		</div>
	</div>
</div>