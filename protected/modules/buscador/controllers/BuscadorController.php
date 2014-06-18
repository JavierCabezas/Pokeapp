<?php

class BuscadorController extends Controller
{
	public function actionIndex()
	{
		$type_criteria = new CDbCriteria;
        $type_criteria->addCondition("id != 10001"); //Exclude unkown type
        $type_criteria->addCondition("id != 10002"); //Exlude shadow type

		$array_generations 	= array('1' => 'Primera', '2' => 'Segunda', '3' => 'Tercera', '4' => 'Cuarta', '5' => 'Quinta', '6' => 'Sexta');
		$array_colors 		= CHtml::listData(PokemonColor::model()->findAll(), 'id', 'colorName');
		$array_egg_groups 	= CHtml::listData(EggGroups::model()->findAll(), 'id', 'eggGroupName');
		$array_shapes 		= CHtml::listData(PokemonShapes::model()->findAll(), 'id', 'shapeName');
		$array_types        = CHtml::listData(Types::model()->findAll($type_criteria), 'id', 'typeName');

		$this->render('index', array(
			'array_generations' => $array_generations,
			'array_colors'		=> $array_colors,
			'array_egg_groups' 	=> $array_egg_groups,
			'array_shapes'		=> $array_shapes,
			'array_types'		=> $array_types,
		));
	}
}