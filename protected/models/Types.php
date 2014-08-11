<?php

/**
 * This is the model class for table "types".
 *
 * The followings are the available columns in table 'types':
 * @property integer $id
 * @property string $identifier
 * @property string $name_es
 * @property integer $gen
 * @property integer $damage_class
 *
 * The followings are the available model relations:
 * @property Moves[] $moves
 * @property Player[] $players
 * @property PokemonFriendSafari[] $pokemonFriendSafaris
 * @property PokemonTypes[] $pokemonTypes
 * @property Generations $gen0
 * @property MoveDamageClasses $damageClass
 */
class Types extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'types';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, identifier, gen', 'required'),
			array('id, gen, damage_class', 'numerical', 'integerOnly'=>true),
			array('identifier', 'length', 'max'=>12),
			array('name_es', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, identifier, name_es, gen, damage_class', 'safe', 'on'=>'search'),
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
			'moves' => array(self::HAS_MANY, 'Moves', 'type_id'),
			'players' => array(self::HAS_MANY, 'Player', 'id_safari_type'),
			'pokemonFriendSafaris' => array(self::HAS_MANY, 'PokemonFriendSafari', 'id_type'),
			'pokemonTypes' => array(self::HAS_MANY, 'PokemonTypes', 'type_id'),
			'gen0' => array(self::BELONGS_TO, 'Generations', 'gen'),
			'damageClass' => array(self::BELONGS_TO, 'MoveDamageClasses', 'damage_class'),
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
			'name_es' => 'Name Es',
			'gen' => 'Gen',
			'damage_class' => 'Damage Class',
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
		$criteria->compare('name_es',$this->name_es,true);
		$criteria->compare('gen',$this->gen);
		$criteria->compare('damage_class',$this->damage_class);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Types the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	*	Returns the type name in the format English name ( spanish name) Ex: Fire (fuego)
	*	@return string the type name in both languages.
	*/
	public function getTypeName()
	{
		return ucfirst($this->identifier) . ' (' . ucfirst($this->name_es) . ') ' ;
	}

	/** 
	 *	Returns the type list intended for a dropdown 
	 *	@return array of the listdata of the Types model.
	 */
	public function dropdownTypes()
	{
        $model = Types::model()->findAll();
        return CHtml::listData($model, 'id', 'typeName');	
	}  
}
