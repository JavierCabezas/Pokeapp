<?php
	$this->pageTitle=Yii::app()->name . ' - Modifiación de perfil de jugador';
	$this->breadcrumbs=array(
		'Jugadores'=>array('jugadores/index'),
		'Modificación de perfil',
	);
?>

<h1>Actualizando mis datos</h1>

<?php echo $this->renderPartial('_form', array(
		'model'  =>$model,
		'create' => false,
	)); 
?>
