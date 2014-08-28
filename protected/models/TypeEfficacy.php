<?php

/**
 * This is the model class for table "type_efficacy".
 *
 * The followings are the available columns in table 'type_efficacy':
 * @property integer $id
 * @property integer $damage_type_id
 * @property integer $target_type_id
 * @property integer $damage_factor
 *
 * The followings are the available model relations:
 * @property Types $targetType
 * @property Types $damageType
 */
class TypeEfficacy extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'type_efficacy';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('damage_type_id, target_type_id, damage_factor', 'required'),
			array('damage_type_id, target_type_id, damage_factor', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, damage_type_id, target_type_id, damage_factor', 'safe', 'on'=>'search'),
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
			'targetType' => array(self::BELONGS_TO, 'Types', 'target_type_id'),
			'damageType' => array(self::BELONGS_TO, 'Types', 'damage_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'damage_type_id' => 'Damage Type',
			'target_type_id' => 'Target Type',
			'damage_factor' => 'Damage Factor',
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
		$criteria->compare('damage_type_id',$this->damage_type_id);
		$criteria->compare('target_type_id',$this->target_type_id);
		$criteria->compare('damage_factor',$this->damage_factor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TypeEfficacy the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
