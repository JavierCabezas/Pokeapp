<?php

/**
 * This is the model class for table "pokemon_abilities".
 *
 * The followings are the available columns in table 'pokemon_abilities':
 * @property integer $id
 * @property integer $pokemon_id
 * @property integer $ability_id
 * @property integer $is_hidden
 * @property integer $slot
 *
 * The followings are the available model relations:
 * @property Pokemon $pokemon
 * @property Abilities $ability
 */
class PokemonAbilities extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pokemon_abilities';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pokemon_id, ability_id, is_hidden, slot', 'required'),
			array('pokemon_id, ability_id, is_hidden, slot', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pokemon_id, ability_id, is_hidden, slot', 'safe', 'on'=>'search'),
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
			'pokemon' => array(self::BELONGS_TO, 'Pokemon', 'pokemon_id'),
			'ability' => array(self::BELONGS_TO, 'Abilities', 'ability_id'),
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
			'ability_id' => 'Ability',
			'is_hidden' => 'Is Hidden',
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
		$criteria->compare('pokemon_id',$this->pokemon_id);
		$criteria->compare('ability_id',$this->ability_id);
		$criteria->compare('is_hidden',$this->is_hidden);
		$criteria->compare('slot',$this->slot);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PokemonAbilities the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
