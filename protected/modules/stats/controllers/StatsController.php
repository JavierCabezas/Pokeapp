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
		$items = Items::model()->findAll($criteria);
		$array_pokeymans = CHtml::listData(Pokemon::model()->findAll(), 'id', 'pokemonName');
		
		$array_items = array(); //For some reason listData wasn't working as expected o I coded this. Im sure there is a better way to do it =P.
		$array_items[0] = 'Ninguno';
		foreach($items as $item)
			$array_items[$item->id] = beautify($item->identifier);

		$array_nature 	 = CHtml::listData(Nature::model()->findAll(), 'id', 'natureName');		

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
			$hp=0; $atk=1; $def=2; $spa=3; $spd=4; $spe=5;
			$id_pokeyman 	= (int) $_POST['pokemon_'.$id];
			$id_item 	 	= (int) $_POST['item_'.$id];
			$id_nature 	 	= (int) $_POST['nature_'.$id];
			$level		 	= min( (int)$_POST['level_text_'.$id], 100);
			$pokemon_name 	= Pokemon::model()->findByAttributes(array('id' => $id_pokeyman))->identifier;
			$pokemon_stats 	= PokemonStats::model()->findAllByAttributes(array('pokemon_id' => $id_pokeyman));
			$nature 		= Nature::model()->findByPk($id_nature);
			$item 			= Items::model()->FindByPk($id_item);

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

			$base_stats = array();
			array_push($base_stats, (int) $pokemon_stats[$hp]->base_stat,  (int) $pokemon_stats[$atk]->base_stat, (int) $pokemon_stats[$def]->base_stat,
								    (int) $pokemon_stats[$spa]->base_stat, (int) $pokemon_stats[$spd]->base_stat, (int) $pokemon_stats[$spe]->base_stat
					  );

			$final_stats = array();
			array_push($final_stats,
						PokemonStats::model()->getHp($base_stats[$hp], $level, $evs[$hp], $ivs[$hp]),
						PokemonStats::model()->getStat(2, $id_nature, $base_stats[$atk], $level, $evs[$atk], $ivs[$atk]),
						PokemonStats::model()->getStat(3, $id_nature, $base_stats[$def], $level, $evs[$def], $ivs[$def]),
						PokemonStats::model()->getStat(4, $id_nature, $base_stats[$spa], $level, $evs[$spa], $ivs[$spa]),
						PokemonStats::model()->getStat(5, $id_nature, $base_stats[$spd], $level, $evs[$spd], $ivs[$spd]),
						PokemonStats::model()->getStat(6, $id_nature, $base_stats[$spe], $level, $evs[$spe], $ivs[$spe])
				);

			

			$this->renderPartial('_showResults', array(
				'n'	     		=> $id,
				'pokemon'		=> beautify($pokemon_name),
				'level' 		=> $level,
				'nature' 		=> $nature->natureName,
				'nature_stats' 	=> $nature->natureStats,
				'item'			=> isset($item->itemName)?$item->itemName:"Ninguno",
				'poke_pic' 		=> "<img src='/pokeapp/images/sugimori/104px-Sugimori_".addZeros($id_pokeyman).".png'>",
				'base_stats' 	=> $base_stats,
				'ivs'			=> $ivs,
				'evs' 			=> $evs,
				'stat_changes'	=> $stat_changes,
				'final_stats'	=> $final_stats,

		    ));
		}
	}
}