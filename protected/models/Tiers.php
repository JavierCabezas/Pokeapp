<?php

/**
 * This is the model class for table "tiers".
 *
 * The followings are the available columns in table 'tiers':
 * @property integer $id
 * @property string $identifier
 * @property string $short
 * @property integer $gen
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Player[] $players
 * @property Player[] $players1
 * @property Player[] $players2
 * @property Player[] $players3
 * @property Generations $gen0
 */
class Tiers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tiers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('identifier, short, gen, description', 'required'),
			array('gen', 'numerical', 'integerOnly'=>true),
			array('identifier', 'length', 'max'=>40),
			array('short', 'length', 'max'=>4),
			array('description', 'length', 'max'=>300),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, identifier, short, gen, description', 'safe', 'on'=>'search'),
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
			'players' => array(self::HAS_MANY, 'Player', 'tier_single'),
			'players1' => array(self::HAS_MANY, 'Player', 'tier_doble'),
			'players2' => array(self::HAS_MANY, 'Player', 'tier_triple'),
			'players3' => array(self::HAS_MANY, 'Player', 'tier_rotation'),
			'gen0' => array(self::BELONGS_TO, 'Generations', 'gen'),
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
			'short' => 'Short',
			'gen' => 'Gen',
			'description' => 'Description',
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
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('identifier',$this->identifier,true);
		$criteria->compare('short',$this->short,true);
		$criteria->compare('gen',$this->gen);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tiers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	*	Returns the Tier name in the format Tier(short). Ex: UnderUsed(UU)  
	*	@return string the tier.
	*/
	public function getTierName()
	{
		if($this->short != ' ')
			return beautify($this->identifier).' ('. beautify($this->short) .')';
		else
			return beautify($this->identifier);
	}
}
