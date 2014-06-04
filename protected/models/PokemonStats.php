<?php

/**
 * This is the model class for table "pokemon_stats".
 *
 * The followings are the available columns in table 'pokemon_stats':
 * @property integer $id
 * @property integer $pokemon_id
 * @property integer $stat_id
 * @property integer $base_stat
 * @property integer $effort
 *
 * The followings are the available model relations:
 * @property PokemonStats $stat
 * @property PokemonStats[] $pokemonStats
 * @property Pokemon $pokemon
 */
class PokemonStats extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pokemon_stats';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pokemon_id, stat_id, base_stat, effort', 'required'),
			array('pokemon_id, stat_id, base_stat, effort', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pokemon_id, stat_id, base_stat, effort', 'safe', 'on'=>'search'),
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
			'stat' => array(self::BELONGS_TO, 'PokemonStats', 'stat_id'),
			'pokemonStats' => array(self::HAS_MANY, 'PokemonStats', 'stat_id'),
			'pokemon' => array(self::BELONGS_TO, 'Pokemon', 'pokemon_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pokemon_id' => 'Pokemon',
			'stat_id' => 'Stat',
			'base_stat' => 'Base Stat',
			'effort' => 'Effort',
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
		$criteria->compare('pokemon_id',$this->pokemon_id);
		$criteria->compare('stat_id',$this->stat_id);
		$criteria->compare('base_stat',$this->base_stat);
		$criteria->compare('effort',$this->effort);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PokemonStats the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	/**
	 * Returns the HP of a certain pokémon. 
	 * @param int base_hp the base hit point stat for the pokémon (for example 68 for gardevoir)
	 * @param int level the level of the pokémon
	 * @param int ev_hp the effor points in the hp stat.
	 * @param int iv_hp the individual value of the HP.
	 * @return int the HP of the pokémon.
	 */
	public function getHp($base_hp, $level, $ev_hp, $iv_hp){
		if($base_hp == 1) 
			return 1; //shedninja is a special case
		else
			return ( intval((($iv_hp + (2*$base_hp) + intval($ev_hp/4) + 100)*$level)/100) + 10);
	}

	/**
	 * Returns any stat (other than HP since it uses a different algorithm)
	 * @param int stat_id the identifier of the stat (2 atk, 3 def, 4spa, ... ).
	 * @param int base_stat the base  stat for the pokémon (for example 125 for gardevoir's special attack or 80 for her speed).
	 * @param int id_nature the nature identifier.
	 * @param int level the level of the pokémon.
	 * @param int ev_stat the effort points in the stat.
	 * @param int iv_stat the individual value of the stat.
	 * @param int id_item the item of the pokémon.
	 * @param int stat_changes the number of stat changes.
	 * @param int id_pokemon the intifier of the pokémon.
	 * @return int the stat of the pokémon.
	 */
	public function getStat($stat_id, $id_nature, $base_stat, $level, $ev_stat, $iv_stat, $stat_changes, $id_item, $id_pokemon){
		//Nature multiplier
		$nature = Nature::model()->findByPk($id_nature);
		if($nature->decreased_stat_id == $nature->increased_stat_id)
			$nature_multiplier = 1;
		elseif($nature->increased_stat_id == $stat_id)
			$nature_multiplier = 1.1;
		elseif($nature->decreased_stat_id == $stat_id)
			$nature_multiplier = 0.9;
		else
			$nature_multiplier = 1;

		//Item multiplier
		$item_multiplier = 1;
		if(!is_null($id_item)){
			$changed_stat = array();

			$changed_stat = Items::model()->getItemChangedStat($id_item, $id_pokemon);
			for ($i = 0; $i < sizeof($changed_stat) ; $i = $i+2) { //IM SO SORRY FOR THIS CODE, I KNOW IT SUCKS...but it works.
				if($changed_stat[$i] != 0){ //If the item changes an stat (if its 0 the item does not change anything)
					if($stat_id == $changed_stat[$i]){ 
						if($changed_stat[$i+1] == -2)
							$stat_changes = $stat_changes - 1;
						elseif($changed_stat[$i+1] == -1)
							$item_multiplier = 0.5;
						elseif($changed_stat[$i+1] == 1)
							$item_multiplier = 1.5;
						else
							$stat_changes = $stat_changes + 1;
					}
				}
			}
			$changed_stat_multiplier = Stats::model()->getStatChangeMultiplier($stat_changes);
		}
		return intval( (( $iv_stat + (2*$base_stat) + intval($ev_stat/4))*$level/100 + 5)*$nature_multiplier * $changed_stat_multiplier * $item_multiplier);
	}
}
