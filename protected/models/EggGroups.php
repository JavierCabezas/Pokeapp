<?php

/**
 * This is the model class for table "egg_groups".
 *
 * The followings are the available columns in table 'egg_groups':
 * @property integer $id
 * @property string $identifier
 *
 * The followings are the available model relations:
 * @property EggGroupNames[] $eggGroupNames
 * @property PokemonEggGroups[] $pokemonEggGroups
 */
class EggGroups extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'egg_groups';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, identifier', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('identifier', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, identifier', 'safe', 'on'=>'search'),
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
			'eggGroupNames' => array(self::HAS_MANY, 'EggGroupNames', 'egg_group_id'),
			'pokemonEggGroups' => array(self::HAS_MANY, 'PokemonEggGroups', 'egg_group_id'),
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EggGroups the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	/**
	 *	Returns the name of the egg with capitalization, spacing and with the spanish name in parenthesis.
	 *  Ex: Water 1 (Agua 1).
	 *	@return string the name of the egg group.
	 */
	public function getEggGroupName()
	{
		$spanish = 7;
		$eggie = EggGroupNames::model()->findByAttributes(array('egg_group_id' => $this->id, 'local_language_id' => $spanish));
		return beautify($this->identifier)." (".utf8_decode(beautify($eggie->name)).")";
	}

	/** 
	 *	Returns the egg list intended for a dropdown 
	 *	@return array of the listdata of the EggGroups model.
	 */
	public function dropdownEggs()
	{
		$model = EggGroups::model()->findAll();
		return CHtml::listData($model, 'id', 'eggGroupName');
	}
}
