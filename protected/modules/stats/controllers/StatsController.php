<?php

class StatsController extends Controller
{
	public function actionIndex()
	{
		$criteria = new CDbCriteria;
		$criteria->condition = "category_id in('13', '14')";

		$array_pokeymans = CHtml::listData(Pokemon::model()->findAll(), 'id', 'pokemonName');
		$array_items 	 = CHtml::listData(Items::model()->findAll($criteria), 'id', 'itemName');
		$array_nature 	 = CHtml::listData(Nature::model()->findAll(), 'id', 'natureName');
		
		array_unshift($array_items, '(Ninguno)');

		$this->render('index', array(
			'array_pokeymans' 		=> $array_pokeymans,
			'array_items'			=> $array_items,
			'array_nature'			=> $array_nature,
		));
	}

	/**
	 *	This function calculates de stats of the pokémon and sends the info to the showResults partial.
	 * 	@param $id the identifier of the showResults partial to be updated.
	 */
	public function actionCalculateStats($id)
	{
		if($id == 1){
		$this->renderPartial('_showResults', array(
	        	'n'	     	=> 1,
	        	'pokemon'	=> 'TODO',
	        ));
		}else{
			$this->renderPartial('_showResults', array(
	        	'n'	     	=> 2,
	        	'pokemon'	=> 'TODO',
	        ));
		}
	}
}