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
	<p>La razón por la cual el correo electrónico es obligatorio es que, para cambiar tus datos, debes de ingresar con tu mail y un código que se te enviará al mismo, así demostrando que tú eres el que escribió el perfil en primera instancia.
	Este dato se mantendrá como privado.</p>
	<p>Además, la publicación de tus datos en el sitio no será automática dado que tiene que ser aprobada por un administrador posterior a su subida.</p>
</div>

<?php echo $this->renderPartial('_form', array(
		'model'   =>$model,
        'create'  => true,
	)); 
?>