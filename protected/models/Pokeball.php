<?php

/**
 * This is the model class for table "pokeball".
 *
 * The followings are the available columns in table 'pokeball':
 * @property integer $id
 * @property integer $index_pokeball
 * @property string $name_pokeball
 * @property string $name_es_pokeball
 * @property double $catch_rate_pokeball
 *
 * The followings are the available model relations:
 * @property Items $id0
 * @property Items $indexPokeball
 */
class Pokeball extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pokeball';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('index_pokeball, name_pokeball, name_es_pokeball', 'required'),
			array('index_pokeball', 'numerical', 'integerOnly'=>true),
			array('catch_rate_pokeball', 'numerical'),
			array('name_pokeball', 'length', 'max'=>14),
			array('name_es_pokeball', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, index_pokeball, name_pokeball, name_es_pokeball, catch_rate_pokeball', 'safe', 'on'=>'search'),
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
			'id0' => array(self::BELONGS_TO, 'Items', 'id'),
			'indexPokeball' => array(self::BELONGS_TO, 'Items', 'index_pokeball'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'index_pokeball' => 'Index Pokeball',
			'name_pokeball' => 'Name Pokeball',
			'name_es_pokeball' => 'Name Es Pokeball',
			'catch_rate_pokeball' => 'Catch Rate Pokeball',
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
		$criteria->compare('index_pokeball',$this->index_pokeball);
		$criteria->compare('name_pokeball',$this->name_pokeball,true);
		$criteria->compare('name_es_pokeball',$this->name_es_pokeball,true);
		$criteria->compare('catch_rate_pokeball',$this->catch_rate_pokeball);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pokeball the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
