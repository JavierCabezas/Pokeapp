<?php

class BuscadorController extends Controller
{
	public function actionIndex()
	{
		$array_generations 	= array('1' => 'Primera', '2' => 'Segunda', '3' => 'Tercera', '4' => 'Cuarta', '5' => 'Quinta', '6' => 'Sexta');
		$array_colors 		= CHtml::listData(PokemonColor::model()->findAll(), 'id', 'colorName');
		$array_egg_groups 	= CHtml::listData(EggGroups::model()->findAll(), 'id', 'eggGroupName');
		$array_shapes 		= CHtml::listData(PokemonShapes::model()->findAll(), 'id', 'shapeName');

		$this->render('index', array(
			'array_generations' => $array_generations,
			'array_colors'		=> $array_colors,
			'array_egg_groups' 	=> $array_egg_groups,
			'array_shapes'		=> $array_shapes,
		));
	}
}