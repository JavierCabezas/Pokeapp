<h1>Guardado del perfil #<?php echo $model->id; ?> exitoso </h1>
<div class="infosec">
	<p> Puedes modificar esta información con el código que se envió a tu correo (<?php echo $model->mail?>). </p> 
	<p> Se mostrará en el buscador una vez que este sea autorizado. Los datos que se guardaron son: </p>

		<?php $this->widget('bootstrap.widgets.TbDetailView',array(
			'data'=>$model,
			'attributes'=>array(
					'nickname',
			        array(
			            'name' 	=> 'name',
			            'value' => ($model->name != '')?$model->name:"(No asignado)"
			        ),
			        array(
			        	'name' 	=> 'friend_code',
			            'value' => addZeros($model->friendcode_1, 4) . " - " . addZeros($model->friendcode_2, 4) . " - " . addZeros($model->friendcode_3, 4)
			        ),
			        array(
			        	'name' 	=> 'id_safari_type', 
			        	'value'	=> isset($model->id_safari_type)?$model->idSafariType->typeName . '(' . beautify($model->safariSlot1->identifier). ', ' .  beautify($model->safariSlot2->identifier) .' y ' . beautify($model->safariSlot3->identifier) . ')' :'(No asignado)',
			        ),
			        array(
			        	'name' 	=> 'tsv',
			        	'value' => isset($model->tsv)?$model->tsv:'No ingresado',
			        ),
			        array(
			        	'name' 	=> 'duel_single', 
			        	'value'	=> ($model->duel_single == '1')?'Sí'.(isset($model->tier_single)?', '.$model->tierSingle->tierName:''):'No',
			        ),
			        array(
			        	'name' 	=> 'duel_doble', 
			        	'value'	=> ($model->duel_doble == '1')?'Sí'.(isset($model->tier_doble)?', '.$model->tierDoble->tierName:''):'No',
			        ),
			        array(
			        	'name' 	=> 'duel_triple', 
			        	'value'	=> ($model->duel_triple == '1')?'Sí'.(isset($model->tier_triple)?', '.$model->tierTriple->tierName:''):'No',
			        ),
			        array(
			        	'name' 	=> 'duel_rotation', 
			        	'value'	=> ($model->duel_rotation == '1')?'Sí'.(isset($model->tier_rotation)?', '.$model->tierRotation->tierName:''):'No',
			        ),
			        array(
			        	'name' 	=> 'skype',
			        	'value' => ($model->skype != '')?$model->skype:'No ingresado',
			        ),
			        array(
			        	'name' 	=> 'whatsapp',
			        	'value' => ($model->whatsapp != '')?$model->whatsapp:'No ingresado',
			        ),
			        array(
			        	'name' 	=> 'facebook',
			        	'value' => ($model->facebook != '')?$model->facebook:'No ingresado',
			        ),
					array(
						'name' 	=> 'mail',
						'value' => $model->mail . "(Privado, no se mostrará)",
					),
				    array(
			        	'name' 	=> 'others',
			        	'value' => ($model->others != '')?$model->others:'No ingresado',
			        ),
				    array(
			        	'name' 	=> 'comment',
			        	'value' => ($model->comment != '')?$model->comment:'No ingresado',
			        ),
					array( //TODO: Limit the image size in the preview.
						'name'	=> 'pic',
						'type' 	=> 'html',
						'value' => isset($model->pic)?CHtml::image( imageDir() . '/foto_jugadores/' . $model->id. '.' . $model->pic):'Sin avatar',
					),
				)
			)
		); 
	?>
</div>