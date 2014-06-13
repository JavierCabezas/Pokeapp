<?php

class PokemonFriendSafariController extends Controller
{
	/**
	 * 	Echoes a dropdown with the pokémon of the type given by POST values.
	 *	@param id_type the identifier of the type that we are going to find the Safari pokémon for.
	 *	@param slot the slot number of the safari pokémon
	 *	@echo CHtml::dropdown for the specified type and slot.
	 */
	public function actionGetPokemon()
	{
		if(isset($_POST['id_type'], $_POST['slot'])){
			$criteria=new CDbCriteria;
			$model = new Player;
        	$criteria->addCondition("id_type = ".(int)$_POST['id_type']);
        	$criteria->addCondition("slot = ".(int)$_POST['slot']);
			$array_pokeymans	= CHtml::listData(PokemonFriendSafari::model()->findAll($criteria), 'id', 'pokemonName');
			echo CHtml::dropDownList('Player[safari_slot_'. $_POST['slot'] . ']' , $model, $array_pokeymans);
       
		}
	}
}