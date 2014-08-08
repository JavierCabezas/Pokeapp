<?php

/**
 * This is the model class for table "items".
 *
 * The followings are the available columns in table 'items':
 * @property integer $id
 * @property string $identifier
 * @property integer $category_id
 * @property integer $cost
 *
 * The followings are the available model relations:
 * @property EvolutionChains[] $evolutionChains
 * @property ItemCategories $category
 * @property ItemsNames[] $itemsNames
 * @property Pokeball $pokeball
 * @property Pokeball[] $pokeballs
 */
class Items extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('identifier', 'required'),
			array('category_id, cost', 'numerical', 'integerOnly'=>true),
			array('identifier', 'length', 'max'=>25),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, identifier, category_id, cost', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'evolutionChains' => array(self::HAS_MANY, 'EvolutionChains', 'baby_trigger_item_id'),
			'category' => array(self::BELONGS_TO, 'ItemCategories', 'category_id'),
			'itemsNames' => array(self::HAS_MANY, 'ItemsNames', 'item_id'),
			'pokeball' => array(self::HAS_ONE, 'Pokeball', 'id'),
			'pokeballs' => array(self::HAS_MANY, 'Pokeball', 'index_pokeball'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'identifier' => 'Identifier',
			'category_id' => 'Category',
			'cost' => 'Cost',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('identifier',$this->identifier,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('cost',$this->cost);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Items the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 *	Returns the name of the item with capitalization and spacing and the spanish name in parenthesis. (Example: Master Ball instead of master-ball)
	 *	@return string the name of the item.
	 */
	public function getItemName()
	{
		$spanish = 7;
		$items = ItemsNames::model()->findByAttributes(array('item_id' => $this->id, 'local_language_id' => $spanish));
		if(isset($items))
			return beautify($this->identifier)." (".utf8_decode(beautify($items->name)).")";
		else
			return beautify($this->identifier);
	}

	/**
	 *	Returns just the items that can modify the pokémon stats (choice items, berrys, etc.)
	 * 	@return an array intended for a dropdownlist with all the items.
	 */
	public function getAllItemsThatAffectStats()
	{
		$array_items = array(178, 179, 180, 181, 182, 192, 197, 202, 203, 204, 213, 235, 
							 255, 264, 267, 268, 269, 270, 271, 274, 581, 682, 683); //id of the items that may affect the stats.
		$criteria = new CDbCriteria();
		$criteria->addInCondition("id", $array_items);
		$items = Items::model()->findAll($criteria);
		$out = array();
		$out[0] = 'Ninguno'; //Add the "none" item.
		foreach($items as $item)
			$out[$item->id] =$item->itemName; //I guess there is a way to do this using listData but I don't really know how =P.
		return $out;
	}

	/**
	 *	Returns an array with the id of the stat that a certain item modifies and if its a stat modifier or percentage.
	 *	In case you give the id of an item that doesn't affect any stats (Ex: Master Ball) it returns array(0, 0).
	 *	@param integer id_item the identifier of the item to check.
	 *	@param id_pokemon the itentifier of the pokémon that is holding the item (important for items such as the Thick club)
	 *	@return array $out. $out[0] = the id of the stat that the item affects. 0 in case that it does not affect.
	 *				 		$out[1] =  1 if the item adds a 50% of the stat. 
	 *								  -1 if the item decreases a 50% of the stat.
	 *								   2 if the item adds add stat modifier.
	 *								  -2 if the item decreased the stat modifier by one.
	 */
	public function getItemChangedStat($id_item, $id_pokemon)
	{
		$atk = 2; 	$def = 3; 	$spa = 4; $spd = 5; 	$spe = 6; 				$out = array();
		$positive_percent = 1; 	$negative_percent = -1; $positive_modifier = 2; $negative_modifier = -2;
		$liechi_berry = 178; 	$choice_band = 197; 	$ganlon_berry = 179; 	$petaya_berry = 181; 	$choice_specs = 274;
		$apicot_berry = 182;	$macho_brace = 192;	 	$salac_berry = 180; 	$choice_scarf = 264; 	$iron_ball = 255;
		$power_belt = 267; 		$power_lens = 268; 		$power_band=269; 		$power_anklet = 270; 	$power_weight = 271;
		$eviolite = 581; 		$light_ball = 213; 		$soul_dew = 202; 		$thick_club = 235; 		$deep_sea_tooth = 203;
		$deep_sea_scale = 204; 	$weakness_policy = 682; $assault_vest = 683;

		switch ($id_item){
			//attack
			case $liechi_berry:
				array_push($out, $atk, $positive_modifier); break;
			case $choice_band:
				array_push($out, $atk, $positive_percent); break;
			case $thick_club:
				($id_pokemon == 105 || $id_pokemon == 104)?array_push($out, $atk, $positive_percent):array_push($out, 0, 0); break;
			//defense
			case $ganlon_berry:
				array_push($out, $def, $positive_modifier); break;

			//special attack
			case $petaya_berry:
				array_push($out, $spa, $positive_percent); break;
			case $choice_specs:
				array_push($out, $spa, $positive_percent); break;
			case $light_ball:
				($id_pokemon == 25)?array_push($out, $spa, $positive_percent):array_push($out, 0, 0); break;
			case $deep_sea_tooth:
				($id_pokemon == 366)?array_push($out, $spa, $positive_percent):array_push($out, 0, 0); break;

			//special defense
			case $apicot_berry:
				array_push($out, $spd, $positive_modifier); break;
			case $deep_sea_scale:
				($id_pokemon == 366)?array_push($out, $spd, $positive_percent):array_push($out, 0, 0); break;
			case $assault_vest:
				array_push($out, $spd, $positive_percent); break;

			//speed
			case $macho_brace:
				array_push($out, $spe, $negative_percent); break;
			case $salac_berry:
				array_push($out, $spe, $positive_modifier); break;
			case $choice_scarf:
				array_push($out, $spe, $positive_percent); break;
			case $iron_ball:
				array_push($out, $spe, $negative_percent); break;
			case $power_belt:
			case $power_lens:
			case $power_band:
			case $power_anklet:
			case $power_weight:
				array_push($out, $spe, $negative_percent); break;

			//special cases
			case $eviolite:
				$pokemon = PokemonSpecies::model()->findByPk($id_pokemon); 
				if($pokemon->canPokemonEvolve){
					array_push($out, $def, $positive_percent);
					array_push($out, $spd, $positive_percent);
				}else{
					array_push($out, 0, 0);
				}
				break;
			case $soul_dew:
				if($id_pokemon == 381 || $id_pokemon == 382){ //latios and latias
					array_push($out, $spa, $positive_percent);
					array_push($out, $spd, $positive_percent);
				}else{
					array_push($out, 0, 0);
				}
				break;

			default:
				array_push($out, 0, 0);
		}
		return $out;
	}

	/** 
	 *	Returns the item list intended for a dropdown
	 *	@param bool held indicates if the item is a duel valid item (heldable items that that don't do any effect, like potions, don't count). The default value is false, showing all items.
	 *	@return array of the listdata of the Items model.
	 */
	public function dropdownItems($held = false)
	{
		if($held){
			$criteria = new CDbCriteria;
			$battle_items = array(2, 3, 5, 6, 7, 8, 10, 12, 13, 14, 15, 16, 17, 18, 19, 42, 44);
			$criteria->addInCondition('category_id', $battle_items);
			$model = Items::model()->findAll($criteria);
		}else{
			$model = Items::model()->findAll();
		}
		return CHtml::listData($model, 'id', 'itemName');
	}
}
