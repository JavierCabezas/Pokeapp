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
	*	Returns the name of the item with capitalization and spacing. (Example: Master Ball instead of master-ball)
	*	@return string the name of the item.
	*/
	public function getItemName()
	{
		return str_replace('-', ' ', ucfirst($this->identifier));
	}
}
