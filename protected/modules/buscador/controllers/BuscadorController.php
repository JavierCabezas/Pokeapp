<?php

class BuscadorController extends Controller
{
	public function actionIndex()
	{
		$type_criteria = new CDbCriteria;
        $type_criteria->addCondition("id != 10001"); //Exclude unkown type
        $type_criteria->addCondition("id != 10002"); //Exlude shadow type

		$array_generations 	= array('1' => 'Primera', '2' => 'Segunda', '3' => 'Tercera', '4' => 'Cuarta', '5' => 'Quinta', '6' => 'Sexta');
		$array_colors 		= array('1' => 'Black (negro)', '2' => 'Blue (azul)', '3' => 'Brown (café)', '4' => 'Gray (griz)', '5' => 'Green (verde)', '6' => 'Pink (rosa)', '7' => 'Purple (morado)', '8' => 'Red (rojo)', '9' => 'White (blanco)', '10' => 'Yellow (amarillo)');
		$array_egg_groups 	= CHtml::listData(EggGroups::model()->findAll(), 'id', 'eggGroupName');
		$array_shapes 		= CHtml::listData(PokemonShapes::model()->findAll(), 'id', 'shapeName');
		$array_types        = CHtml::listData(Types::model()->findAll($type_criteria), 'id', 'typeName');
		$array_ability      = CHtml::listData(Abilities::model()->findAll(), 'id', 'abilityName');
		$array_moves		= CHtml::listData(Moves::model()->findAll(), 'id', 'moveName');
		
		$this->render('index', array(
			'array_generations' => $array_generations,
			'array_colors'		=> $array_colors,
			'array_egg_groups' 	=> $array_egg_groups,
			'array_shapes'		=> $array_shapes,
			'array_types'		=> $array_types,
			'array_ability'		=> $array_ability,
			'array_moves'		=> $array_moves,
		));
	}

	/**
	 *	Get the ajax function call from the button on the index and echoes the results of the seach
	 */
	public function actionSearchPokemon()
	{

		$criteria = new CDbCriteria;
		$params = array();
        $criteria->with = array(
            'pokemonTypes',
        	'species',
        );
		$criteria->together = true;
		
		if(isset($_POST['min_height'], $_POST['max_height'], $_POST['min_height'], $_POST['max_weight'], $_POST['gen_1'], $_POST['gen_2'], $_POST['gen_3'],
				 $_POST['gen_4'], $_POST['gen_5'], $_POST['gen_6'], $_POST['type_1'], $_POST['type_2'], $_POST['color'], $_POST['eggie'])){ 
			//HEIGHT
			if($_POST['min_height'] != -1 ){
                $criteria->addCondition('height >= :min_height');
                $params['min_height'] =  intval($_POST['min_height']);
			}
            if($_POST['max_height'] != -1 ){
                $criteria->addCondition('height <= :max_height');
            	$params['max_height'] =  intval($_POST['max_height']);
            }
			//END OF HEIGHT


            //WEIGHT
            if($_POST['min_weight'] != -1 ){
                $criteria->addCondition('weight > :min_weight');
            	$params['min_weight'] =  intval($_POST['min_weight']);
            }
            if($_POST['max_weight'] != -1 ){
                $criteria->addCondition('weight < :max_weight');
                $params['max_weight'] =  intval($_POST['max_weight']);
            }
			//END OF WEIGHT
            $criteria->addCondition('species.color_id = :color');

            //TYPES
            

            //SELECT A.pokemon_id FROM (SELECT pokemon_id FROM `pokemon_types` WHERE type_id=18) as A, (SELECT pokemon_id FROM `pokemon_types` WHERE type_id=14) as B WHERE A.pokemon_id = B.pokemon_id
            /*
            if( ($_POST['type_1'] != -1) && ($_POST['type_2']) ) {
				$criteria->addCondition('pokemonTypes.type_id = :type_1 and slot=1 or :type_2 ');
            	$params['type_1'] = intval($_POST['type_1']);
            	$params['type_2'] = intval($_POST['type_2']);
            }
            if( ($_POST['type_1'] != -1) && ($_POST['type_2'] == -1) ){
				$criteria->addCondition('pokemonTypes.type_id = :type_1');
            	$params['type_1'] = intval($_POST['type_1']);
            }
            if( ($_POST['type_1'] == -1) && ($_POST['type_2'] != -1) ){
				$criteria->addCondition('pokemonTypes.type_id = :type_2');
            	$params['type_2'] = intval($_POST['type_2']);
            }
            */
			//END OF TYPES
            

			//COLOR
			if($_POST['color'] != -1){
                $criteria->addCondition('species.color_id = :color');
            	$params['color'] =  intval($_POST['color']);
			}
			//END OF COLOR  (that sounds sooo emo)

			//EGG
			if($_POST['eggie'] != -1){
				echo $_POST['eggie'];
			}
			//END OF EGG

		}
		else{
			echo "FAIL";
		}
		
		$criteria->params = $params; //Im calling the params here, before the generations, because of a Yii bug.

        //GENERATIONS
		$gen = array('1' => filter_var($_POST['gen_1'], FILTER_VALIDATE_BOOLEAN), '2' => filter_var($_POST['gen_2'], FILTER_VALIDATE_BOOLEAN), 
					 '3' => filter_var($_POST['gen_3'], FILTER_VALIDATE_BOOLEAN), '4' => filter_var($_POST['gen_4'], FILTER_VALIDATE_BOOLEAN),
					 '5' => filter_var($_POST['gen_5'], FILTER_VALIDATE_BOOLEAN), '6' => filter_var($_POST['gen_6'], FILTER_VALIDATE_BOOLEAN));
		if($gen[1]||$gen[2]||$gen[3]||$gen[4]||$gen[5]||$gen[6]){ // Just use the filter is the user actually clicked a generation.
			$n = 1;
			$gens_to_search = array();
			foreach($gen as $g){
				if($g){
					array_push($gens_to_search, $n);
				}
				$n = $n+1;
			}
			$criteria->addInCondition('species.generation_id', $gens_to_search);
		}
		//END OF GENERATIONS

        $gridColumns = array(
            array(
                'name' => 'id_pokemon',
                'header' => 'Pokémon',
                'value' => '$data->pokemonName',
            ),
            array(
              'type' => 'raw',
              'value' => 'CHtml::image(Yii::app()->baseUrl . "/images/sprites/".$data->id.".png")'
            ),
            array(
                'name'   => 'weight',
                'header' => 'Altura [m]',
                'value'  => '$data->height/10'   
            ),
            array(
                'name'   => 'height',
                'header' => 'Peso [kg]',
                'value'  => '$data->weight/10'   
            ),
        );

        $dataProvider = new CActiveDataProvider('Pokemon', array(
           'criteria' => $criteria
        ));
       
        $this->widget(
			'bootstrap.widgets.TbGridView',
			 array(
			    'type' => 'striped',
			    'dataProvider' => $dataProvider,
			    'template' => "{items}",
			    'columns' => $gridColumns,
    		)
    	);
	}
}