<?php

class StatsController extends Controller
{
	public function actionIndex()
	{
		$array_pokeymans = CHtml::listData(PokemonSpecies::model()->findAll(), 'id', 'pokemonName');
		$criteria = new CDbCriteria;
		$criteria->condition = "category_id in('13', '14')";
		$array_items 	 = CHtml::listData(Items::model()->findAll($criteria), 'id', 'itemName');
		
		$this->render('index', array(
			'array_pokeymans' 	=> $array_pokeymans,
			'array_items'		=> $array_items,
		));
	}

	/**
	 *	This function calculates de stats of the pokémon and sends the info to the showResults partial.
	 */
	public function actionCalculateStats()
	{
		$this->renderPartial('_showResults', array(
        	'n'	     	=> 1,
        	'pokemon'	=> 'TODO',
        ));

		$this->renderPartial('_showResults', array(
        	'n'	     	=> 2,
        	'pokemon'	=> 'TODO',
        ));
	}
}