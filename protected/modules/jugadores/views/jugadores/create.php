<?php
	$this->pageTitle=Yii::app()->name . ' - Creación de perfil de jugador';
	$this->breadcrumbs=array(
		'Jugadores'=>array('jugadores/index'),
		'Creación de perfil',
	);
?>

<h1 class="crearpj">Crear perfil de usuario</h1>

<div class="infosec">
	<p>La idea de esta aplicación es el poder encontrar gente ya sea para hacer duelos, hacer huevos de Pokémon shiny o buscar amigos de safari.
	Por mucho que sea obvio de decir, dado el propósito de la aplicación, al publicar información en el siguiente formulario estás de acuerdo con que esta sea <b>totalmente pública</b>.</p>
	<p>La excepción de esto es el correo electrónico. La razón por la cual la dirección de correo electrónico es obligatoria es que esta es necesaria para asociarla a tu cuenta, así pudiendo editar tu perfil en el futuro. Este dato se mantendrá como privado.</p>
	<p>Además, la publicación de tus datos en el sitio no será automática dado que tiene que ser aprobada por un administrador posterior a su subida.</p>
</div>

<?php echo $this->renderPartial('_form', array(
		'model'   =>$model,
        'create'  => true,
	)); 
?>