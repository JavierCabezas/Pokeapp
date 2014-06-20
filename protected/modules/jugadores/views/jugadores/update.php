<h1>Actualizar mis datos</h1>

<?php echo $this->renderPartial('_form', array(
		'model'=>$model,
		'array_types'       => $array_types,
        'array_auth_mail'   => $array_auth_mail,
        'array_tiers'       => $array_tiers,
	)); 
?>
