<?php

/**
 * This is the model class for table "nature".
 *
 * The followings are the available columns in table 'nature':
 * @property integer $id
 * @property string $identifier
 * @property integer $decreased_stat_id
 * @property integer $increased_stat_id
 *
 * The followings are the available model relations:
 * @property Stats $decreasedStat
 * @property Stats $increasedStat
 */
class Nature extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'nature';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('identifier, decreased_stat_id, increased_stat_id', 'required'),
			array('decreased_stat_id, increased_stat_id', 'numerical', 'integerOnly'=>true),
			array('identifier', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, identifier, decreased_stat_id, increased_stat_id', 'safe', 'on'=>'search'),
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
			'decreasedStat' => array(self::BELONGS_TO, 'Stats', 'decreased_stat_id'),
			'increasedStat' => array(self::BELONGS_TO, 'Stats', 'increased_stat_id'),
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
			'decreased_stat_id' => 'Decreased Stat',
			'increased_stat_id' => 'Increased Stat',
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
		$criteria->compare('decreased_stat_id',$this->decreased_stat_id);
		$criteria->compare('increased_stat_id',$this->increased_stat_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Nature the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 *	Returns the nature name in the format English name ( spanish name) Ex: Adamant (firme)
	 *	@return string the name of the nature in both languages.
	 */
	public function getNatureName()
	{
		$spanish = 7;
		$name_es = NatureNames::model()->findByAttributes(array('nature_id' => $this->id, 'local_language_id' => $spanish))->name;
		return ucfirst($this->identifier) . ' (' . ucfirst($name_es) . ') ' ;
	}

	/**
	 * 	Returns the stats that the nature raises and decreases. Ex: +atk -spa for Adamant
	 *	@return string the text 
	 */
	public function getNatureStats()
	{
		if($this->decreased_stat_id == $this->increased_stat_id)
			return "Naturaleza neutral";
		else
			return "+".str_replace('-', ' ', ($this->decreasedStat->short)).", -".str_replace('-', ' ', ($this->increasedStat->short));
	}
	
	/** 
	 *	Returns the nature list intended for a dropdown 
	 *	@return array of the listdata of the Nature model.
	 */
	public function dropdownNature()
	{
		$model = Nature::model()->findAll();
	   	return CHtml::listData($model, 'id', 'natureName');
	}
}
