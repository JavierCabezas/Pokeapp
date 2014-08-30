<?php

/**
 * This is the model class for table "egg_group_names".
 *
 * The followings are the available columns in table 'egg_group_names':
 * @property integer $id
 * @property integer $egg_group_id
 * @property integer $local_language_id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Languages $localLanguage
 * @property EggGroups $eggGroup
 */
class EggGroupNames extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'egg_group_names';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('egg_group_id, local_language_id, name', 'required'),
			array('egg_group_id, local_language_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>53),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, egg_group_id, local_language_id, name', 'safe', 'on'=>'search'),
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
			'localLanguage' => array(self::BELONGS_TO, 'Languages', 'local_language_id'),
			'eggGroup' => array(self::BELONGS_TO, 'EggGroups', 'egg_group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'egg_group_id' => 'Egg Group',
			'local_language_id' => 'Local Language',
			'name' => 'Name',
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
		$criteria->compare('egg_group_id',$this->egg_group_id);
		$criteria->compare('local_language_id',$this->local_language_id);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EggGroupNames the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
