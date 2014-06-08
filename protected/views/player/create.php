<h1> Añadirse jugador </h1>

<p> 
	Al ingresar la información en este formulario acepto que, tras ser aceptada, (como es esperable) sea publicada para que otros jugadores puedan buscarla. 
	Esta será TOTALMENTE pública. En caso de querer borrarse o actualizar su información de la base de datos pueden de contactarnos con alguna prueba de que son ustedes los borraremos.
</p>

<p>
	Se pueden ver los jugadores registrados en la base de datos <?php echo CHtml::link('en el siguiente link', 'AGREGAR LINK ACÁ') ?>.
</p>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>