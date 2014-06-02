<?php

class StatsController extends Controller
{
	public function actionIndex()
	{
		$criteria = new CDbCriteria;
		$berry = 5;
		$choice = 13;
		$effort =  14;
		$criteria->condition = "category_id in('".$berry."', '".$effort."', '".$choice."')"; //Its not neccesary to show all the items...

		$array_pokeymans = CHtml::listData(Pokemon::model()->findAll(), 'id', 'pokemonName');
		$array_items 	 = CHtml::listData(Items::model()->findAll($criteria), 'id', 'itemName');
		$array_nature 	 = CHtml::listData(Nature::model()->findAll(), 'id', 'natureName');		
		array_unshift($array_items, '(Ninguno)'); //Add the "none" option to the item list.

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
		if(isset($_POST)){
			$id_pokeyman = $_POST['pokemon_'.$id];
			$id_item 	 = $_POST['item_'.$id];
			$id_nature 	 = $_POST['nature_'.$id];
			$level		 = min( (int)$_POST['level_text_'.$id], 100);
			$ivs		 = array();
			array_push($ivs, min((int)$_POST['iv_hp_text_'.$id], 31) , min((int)$_POST['iv_atk_text_'.$id], 31) , min((int)$_POST['iv_def_text_'.$id], 31),
							 min((int)$_POST['iv_spa_text_'.$id], 31) , min((int)$_POST['iv_spd_text_'.$id], 31) , min((int)$_POST['iv_spe_text_'.$id], 31) 
					   );
			$evs		= array();
			array_push($evs, min((int)$_POST['ev_hp_text_'.$id], 252) , min((int)$_POST['ev_atk_text_'.$id], 252) , min((int)$_POST['ev_def_text_'.$id], 252) ,
							 min((int)$_POST['ev_spa_text_'.$id], 252) , min((int)$_POST['ev_spd_text_'.$id], 252) , min((int)$_POST['ev_spe_text_'.$id], 252) 
					   );
			$stat_changes = array();
			array_push($stat_changes, 0, min((int)$_POST['stat_change_atk_text_'.$id], 6) , min((int)$_POST['stat_change_def_text_'.$id], 6) ,
							 		  	 min((int)$_POST['stat_change_spa_text_'.$id], 6) , min((int)$_POST['stat_change_spd_text_'.$id], 6) , 
							 		  	 min((int)$_POST['stat_change_spe_text_'.$id], 6) 
					   );

			echo var_dump($level);
			$this->renderPartial('_showResults', array(
		        	'n'	     	=> $id,
		        	'pokemon'	=> 'TODO',

		    	));
		}
	}
}