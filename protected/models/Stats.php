<?php

/**
 * This is the model class for table "stats".
 *
 * The followings are the available columns in table 'stats':
 * @property integer $id
 * @property integer $damage_class_id
 * @property string $identifier
 * @property integer $is_battle_only
 * @property integer $game_index
 * @property string $short
 *
 * The followings are the available model relations:
 * @property Nature[] $natures
 * @property Nature[] $natures1
 * @property MoveDamageClasses $damageClass
 */
class Stats extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stats';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, identifier, is_battle_only, game_index, short', 'required'),
			array('id, damage_class_id, is_battle_only, game_index', 'numerical', 'integerOnly'=>true),
			array('identifier', 'length', 'max'=>16),
			array('short', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, damage_class_id, identifier, is_battle_only, game_index, short', 'safe', 'on'=>'search'),
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
			'natures' => array(self::HAS_MANY, 'Nature', 'decreased_stat_id'),
			'natures1' => array(self::HAS_MANY, 'Nature', 'increased_stat_id'),
			'damageClass' => array(self::BELONGS_TO, 'MoveDamageClasses', 'damage_class_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'damage_class_id' => 'Damage Class',
			'identifier' => 'Identifier',
			'is_battle_only' => 'Is Battle Only',
			'game_index' => 'Game Index',
			'short' => 'Short',
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
		$criteria->compare('damage_class_id',$this->damage_class_id);
		$criteria->compare('identifier',$this->identifier,true);
		$criteria->compare('is_battle_only',$this->is_battle_only);
		$criteria->compare('game_index',$this->game_index);
		$criteria->compare('short',$this->short,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Stats the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 *	Returns the multiplier associated with a certain stat change number (for example a multiplier of 4 for 6 stat changes)
	 *	@param integer stat_changes the number of stat changes.
	 *	@return float multiplier associated with that stat_change.
	 */
	public function getStatChangeMultiplier($stat_changes){
		 $stat_changes = min($stat_changes, 6);
		 $stat_changes = max($stat_changes, -6);
		 if($stat_changes == 0)
		 	return 1;
		 elseif($stat_changes > 0)
		 	return (1+$stat_changes * 0.5);
		 else
		 	return (2/(2-$stat_changes));
	}
}
