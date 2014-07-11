<?php

/**
 * This is the model class for table "pokemon_friend_safari".
 *
 * The followings are the available columns in table 'pokemon_friend_safari':
 * @property integer $id
 * @property integer $id_pokemon
 * @property integer $id_type
 * @property integer $slot
 *
 * The followings are the available model relations:
 * @property Pokemon $idPokemon
 * @property Types $idType
 */
class PokemonFriendSafari extends CActiveRecord
{

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pokemon_friend_safari';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_pokemon, id_type, slot', 'required'),
			array('id_pokemon, id_type, slot', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_pokemon, id_type, slot', 'safe', 'on'=>'search'),
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
			'idPokemon' => array(self::BELONGS_TO, 'Pokemon', 'id_pokemon'),
			'idType' => array(self::BELONGS_TO, 'Types', 'id_type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_pokemon' => 'Id Pokemon',
			'id_type' => 'Id Type',
			'slot' => 'Slot',
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
		$criteria->compare('id_pokemon',$this->id_pokemon);
		$criteria->compare('id_type',$this->id_type);
		$criteria->compare('slot',$this->slot);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PokemonFriendSafari the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	*	Returns the name of the pokémon, with the correct capitalization and spacing, instead of the id of it. (Example: Gardevoir instead of 282)
	*	@return string the name of the pokémon.
	*/
	public function getPokemonName()
	{
		return beautify($this->idPokemon->identifier);
	}
}
