<?php

/**
 * This is the model class for table "abilities".
 *
 * The followings are the available columns in table 'abilities':
 * @property integer $id
 * @property string $identifier
 * @property integer $gen
 * @property integer $is_main_series
 *
 * The followings are the available model relations:
 * @property Generations $gen0
 * @property PokemonAbilities[] $pokemonAbilities
 */
class Abilities extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'abilities';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, identifier, gen, is_main_series', 'required'),
			array('id, gen, is_main_series', 'numerical', 'integerOnly'=>true),
			array('identifier', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, identifier, gen, is_main_series', 'safe', 'on'=>'search'),
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
			'gen0' => array(self::BELONGS_TO, 'Generations', 'gen'),
			'pokemonAbilities' => array(self::HAS_MANY, 'PokemonAbilities', 'ability_id'),
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
			'gen' => 'Gen',
			'is_main_series' => 'Is Main Series',
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
		$criteria->compare('gen',$this->gen);
		$criteria->compare('is_main_series',$this->is_main_series);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Abilities the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
